<?php

/**
 * Class DeliverySystem
 */
class DeliverySystem extends CApplicationComponent
{
    public $delivery = null;
    protected $_regiseredOrder;
    /**
     *
     */
    const LOG_CATEGORY = 'store.delivery';

    /**
     * @var string
     */
    public $parametersFile = 'parameters.json';

    /**
     * @param Delivery $delivery
     * @param Order $order
     * @param bool|false $return
     * @throws CException
     */
    public function renderCheckoutForm(Delivery $delivery, Order $order, $return = false)
    {
        return null;
    }

    /**
     * @param Delivery $delivery
     * @param CHttpRequest $request
     * @throws CException
     */
    public function processCheckout(Delivery $delivery, CHttpRequest $request)
    {
        return null;
    }

    /**
     * @param null $cost сумма всех товаров
     * @return int стоимость доставки
     */
    public function getCost($order, $delivery)
    {
        return 0;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        $class_info = new ReflectionClass($this);
        $params = json_decode(
            file_get_contents(dirname($class_info->getFileName()) . DIRECTORY_SEPARATOR . $this->parametersFile),
            true
        );

        return $params;
    }

    /**
     * @param array $deliverySettings
     * @param bool|false $return
     * @return string
     */
    public function renderSettings($deliverySettings = [], $return = false)
    {
        $params = $this->getParameters();
        $settings = '';
        foreach ((array)$params['settings'] as $param) {
            $variable = $param['variable'];
            $settings .= CHtml::openTag('div', ['class' => 'form-group']);
            $settings .= CHtml::label($param['name'], 'Delivery_settings_' . $variable, ['class' => 'control-label']);
            $value = isset($deliverySettings[$variable]) ? $deliverySettings[$variable] : null;
            if (isset($param['options'])) {
                $settings .= CHtml::dropDownList(
                    'DeliverySettings[' . $variable . ']',
                    $value,
                    CHtml::listData($param['options'], 'value', 'name'),
                    ['class' => 'form-control']
                );
            } elseif (isset($param['options_list'])) {
                $settings .= CHtml::checkBoxList(
                    'DeliverySettings[' . $variable . ']',
                    $value,
                    CHtml::listData($param['options_list'], 'value', 'name'),
                    [
                        'class' => '',
                        'template' => '<div class="checkbox">{input} {label}</div>',
                        'separator' => '',
                    ]
                );
            } else {
                $settings .= CHtml::textField('DeliverySettings[' . $variable . ']', $value, ['class' => 'form-control']);
            }
            $settings .= CHtml::closeTag('div');
        }
        if ($return) {
            return $settings;
        } else {
            echo $settings;
        }
    }

    public function getPost()
    {
        return Yii::app()->request->getParam('Order');
    }

    /**
     * @return mixed|null ФИО пользователь
     */
    public function getPostName()
    {
        if ($post = $this->getPost() and isset($post['name'])) {
            return $post['name'];
        }

        return null;
    }

    /**
     * @return mixed|null Телефон пользователя
     */
    public function getPostPhone()
    {
        if ($post = $this->getPost() and isset($post['phone'])) {
            return $post['phone'];
        }

        return null;
    }

    /**
     * @return mixed|null E-mail пользователя
     */
    public function getPostEmail()
    {
        if ($post = $this->getPost() and isset($post['email'])) {
            return $post['email'];
        }

        return null;
    }

    /**
     * @return mixed|null полный адрес, подсказка из dadata
     */
    public function getPostFullAddress()
    {
        if ($post = $this->getPost() and isset($post['fullAddress'])) {
            return $post['fullAddress'];
        }

        return null;
    }

    /**
     * @return int|null Идентификатор способа доставки Delivery.id
     */
    public function getPostDeliveryId(): ?int
    {
        if ($post = $this->getPost() and isset($post['delivery_id'])) {
            return (int)$post['delivery_id'];
        }

        return null;
    }

