<?php

/**
 * Class CdekPiclupSystem
 */

use CdekSDK2\BaseTypes\Contact as ContactCdek;
use CdekSDK2\BaseTypes\Item;
use CdekSDK2\BaseTypes\Location;
use CdekSDK2\BaseTypes\Money as ModeyCdek;
use CdekSDK2\BaseTypes\Order as OrderCdek;
use CdekSDK2\BaseTypes\Package;
use CdekSDK2\BaseTypes\Phone;
use CdekSDK2\Exceptions\RequestException;

Yii::import('application.modules.cdek.CdekModule');
Yii::import('application.modules.cdek.models.Cdek');
Yii::import('application.modules.delivery.components.DeliverySystem');

/**
 * Class CdekSystem
 */
class CdekSystem extends DeliverySystem
{
    public $order = null;
    public $delivery = null;
    public $assetsfm = null;

    public function renderCheckoutForm(Delivery $delivery, Order $order, $return = false)
    {
        $this->assetsfm = Yii::app()->getAssetManager()->publish(
            Yii::getPathOfAlias('application.modules.cdek.views.assets')
        );
        $this->order = $order;
        $this->delivery = $delivery;

        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap = [
                // В карте отключаем загрузку core-скриптов, УЖЕ подключенных до ajax загрузки
                'jquery.js' => false,
                'jquery.ui.js' => false,
                // На моей странице была ещё одна форма, поэтому jquery.yiiactiveform.js я исключил
                'jquery.yiiactiveform.js' => false,
            ];
        }

