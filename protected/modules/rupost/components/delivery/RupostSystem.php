<?php

/**
 * Class PickupPiclupSystem
 */

use LapayGroup\RussianPost\Entity\Order as PostOrder;
use LapayGroup\RussianPost\Providers\OtpravkaApi;

Yii::import('application.modules.pickup.PickupModule');
Yii::import('application.modules.pickup.models.Pickup');
Yii::import('application.modules.delivery.components.DeliverySystem');

/**
 * Class PickupPiclupSystem
 */
class RupostSystem extends DeliverySystem
{
    public $delivery;
    public $deliverySettings;
    public $order;
    public $assetsfm;

    public function renderCheckoutForm(Delivery $delivery, Order $order, $return = false)
    {
        $this->assetsfm = Yii::app()->getAssetManager()->publish(
            Yii::getPathOfAlias('application.modules.rupost.views.assets')
        );

        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap = [
                'jquery.js' => false,
                'jquery.ui.js' => false,
                'jquery.yiiactiveform.js' => false,
            ];
        }

        $this->delivery = $delivery;
        $this->order = $order;
        $this->deliverySettings = $delivery->getDeliverySystemSettings();

        $data = $this->getTariffList();

        return Yii::app()->getController()->renderPartial(
            'application.modules.rupost.views.form',
            [
                'settings' => $delivery->getDeliverySystemSettings(),
                'order' => $order,
                'data' => $data,
            ],
            $return,
            false
        );
    }

    /**
     * @return array список доступных тарифов
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTariffList()
    {
        $data = [];
        foreach ($this->deliverySettings['tariffs'] as $objectId) {
            $pay = 0;
            $name = null;
            $description = null;

            $tariff = $this->getTariff($objectId, Yii::app()->cart->getCost());
            if (is_object($tariff)) {
                $pay = $tariff->getPay();
                $payNds = $tariff->getPayNds();
                $name = $tariff->getCategoryItemName();
                $description = "Способ пересылки: " . $tariff->getTransportationName();
            }

            if ($pay === 0) {
                continue;
            }

            $data[] = [
                'id' => $objectId,
                'image' => $this->assetsfm . '/img/logo-post.jpg',
                'name' => $name,
                'description' => $description,
                'price' => $payNds,
                'pay' => $pay,
            ];
        }

        return $data;
    }

    /**
     * Получить пинимальную стоимость доставки
     * @param Delivery $delivery
     * @param Order $order
     * @return mixed минимальная стоимость доставки
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMitCost(Delivery $delivery, Order $order)
    {
        $this->order = $order;
        $this->delivery = $delivery;
        $this->deliverySettings = $delivery->getDeliverySystemSettings();
        $cost = array_column($this->getTariffList(), 'price');
        return min($cost);
    }

    public function getWidget()
    {
        $deliveryId = $this->getPostDeliveryId();
        $tariffCode = $this->getPostSubDeliveryId();

        if ($this->delivery === null and $deliveryId) {
            $this->delivery = Delivery::model()->findByPk($deliveryId);
        }

        if ($this->order === null and isset($_POST['Order'])) {
            $this->order = new Order;
            $this->order->setAttributes($_POST['Order']);
        }

        if ($tariffCode === null) {
            $tariffCode = current($this->delivery->getDeliverySetting('tariffs'));
            $_POST['Order']['sub_delivery_id'] = $tariffCode;
        }

        $optionsList = $this->delivery->getDeliverySettingDict('tariffs')['options_list'] ?? [];

        $widget = $this->findVarByValue($tariffCode, 'widget', $optionsList);

        if ($widget) {
            return Yii::app()->controller->widget($widget, [
                'system' => $this,
            ], true);
        }

        return null;
    }

    public function findVarByValue($id, $var, $data)
    {
        $key = array_search($id, array_column($data, 'value'));
        if ($key === false) {
            return null;
        }

        return $data[$key][$var] ?? null;
    }

    /**
     * Получить стоимость доставки
     * @param $order Order
     * @param $delivery Delivery
     * @return float|int Стоимость доставки по выбранному тарифу
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCost($order, $delivery)
    {
        $this->order = $order;
        $this->delivery = $delivery;
        $this->setRegisteredOrder($order->delivery_data);
        $data = $this->getRegisteredOrder();

        return round((($data['total-rate-wo-vat'] ?? 0) + ($data['total-vat'] ?? 0)) / 100, 2);
    }

    public function getConfig($delivery = null): array
    {
        $settings = $delivery->getDeliverySystemSettings();
        return [
            'auth' => [
                'otpravka' => [
                    'token' => $settings['token'],
                    'key' => $settings['key'],
                ],
                'tracking' => [
                    'login' => $settings['login'],
                    'password' => $settings['password'],
                ],
            ]
        ];
    }

    public function createOrder(Delivery $delivery, Order $model)
    {
        $this->order = $model;
        $this->delivery = $delivery;

        $orderId = Yii::app()
            ->db
            ->createCommand('select id+1 from {{store_order}} order by id DESC limit 1')
            ->queryScalar();

        try {
            $settings = $delivery->getDeliverySystemSettings();
            $weight = (int)($model->getWeightPosition() ?? (int)$settings['weight']);
            if ($weight > 3500) {
                $weight = 3500;
            }
            $orders = [];
            $order = new PostOrder();
            $order->setIndexTo((int)$this->getPostPostalCode());
            $order->setPostOfficeCode((int)$settings['index_from']);
            $order->setMass($weight);
            $order->setOrderNum($orderId);
            $order->setRecipientName($this->getPostName());
            $order->setTelAddress(preg_replace('/[^\d]+/', '', $this->getPostPhone()));
            $order->setSmsNoticeRecipient(1);
            $order->setMailType('ONLINE_PARCEL');

            // if ($this->getPostSubDeliveryId() == 23040) {
            //     $order->setMailType();
            // }

            $house = explode('/', $this->getPostHouse());
            if (count($house) > 1) {
                $order->setHouseTo($house[0]);
                $order->setSlashTo($house[1]);
            } else {
                $order->setHouseTo($this->getPostHouse());
            }
            $order->setRegionTo($this->getPostRegion());
            $order->setPlaceTo($this->getPostCity() ?? $this->getPostSettlement());
            $order->setStreetTo($this->getPostStreet());
            $order->setRoomTo($this->getPostFlat());
            $order->setAreaTo($this->getPostRegion());

            $tariffs = $delivery->getDeliverySettingDict('tariffs')['options_list'] ?? [];
            // Если тариф с объявленной ценностью, добавляем сумму объявленной ценности
            $insrValue = $this->findVarByValue($this->getPostSubDeliveryId(), 'insr_value', $tariffs);
            if ($insrValue) {
                $order->setMailCategory('WITH_DECLARED_VALUE');
                $order->setInsrValue($model->getProductsCost() * 100);
            }

            // Если тариф с наложенным платежом, добавляем наложенный платеж
            $compulsoryPayment = $this->findVarByValue($this->getPostSubDeliveryId(), 'compulsory_payment', $tariffs);
            if ($compulsoryPayment) {
                $order->setPayment($model->getProductsCost() * 100);
                $order->setMailCategory('WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY');
            }

            $orders[] = $order->asArr();
            $otpravkaApi = new OtpravkaApi($this->getConfig($delivery));
            $result = $otpravkaApi->createOrders($orders);
            $postOrderId = $result['result-ids'][0];
            $result = $otpravkaApi->findOrderById($postOrderId);

            // если наложенный платеж перерасчитываем заказ
            if ($compulsoryPayment) {
                $postDeliveryCost = round(($result['total-rate-wo-vat'] ?? 0) + ($result['total-vat'] ?? 0), 2);
                $postPayment = $postDeliveryCost + $result['payment'];
                $order->setPayment($postPayment);
                $order->setInsrValue($postPayment);
                $otpravkaApi = new OtpravkaApi($this->getConfig($delivery));
                $otpravkaApi->editOrder($order, $postOrderId);
                $result = $otpravkaApi->findOrderById($postOrderId);
                return $result;
            }
            return $result;
        } catch (\InvalidArgumentException $e) {
            echo '<pre>';
            print_r($e->getMessage());
            echo '</pre>';
            exit;
            // Обработка ошибки заполнения параметров
        } catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
            echo '<pre>';
            print_r($e->getRawResponse());
            echo '</pre>';
            exit;
            // Обработка ошибочного ответа от API ПРФ
        } catch (\Exception $e) {
            echo '<pre>';
            print_r($e->getMessage());
            echo '</pre>';
            exit;
            // Обработка нештатной ситуации
        }
    }

    /**
     * @param $tariffCode Идентификатор тарифа
     * @param $cost Общая стоимость товаров
     * @return \LapayGroup\RussianPost\CalculateInfo|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getTariff($tariffCode, $cost)
    {
        $from = $this->getDeliverySystemSettings()['index_from'] ?? null;
        $pack = $this->getDeliverySystemSettings()['sending_package'] ?? 0;
//        $weight = $this->getDeliverySystemSettings()['weight'] ?? 0;
//        if ($this->order) {
        $weight = (int)($this->order->getWeightPosition() ?? (int)$this->getDeliverySystemSettings()['weight']);
//        }

        try {
            $params = [
                'weight' => $weight,
                'sumoc' => $cost * 100,
                'from' => $from,
                'to' => $this->getPostPostalCode(),
                'pack' => $pack,
            ];

            // 2 - Заказное уведомление о вручении
            // 21 - СМС-уведомление о вручении
            $services = [2, 21];

            $TariffCalculation = new \LapayGroup\RussianPost\TariffCalculation();
            $calcInfo = $TariffCalculation->calculate($tariffCode, $params, $services);

            return $calcInfo;
        } catch (\LapayGroup\RussianPost\Exceptions\RussianPostTarrificatorException $e) {
            return $e->getMessage();
        } catch (\LapayGroup\RussianPost\Exceptions\RussianPostException $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param null $delivery
     * @param null $id
     * @return string наименование доставки в этой системе
     */
    public function getSubDeliveryName($delivery, $id = null)
    {
        $options = $delivery->getDeliverySettingDict('tariffs')['options_list'] ?? [];

        $data = array_filter($options, function ($item) use ($id) {
            if ($item['value'] == $id) {
                return true;
            }
            return false;
        });

        if (empty($data)) {
            return '';
        }

        return reset($data)['name'];
    }

    public function getOutTrack()
    {
        $data = $this->getRegisteredOrder();
        return $data['barcode'] ?? 0;
    }

    public function getOutToAddress()
    {
        $data = $this->getRegisteredOrder();
        return ($data['index-to'] ?? '') . ' ул.' . ($data['street-to'] ?? '') . ($data['house-to'] ?? '');
    }

    public function getOutPayment()
    {
        $data = $this->getRegisteredOrder();
        return (($data['payment'] ?? 0) / 100);
    }
}