    /**
     * @return mixed|null Идентификатор способа доставки, внетренний иднетификатор системы доставки (СДЕК, Почта России и т.д.)
     */
    public function getPostSubDeliveryId()
    {
        if ($post = $this->getPost() and isset($post['sub_delivery_id'])) {
            return $post['sub_delivery_id'];
        }

        return null;
    }

    /**
     * @return mixed|null Идентификатор способа оплаты
     */
    public function getPostPaymentMethodId()
    {
        if ($post = $this->getPost() and isset($post['payment_method_id'])) {
            return $post['payment_method_id'];
        }

        return null;
    }

    /**
     * @return array|null Полны адресс из DaData
     */
    public function getDadataAddress(): ?array
    {
        $post = $this->getPost();
        if ($post and isset($post['address_obj'])) {
            return CJSON::decode($post['address_obj']);
        }

        return null;
    }

    /**
     * @return mixed|null Почтовый индекс
     */
    public function getPostPostalCode()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['postal_code'])) {
            return $address['postal_code'];
        }

        return null;
    }

    /**
     * @return mixed|null Страна
     */
    public function getPostCountry()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['country'])) {
            return $address['country'];
        }

        return null;
    }

    /**
     * @return mixed|null IsoCode
     */
    public function getPostCountryIsoCode()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['country_iso_code'])) {
            return $address['country_iso_code'];
        }

        return null;
    }

    /**
     * @return mixed|null
     */
    public function getPostFederalDistrict()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['federal_district'])) {
            return $address['federal_district'];
        }

        return null;
    }

    /**
     * @return mixed|null регион
     */
    public function getPostRegion()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['region'])) {
            return $address['region'];
        }

        return null;
    }

    /**
     * @return mixed|null Город
     */
    public function getPostCity()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['city'])) {
            return $address['city'];
        }

        return null;
    }

    /**
     * @return mixed|null населенный пункт
     */
    public function getPostSettlement()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['settlement'])) {
            return $address['settlement'];
        }

        return null;
    }

    /**
     * @return mixed|null Улица
     */
    public function getPostStreet()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['street'])) {
            return $address['street'];
        }

        return null;
    }

    /**
     * @return mixed|null Дом
     */
    public function getPostHouse()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['house'])) {
            return $address['house'];
        }

        return null;
    }

    /**
     * @return mixed|null Квартира
     */
    public function getPostFlat()
    {
        $address = $this->getDadataAddress();
        if ($address and isset($address['flat'])) {
            return $address['flat'];
        }

        return null;
    }

    /**
     * @return Delivery|null Модель Delivery или null
     */
    public function getDeliveryModel(): ?Delivery
    {
        return $this->delivery ?? Delivery::model()->findByPk($this->getPostDeliveryId());
    }

    public function getDeliverySystemSettings()
    {
        $model = $this->getDeliveryModel();
        if ($model) {
            return $model->getDeliverySystemSettings();
        }

        return null;
    }

    public function getSubDeliveryName($id = null)
    {
        return '';
    }

    public function createOrder(Delivery $delivery, Order $storeModel)
    {
        $post = $this->getPost();
        $pickupId = $post['pickup']['0'] ?? null;
        if ($pickupId) {
            $pickup = Pickup::model()->findByPk($pickupId);
        }

        if ($pickup) {
            return $pickup->attributes;
        }
        return '';
    }

    public function getRegiseredOrder($delivery, $order, $track)
    {
        return [];
    }

    public function setRegisteredOrder(string $data)
    {
        $this->_regiseredOrder = unserialize($data);
    }

    public function getRegisteredOrder()
    {
        return $this->_regiseredOrder;
    }

    public function getOutCost()
    {
        return null;
    }

    public function getOutTrack()
    {
        return null;
    }

    public function getOutNumber()
    {
        return null;
    }

    public function getOutTariffCode()
    {
        return null;
    }

    public function getOutToAddress()
    {
        return null;
    }

    /**
     * @return null сумма наложного платежа
     */
    public function getOutPayment()
    {
        return null;
    }
}