        return Yii::app()->getController()->renderPartial(
            'application.modules.cdek.views.form',
            [
                'order' => $order,
                'delivery' => $delivery,
                'data' => $this->getData(),
                'widget' => $this->getWidget(),
            ],
            $return,
            true
        );
    }

    public function getWidget()
    {
        $deliveryId = $_POST['Order']['delivery_id'] ?? null;
        $tariffCode = $_POST['Order']['sub_delivery_id'] ?? null;

        if ($this->delivery === null and $deliveryId) {
            $this->delivery = Delivery::model()->findByPk($deliveryId);
        }


        if ($this->order === null and isset($_POST['Order'])) {
            $this->order = new Order;
            $this->order->setAttributes($_POST['Order']);
        }

        $tarifaIds = $this->delivery->getDeliverySetting('tariff_code');
        if ($tariffCode === null or array_search($tariffCode, $tarifaIds) === false) {
            $tariffCode = current($tarifaIds);
            $_POST['Order']['sub_delivery_id'] = $tariffCode;
        }

        $optionsList = $this->delivery->getDeliverySettingDict('tariff_code')['options_list'] ?? [];


        $widget = $this->findVarByValue($tariffCode, 'widget', $optionsList);

        if ($widget) {
            return Yii::app()->controller->widget($widget, [
                'system' => $this,
            ], true);
        }
    }

    public function getData($delivery = null, $order = null)
    {
        $data = [];
        $dict = $this->delivery->getDeliverySettingDict('tariff_code');
        $optionsList = $dict['options_list'];

        foreach ($this->delivery->getDeliverySetting('tariff_code') as $tariffCode) {
            $tariff = $this->tariff($tariffCode);
            // пропускаем недоступные тарифы
            if (empty($tariff) || isset($tariff['errors'])) {
                continue;
            }

            $description = sprintf(
                '%s <br> <strong>От %s до %s дней</strong>',
                $this->findVarByValue($tariffCode, 'description', $optionsList),
                $tariff['period_min'],
                $tariff['period_max']
            );

            $data[$tariffCode] = [
                'id' => $tariffCode,
                'image' => $this->assetsfm . '/img/logo-cdek.jpg',
                'name' => $this->findVarByValue($tariffCode, 'name_for_site', $optionsList),
                'description' => $description,
                'price' => $tariff['total_sum'],
                'free_from' => $this->findVarByValue($tariffCode, 'free_from', $optionsList),
                'available_from' => $this->findVarByValue($tariffCode, 'available_from', $optionsList),
                'separate_payment' => $this->findVarByValue($tariffCode, 'separate_payment', $optionsList),
            ];
        }

        return $data;
    }

    public function findVarByValue($id, $var, $data)
    {
        $key = array_search($id, array_column($data, 'value'));
        if ($key === false) {
            return null;
        }

        return $data[$key][$var] ?? null;
    }

    public function getCdek()
    {
        $params = $this->delivery->getDeliverySystemSettings();

        $client = new \Http\Adapter\Guzzle6\Client;

        $cdek = new \CdekSDK2\Client($client, $params['account'], $params['secure_password']);
        $cdek->setTest((bool)$params['is_test']);

        return $cdek;
    }

    public function getApi()
    {
        $delivery = $this->getDeliveryModel();
        $account = $delivery->getDeliverySetting('account');
        $securePassword = $delivery->getDeliverySetting('secure_password');
        $isTest = $delivery->getDeliverySetting('is_test');

        $client = new \Http\Adapter\Guzzle6\Client;
        $cdek = new \CdekSDK2\Http\Api($client, $account, $securePassword);
        $cdek->setTest((bool)$isTest);

        return $cdek;
    }

    public function deliverypoints()
    {
        $address = $this->getDadataAddress();
        $dadataDelivery = Yii::app()->dadata->delivery($address['city_kladr_id']);
        $cdekId = $dadataDelivery[0]['data']['cdek_id'] ?? null;
        if ($cdekId === null) {
            throw new Exception("В системе datata не найден cdek_id по city_kladr_id " . $address['city_kladr_id']);
        }

        $cdek = $this->getCdek();

        $filter = [
            'type' => 'PVZ',
            'city_code' => $cdekId,
        ];

        $offices = $cdek->offices()->getFiltered($filter);

        if ($offices->isOk()) {
            return CJSON::decode((string)$offices->getBody());
        }

        return [];
    }

    public function tariff($tariffCode)
    {
        $address = $this->getDadataAddress(); // переводим город из json array - полная информация о городе dadata

        if (empty($address['city_kladr_id'])) {
            return [];
        }

        $dadataDelivery = Yii::app()->dadata->delivery($address['city_kladr_id']); // найти cdek_id по kladr_id в dadata

        $cdekId = $dadataDelivery[0]['data']['cdek_id'] ?? null;

        if ($cdekId === null) {
            throw new Exception("В системе datata не найден cdek_id по city_kladr_id " . $address['city_kladr_id']);
        }

        // упаковка
        $packages = [
            "height" => 10,
            "length" => 10,
            "weight" => 4000,
            "width" => 10
        ];

        $fromLocationCode = $this->getDeliveryModel()->getDeliverySetting('from_location_code');
        $cacheKey = join($packages) . $fromLocationCode . $cdekId;

        $data = Yii::app()->cache->get($cacheKey);
        if ($data === false) {
            $res = $this
                ->getApi()
                ->post('/calculator/tariff', [
                    'tariff_code' => $tariffCode,
                    'from_location' => ['code' => $fromLocationCode],
                    'to_location' => ['code' => $cdekId],
                    'packages' => $packages,
                    'weight' => $packages['weight'],
                ]);

            if ($res->isOk()) {
                $data = CJSON::decode($res->getBody());
            }
            Yii::app()->cache->set($cacheKey, $data);
        }

        return $data;
    }

    public function getCost($order, $delivery)
    {
        $this->order = $order;
        $this->delivery = $delivery;
        $this->setRegisteredOrder($order->delivery_data);
        $data = $this->getRegisteredOrder();

        return $data['delivery_detail']['total_sum'] ?? 0;
    }

    /**
     * @param null $delivery
     * @param null $id
     * @return string наименование доставки в этой системе
     */
    public function getSubDeliveryName($delivery, $id = null)
    {
        $options = $delivery->getDeliverySettingDict('tariff_code')['options_list'] ?? [];

        $data = array_filter($options, function ($item) use ($id) {
            if ($item['value'] == $id) {
                return true;
            }
            return false;
        });

        if (empty($data)) {
            return '';
        }

        $data = reset($data);
        return $data['name'] . " " . $data['w'];
    }

    public function getMitCost(Delivery $delivery, Order $order)
    {
        $this->order = $order;
        $this->delivery = $delivery;
        $cost = array_column($this->getData(), 'price', 'id');

        return min($cost);
    }

    public function getPostPvz()
    {
        $post = $this->getPost();
        if ($post and isset($post['cdek_pvz'])) {
            return reset($post['cdek_pvz']);
        }

        return null;
    }

    public function createOrder(Delivery $delivery, Order $storeModel)
    {
        $this->delivery = $delivery;
        $this->order = $storeModel;
        
        $orderId = Yii::app()
            ->db
            ->createCommand('select id+1 from {{store_order}} order by id DESC limit 1')
            ->queryScalar();

        $cdek = $this->getCdek();

        $address = $this->getDadataAddress(); // переводим город из json array - полная информация о городе dadata

        if (empty($address['city_kladr_id'])) {
            return [];
        }

        $dadataDelivery = Yii::app()->dadata->delivery($address['city_kladr_id']); // найти cdek_id по kladr_id в dadata

        $cdekId = $dadataDelivery[0]['data']['cdek_id'] ?? null;

        $products = [];

        $weight = 0;
        $productCart = Yii::app()->cart->getPositions();

        $i = 0;
        foreach ($productCart as $key => $product) {
            $products[$i] = Item::create([
                'name' => $product->name,
                'ware_key' => $product->sku,
                'payment' => ModeyCdek::create(['value' => $i === 0 ? 100 : 0]),
                'cost' => $i === 0 ? 100 : 0,
                'weight' => ($product->weight ?? 100) * $product->getQuantity(),
                'amount' => $product->getQuantity()
            ]);
            $i++;
            $weight += ($product->weight ?? 100) * $product->getQuantity();
        }

        $params = [
            'number' => $orderId,
            'tariff_code' => $this->getPostSubDeliveryId(),
            'sender' => ContactCdek::create([
                'name' => Yii::app()->getModule('yupe')->siteName,
                'phones' => [
                    Phone::create(['number' => '+79531234567'])
                ]
            ]),
            'recipient' => ContactCdek::create([
                'name' => $this->getPostName(),
                'email' => $this->getPostEmail(),
                'phones' => [
                    Phone::create(['number' => '+' . preg_replace('/[^\d]+/', '', $this->getPostPhone())])
                ]
            ]),
            'from_location' => Location::create([
                'code' => $delivery->getDeliverySetting('from_location_code'),
                'country_code' => 'ru',
                'address' => 'г. Оренбург'
            ]),
            'packages' => [
                Package::create([
                    'number' => $orderId,
                    'weight' => $weight,
                    'length' => 12,
                    'width' => 11,
                    'height' => 8,
                    'items' => $products
                ])
            ],
//            'ship'
        ];


        if ($this->getPostPvz()) {
            $params['delivery_point'] = $this->getPostPvz();
        } else {
            $params['to_location'] = Location::create([
                'address' => $this->getPostFullAddress(),
                'code' => $cdekId,
            ]);

        }

        $order = OrderCdek::create($params);

        try {
            $response = $cdek->orders()->add($order);
            if ($response->isOk()) {
                $response_order = $cdek->formatResponse($response, OrderCdek::class);
                return $this->getOrder($response_order->entity->uuid);
            }

            if ($response->hasErrors()) {
                echo '<pre>';
                print_r($response->getErrors());
                exit;
                // Обрабатываем ошибки
            }
        } catch (RequestException $exception) {
            echo '<pre>';
            print_r($exception->getMessage());
            exit;
        }
    }

    public function getOrder($track)
    {
        $cdek = $this->getCdek();

        // ожидаем пока сдэк не зарегистрирует заказ. Проверяем регистрацию каждые 2 секунды
        while (true) {
            sleep(2);
            $response = $cdek->orders()->get($track);
            $data = $cdek->formatResponse($response, OrderCdek::class);
            $status = $data->requests[0] ? $data->requests[0]->state : null;

            if ($status !== 'SUCCESSFUL') {
                continue;
            }

            $body = CJSON::decode((string)$response->getBody());
            return $body['entity'] ?? null;
        }
    }

    public function getOutCost()
    {
        $data = $this->getRegisteredOrder();
        return $data['delivery_detail']['total_sum'] ?? 0;
    }

    public function getOutTrack()
    {
        $data = $this->getRegisteredOrder();
        return $data['cdek_number'] ?? 0;
    }

    public function getOutToAddress()
    {
        $data = $this->getRegisteredOrder();
        return $data['to_location']['address'] ?? 0;
    }

    public function getOutTariffCode()
    {
        $data = $this->getRegisteredOrder();
        return $data['tariff_code'] ?? false;
    }
}
