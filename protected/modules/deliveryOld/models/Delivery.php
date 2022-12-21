<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property double $free_from
 * @property double $available_from
 * @property integer $position
 * @property integer $status
 * @property integer $separate_payment
 * @property string $module
 * @property text $settings
 *
 * @property Payment[] $paymentMethods
 *
 */
class Delivery extends yupe\models\YModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    /* сюда передаются id способов оплаты, доступные для этого способа доставки*/
    public $payment_methods = [];

    private $_deliverySettings = [];

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{store_delivery}}';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['name, price, position, status', 'required'],
            ['name', 'filter', 'filter' => 'trim'],
            ['position, separate_payment', 'numerical', 'integerOnly' => true],
            ['price, free_from, available_from', 'store\components\validators\NumberValidator'],
            ['name', 'length', 'max' => 255],
            ['module', 'length', 'max' => 100],
            ['description, payment_methods, settings', 'safe'],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            [
                'id, name, status, position, description, price, free_from, available_from, separate_payment, module',
                'safe',
                'on' => 'search'
            ],
        ];
    }

    public function relations()
    {
        return [
            'paymentRelation' => [self::HAS_MANY, 'DeliveryPayment', 'delivery_id'],
            'paymentMethods' => [
                self::HAS_MANY,
                'Payment',
                ['payment_id' => 'id'],
                'through' => 'paymentRelation',
                'order' => 'paymentMethods.position ASC',
                'condition' => 'paymentMethods.status = :status',
                'params' => [':status' => Payment::STATUS_ACTIVE]
            ],
        ];
    }

    public function scopes()
    {
        return [
            'published' => [
                'condition' => 'status = :status',
                'params' => [':status' => self::STATUS_ACTIVE],
            ],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id'               => Yii::t('DeliveryModule.delivery', 'ID'),
            'name'             => Yii::t('DeliveryModule.delivery', 'Title'),
            'description'      => Yii::t('DeliveryModule.delivery', 'Description'),
            'status'           => Yii::t('DeliveryModule.delivery', 'Status'),
            'position'         => Yii::t('DeliveryModule.delivery', 'Position'),
            'price'            => Yii::t('DeliveryModule.delivery', 'Price'),
            'free_from'        => Yii::t('DeliveryModule.delivery', 'Free from'),
            'available_from'   => Yii::t('DeliveryModule.delivery', 'Available from'),
            'separate_payment' => Yii::t('DeliveryModule.delivery', 'Separate payment'),
            'payment_methods'  => Yii::t('DeliveryModule.delivery', 'Payment methods'),
            'module'           => 'Модуль',
        ];
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('free_from', $this->free_from);
        $criteria->compare('available_from', $this->available_from);
        $criteria->compare('separate_payment', $this->separate_payment);
        $criteria->compare('status', $this->status);
        $criteria->compare('position', $this->position);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('module', $this->module, true);

        return new CActiveDataProvider(
            $this,
            [
                'criteria' => $criteria,
                'sort' => ['defaultOrder' => 't.position']
            ]
        );
    }

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t("DeliveryModule.delivery", 'Active'),
            self::STATUS_NOT_ACTIVE => Yii::t("DeliveryModule.delivery", 'Not active'),
        ];
    }

    public function getStatusTitle()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t("DeliveryModule.delivery", '*unknown*');
    }

    public function afterFind()
    {
        $this->payment_methods = array_map(
            function ($x) {
                return $x->id;
            },
            $this->paymentMethods
        );

        $this->_deliverySettings = unserialize($this->settings);

        parent::afterFind();
    }

    public function beforeSave()
    {
        $this->settings = serialize($this->_deliverySettings);

        return parent::beforeSave();
    }

    public function clearPaymentMethods()
    {
        DeliveryPayment::model()->deleteAllByAttributes(['delivery_id' => $this->id]);
    }

    public function afterSave()
    {
        parent::afterSave();
        $this->clearPaymentMethods();
        foreach ((array)$this->payment_methods as $payment_id) {
            if ($payment_id) {
                $deliveryPayment = new DeliveryPayment();
                $deliveryPayment->delivery_id = $this->id;
                $deliveryPayment->payment_id = $payment_id;
                $deliveryPayment->save();
            }
        }
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $deliveryOrdersNum = Order::model()->countByAttributes(['delivery_id' => $this->id]);
            return $deliveryOrdersNum == 0;
        }
        return false;
    }

    public function afterDelete()
    {
        $this->clearPaymentMethods();
        parent::afterDelete();
    }

    /**
     * @param $totalPrice Order - Сумма заказа
     * @return float
     */
    public function getCost($order)
    {
        $cost = 0;
        if (null === $this->free_from) {
            $system = $this->getDeliverSystem();
            $cost = $system->getCost($order, $this);

            return $this->price = $cost;
        }

        return $this->free_from <= $cost ? 0 : $this->price;
    }

    public function createOrder($order)
    {
        $system = $this->getDeliverSystem();
        
        return $system->createOrder($this, $order);
    }

    public function hasPaymentMethods()
    {
        return count($this->paymentRelation);
    }

    public function checkAvailable(Order $order)
    {
        return $order->getProductsCost() >= $this->available_from;
    }

    public function findById($id)
    {
        return $this->findByPk($id);
    }

    /**
     * @param $settings
     */
    public function setDeliverySystemSettings($settings)
    {
        $this->_deliverySettings = $settings;
    }

    /**
     * @return array
     */
    public function getDeliverySystemSettings()
    {
        return $this->_deliverySettings;
    }

    public function getDeliverySetting($name)
    {
        $data = $this->getDeliverySystemSettings();
        if ($data[$name]) {
            return $data[$name];
        }

        return null;
    }

    public function getDeliverySettingDict($name)
    {
        $data = CJSON::decode(file_get_contents(Yii::getPathOfAlias("application.modules.{$this->module}.components.delivery").'/parameters.json'));

        if (empty($data['settings'])) {
            return [];
        }

        $key = array_search($name, array_column($data['settings'], 'variable'));
        if ($key===false) {
            return [];
        }

        return $data['settings'][$key];
    }

    public function getDeliverSystem()
    {
        return Yii::app()->deliveryManager->getDeliverySystemObject($this->module);
    }

    /**
     * @param Order $order
     * @return int
     */
    public function getMinCostSystem(Order $order)
    {
        $deliverySystem = $this->getDeliverSystem();
        return $deliverySystem ? $deliverySystem->getMitCost($this, $order) : 0;
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getDeliveryForm(Order $order)
    {
        $deliverySystem = $this->getDeliverSystem();
        
        return $deliverySystem ? $deliverySystem->renderCheckoutForm($this, $order, true) : null;
    }
}
