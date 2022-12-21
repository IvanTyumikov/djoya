<?php

/**
 * This is the model class for table "{{city}}".
 *
 * The followings are the available columns in table '{{city}}':
 * @property integer $id
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property string $create_time
 * @property string $update_time
 * @property integer $category_id
 * @property string $name_short
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $mode
 * @property string $address
 * @property string $code_map
 * @property string $coords
 * @property string $description
 * @property integer $status
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $position
 * @property integer $slug
 * @property integer $parent_id
 * @property integer $price_file
 * @property integer $vk
 * @property integer $instagram
 * @property integer $facebook
 * @property integer $ok
 * @property integer $image
 */

use yupe\helpers\YText;

class City extends yupe\models\YModel
{
	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;
	public $priceFile;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{city}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['name_short, name, slug', 'required'],

			['create_user_id, update_user_id, category_id, status, position, parent_id, is_default', 'numerical', 'integerOnly'=>true],
			['name_short, name, email, mode, coords, meta_title, price_file, vk, instagram, facebook, ok, image', 'length', 'max'=>255],

			['slug', 'yupe\components\validators\YSLugValidator'],
            ['slug', 'unique'],
            ['priceFile', 'file', 
                'allowEmpty'=>true, 
                'types'=>'pdf, doc, docx',
                'maxSize' => 1024 * 1024 * 300000, // 10MB                
            ],
			['email, phone, address, code_map, description, meta_keywords, meta_description, slug, parent_id, price_file, priceFile, vk, instagram, facebook, ok, image, is_default', 'safe'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, create_user_id, update_user_id, create_time, update_time, category_id, name_short, name, phone, email, mode, address, code_map, coords, description, status, meta_title, meta_keywords, meta_description, position, slug, parent_id, price_file, vk, instagram, facebook, ok, image, is_default', 'safe', 'on'=>'search'],

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
			'parentCity'   => [self::BELONGS_TO, 'City', 'parent_id'],
            'childrenCity' => [self::HAS_MANY, 'City', 'parent_id'],
			'category'     => [self::BELONGS_TO, 'CityCategory', ['category_id' => 'id']],
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
                'uploadPath'    => $module->uploadPathCity,
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

        $module = Yii::app()->getModule('city');
 
        if (isset($_POST['delete-file-price']) and $_POST['delete-file-price']=='on') {
        	$this->deletePriceFile();
        }

    	$file = CUploadedFile::getInstance($this, 'priceFile');
    	if ($file!==null) {
	    	// $fileName = YText::translit(pathinfo($file->name, PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getExtensionName();
	    	$fileName = YText::translit(pathinfo($file->name, PATHINFO_FILENAME)) . '.' . $file->getExtensionName();
	    	$path = Yii::getPathOfAlias("webroot.uploads.{$module->uploadPath}.price").DIRECTORY_SEPARATOR.$fileName;
	    	$file->saveAs($path);
			$this->price_file = basename($path);
    	}

        return parent::beforeSave();
    }

    public function getPathPriceFile()
    {
    	$module = Yii::app()->getModule('city');

    	if($this->price_file){
	    	$path = '/uploads/' . $module->uploadPath . '/price/' . $this->price_file.'?v='.time();
	    	return $path;
    	} else{
    		return false;
    	}
    }

    public function getPriceInfo()
    {
    	$module = Yii::app()->getModule('city');

    	$path = Yii::getPathOfAlias("webroot.uploads.{$module->uploadPath}.price").DIRECTORY_SEPARATOR;

    	if($this->price_file){
			$linkFile = $path.$this->price_file;
	        $size = round((@filesize($linkFile) / 1024) / 1024, 2);
	        $info = '<span>' . pathinfo($linkFile, PATHINFO_EXTENSION). '</span> ' . $size . ' Мб';
        	return $info;
	    }
    }
    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'create_user_id' => 'Create User',
			'update_user_id' => 'Update User',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'category_id' => 'Категория',
			'name_short' => 'Короткое название',
			'name' => 'Название',
			'phone' => 'Телефон:',
			'email' => 'E-mail:',
			'mode' => 'График работы:',
			'address' => 'Адрес:',
			'code_map' => 'Код карты',
			'coords' => 'Координаты на карте',
			'description' => 'Описание',
			'status' => 'Статус',
			'meta_title' => 'Title (SEO)',
			'meta_keywords' => 'Ключевые слова SEO',
			'meta_description' => 'Описание SEO',
			'position' => 'Сортировка',
			'slug' => 'Alias',
			'parent_id' => 'Родитель',
			'is_default' => 'Город по-умолчанию',
			'image' => 'Изображение',

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

		$criteria->compare('id',$this->id);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('name_short',$this->name_short,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('code_map',$this->code_map,true);
		$criteria->compare('coords',$this->coords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('slug',$this->slug);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('vk', $this->vk);
		$criteria->compare('instagram', $this->instagram);
		$criteria->compare('facebook', $this->facebook);
		$criteria->compare('ok', $this->ok);
		$criteria->compare('is_default', $this->is_default);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 't.position ASC'],
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return City the static model class
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
	public function getCategoryList()
	{
		return CHtml::listData(CityCategory::model()->published()->findAll(), 'id', 'name');
	}

	public function getFormattedList($parentId = null, $level = 0, $criteria = null)
    {
        if (empty($parentId)) {
            $parentId = null;
        }

        $models = $this->findAllByAttributes(['parent_id' => $parentId], $criteria);

        $list = [];

        foreach ($models as $model) {

            $model->name = str_repeat('&emsp;', $level) . $model->name;

            $list[$model->id] = $model->name;

            $list = CMap::mergeArray($list, $this->getFormattedList($model->id, $level + 1, $criteria));
        }

        return $list;
    }

	public function getCategoryParentList()
    {
        return CHtml::listData(self::model()->published()->findAll(), 'id', 'name');
    }

    public function afterDelete()
    {
    	$this->deletePriceFile();
    	return parent::afterDelete();
    }

    public function deletePriceFile()
    {
    	$module = Yii::app()->getModule('city');
    	$path = Yii::getPathOfAlias("webroot.uploads.{$module->uploadPath}.price").DIRECTORY_SEPARATOR.$this->price_file;
    	$this->price_file = null;
    	unlink($path);
    	return true;
    }


    public function getAvailableCities(){
        $cities = [];
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'status = :public';
        $criteria->params = [ ':public' => self::STATUS_PUBLIC ];
        $listPublicCities = self::model()->findAll($criteria);
        if(count($listPublicCities)>0){
            foreach($listPublicCities as $key=>$city){
                $cities[$key] = $city->slug;
            }
        }
        
        return $cities;
    }    
    
    public function getDefaultCity(){
        
        $defaultCity = '';
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'is_default = 1';
        $criteria->order = "id DESC";
        $criteria->limit = 1;
        
        $defaultCities = self::model()->find($criteria);
        
        if(!empty($defaultCities)>0){
            $defaultCity = $defaultCities->slug;
        }
        
        return $defaultCity;
    }
    
    public function getMainDefaultCity(){
        
        $defaultCity = '';
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'is_default = 1';
        $criteria->order = "id DESC";
        $criteria->limit = 1;

        $defaultCity = self::model()->find($criteria);
        
        if(empty($defaultCity)){
            $defaultCity = self::model()->find();
        }
        
        return $defaultCity;
    }
    
    public function getAddress()
    {
    	$name = trim($this->name);

    	return "г. {$name}, {$this->address}";
    }
}
