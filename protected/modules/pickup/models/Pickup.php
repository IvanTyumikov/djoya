<?php

/**
 * This is the model class for table "{{pickup_pickup}}".
 *
 * The followings are the available columns in table '{{pickup_pickup}}':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $mode
 * @property string $phone
 * @property string $email
 * @property string $latitude
 * @property string $longitude
 * @property integer $status
 */
class Pickup extends \yupe\models\YModel
{
    const STATUS_CLOSE = 0;
    const STATUS_OPEN = 1;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{pickup_pickup}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['status', 'numerical', 'integerOnly'=>true],
            ['name, address, mode, phone, email, latitude, longitude', 'length', 'max'=>255],
            ['description', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, name, address, description, mode, phone, email, latitude, longitude, status', 'safe', 'on'=>'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Наименование',
            'address'     => 'Адрес',
            'description' => 'Описание',
            'mode'        => 'Режим работы',
            'phone'       => 'Телефон(ы)',
            'email'       => 'E-mail(s)',
            'latitude'    => 'Широта',
            'longitude'   => 'Долгота',
            'status'      => 'Статус',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('mode', $this->mode, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('latitude', $this->latitude, true);
        $criteria->compare('longitude', $this->longitude, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, [
            'criteria'=>$criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pickup the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getStatusList()
    {
        return [
            self::STATUS_CLOSE => 'Не доступен',
            self::STATUS_OPEN => 'Доступен',
        ];
    }

    public function getStatusName()
    {
        $data = $this->getStatusList();
        if (isset($data[$this->status])) {
            return $data[$this->status];
        }

        return null;
    }

    public function scopes()
    {
        return [
            'published' => [
                'condition' => 'status = :status',
                'params' => ['status' => self::STATUS_OPEN],
            ],
        ];
    }
}
