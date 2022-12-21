<?php

/**
 * This is the model class for table "{{dealers_order}}".
 *
 * The followings are the available columns in table '{{dealers_order}}':
 * @property integer $id
 * @property string $create_time
 * @property string $update_time
 * @property string $company
 * @property string $city
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $site
 * @property string $platform
 * @property string $image
 * @property string $comment
 * @property integer $status
 * @property integer $position
 */
class DealersOrder extends yupe\models\YModel
{
	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;

	const SCENARIO_TEMPLATE = 'pl{template}';

	public $is_pl;

	public $pl1_nazv;
	public $pl1_all_area;
	public $pl1_area;

	public $pl2_nazv_tc;
	public $pl2_nazv;
	public $pl2_all_area;
	public $pl2_area;

	public $count_personal;

	public $verify;

	public $data = [];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dealers_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pl1_nazv, pl1_all_area, pl1_area', 'required', 'on' => 'pl1'),
			array('pl2_nazv_tc, pl2_nazv, pl2_all_area, pl2_area', 'required', 'on' => 'pl2'),
			array('company, city, email, phone, site, name, is_pl, count_personal', 'required'),
			array('status, position, is_pl, count_personal', 'numerical', 'integerOnly'=>true),
			array('company, city, email, phone, site, image', 'length', 'max'=>255),
			array('name, comment, count_personal, platform', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_time, update_time, company, city, name, email, phone, site, platform, image, comment, status, position', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'             => 'ID',
			'create_time'    => 'Create Time',
			'update_time'    => 'Update Time',
			'company'        => 'Компания',
			'city'           => 'Город',
			'name'           => 'Контактное лицо',
			'email'          => 'E-mail',
			'phone'          => 'Телефон',
			'site'           => 'Сайт',
			'platform'       => 'Наличие торговой площади:',
			'image'          => 'Изображение',
			'comment'        => 'Комментарий',
			'status'         => 'Статус',
			'position'       => 'Сортировка',
			'is_pl'          => 'Наличие торговой площади:',
			'count_personal' => 'Количество персонала',
			'pl1_nazv'       => 'Наименование',
			'pl1_all_area'   => 'Общая площадь (кв.м.)',
			'pl1_area'       => 'Готовы выделить для подиума «Добрый стиль» (кв.м.)',
			'pl2_nazv_tc'    => 'Наименование ТЦ, МЦ и т.д.',
			'pl2_nazv'       => 'Наименование магазина',
			'pl2_all_area'   => 'Общая площадь (кв.м.)',
			'pl2_area'       => 'Готовы выделить для подиума «Добрый стиль» (кв.м.)',
		);
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

		$criteria->compare('id',$this->id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('platform',$this->platform,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DealersOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getStatusList()
	{
		return [
			self::STATUS_PUBLIC   => 'Опубликован',
			self::STATUS_MODERATE => 'На модерации',
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
	            'condition' => 'status  = :status',
	            'params' => [
	                ':status' => self::STATUS_PUBLIC
	            ]
	        ],
	    ];
	}

	public function getIsPlList()
	{
		return [
			1 => 'Частное', 
            2 => 'Аренда'
		];
	}
	/**
     * @return bool
     */
    public function beforeSave()
    {
    	$this->data = $this->attributes;
		$this->data['pl1_nazv'] = $this->pl1_nazv;
		$this->data['pl1_all_area'] = $this->pl1_all_area;
		$this->data['pl1_area'] = $this->pl1_area;
		$this->data['pl2_nazv_tc'] = $this->pl2_nazv_tc;
		$this->data['pl2_nazv'] = $this->pl2_nazv;
		$this->data['pl2_all_area'] = $this->pl2_all_area;
		$this->data['pl2_area'] = $this->pl2_area;
		$this->data['count_personal'] = $this->count_personal;

        $this->update_time = new CDbExpression('NOW()');

        if ($this->getIsNewRecord()) {
            $this->create_time = $this->update_time;
        }

		$this->platform = CJSON::encode($this->data);

        return parent::beforeSave();
    }
	public function afterSave()
    {

    	// Аттрибуты для удаления
    	$setting = [
    		2 => ['pl1_nazv','pl1_all_area', 'pl1_area'],
    		1 => ['pl2_nazv_tc', 'pl2_nazv', 'pl2_all_area', 'pl2_area']
    	];

		foreach ($setting[$this->is_pl] as $key => $attr) {
			unset($this->data[$attr]);
		}

		$this->data['is_pl'] = $this->getIsPlList()[$this->is_pl];
		
        if (empty($this->getErrors())) {
            Yii::app()->mailMessage->raiseMailEvent('zayavka-o-partnerstve'.$this->is_pl, $this->data);
        }
        return parent::afterSave();
    }
}
