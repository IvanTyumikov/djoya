<?php

/**
 * This is the model class for table "{{city_category}}".
 *
 * The followings are the available columns in table '{{city_category}}':
 * @property integer $id
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property string $create_time
 * @property string $update_time
 * @property string $name_short
 * @property string $name
 * @property string $image
 * @property string $description
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $status
 * @property integer $position
 */
class CityCategory extends yupe\models\YModel
{
	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{city_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['name', 'required'],
			['create_user_id, update_user_id, status, position', 'numerical', 'integerOnly'=>true],
			['name_short, name, image, meta_title', 'length', 'max'=>255],
			['description, meta_keywords, meta_description', 'safe'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, create_user_id, update_user_id, create_time, update_time, name_short, name, image, description, meta_title, meta_keywords, meta_description, status, position', 'safe', 'on'=>'search'],
		];
	}

	/**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'city' => [self::HAS_MANY, 'City', 'category_id'],
        ];
    }

	public function behaviors()
	{
	    $module = Yii::app()->getModule('city');

	    return [
	        'imageUpload' => [
	            'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
	            'attributeName' => 'image',
	            'minSize'       => $module->minSize,
	            'maxSize'       => $module->maxSize,
	            'types'         => $module->allowedExtensions,
	            'uploadPath'    => $module->uploadPath,
	        ],
	        'sortable' => [
	            'class' => 'yupe\components\behaviors\SortableBehavior',
	        ],
	    ];
	}
	/**
     * @return bool
     */
     public function beforeSave()
    {

        $this->update_time = new CDbExpression('NOW()');
        $this->update_user_id = Yii::app()->getUser()->getId();

        if ($this->getIsNewRecord()) {
            $this->create_time = $this->update_time;
            $this->create_user_id = Yii::app()->getUser()->getId();
        }

        return parent::beforeSave();
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_user_id' => 'Create User',
			'update_user_id' => 'Update User',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'name_short' => 'Короткое Название',
			'name' => 'Название',
			'image' => 'Изображение',
			'description' => 'Описание',
			'meta_title' => 'Title (SEO)',
			'meta_keywords' => 'Ключевые слова SEO',
			'meta_description' => 'Описание SEO',
			'status' => 'Статус',
			'position' => 'Сортировка',
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
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('name_short',$this->name_short,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 't.position ASC'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CityCategory the static model class
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

	public function getCityList()
	{
		$city = [];
		foreach (City::model()->findAll() as $key => $item) {
            $city[] = [
                'label' => $item->name,
                'value' => $item->name,
            ];
        }
        return $city;
	}
}
