<?php

/**
 * This is the model class for table "{{slider}}".
 *
 * The followings are the available columns in table '{{slider}}':
 * @property integer $id
 * @property string $name
 * @property string $name_short
 * @property string $image
 * @property string $description_short
 * @property string $status
 * @property string $position
 * @property string $description
 * @property string $button_name
 * @property string $button_link
 * @property string $image_xs
 * @property integer $discont
 * @property integer $discont_css
 */
class Slider extends yupe\models\YModel
{

	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{slider}}';
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
			['name, name_short, image, image_xs, button_name, button_link', 'length', 'max'=>255],
			['description_short, description, discont, discont_css', 'safe'],
			['position, status', 'numerical', 'integerOnly' => true],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			['id, name, name_short, image, description_short, status, position, description, button_name, button_link, image_xs', 'safe', 'on'=>'search'],
		];
	}

	public function behaviors()
    {
        $module = Yii::app()->getModule('slider');

        return [
            'imageUpload' => [
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath,
            ],
            'imageXsUpload' => [
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image_xs',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath . '/mobile',
            ],
            'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
            ],
        ];
    }

    public function getImageXsUrl($width = 0, $height = 0, $crop = true)
    {
        $module = Yii::app()->getModule('slider');
        $file = Yii::getPathOfAlias('webroot').'/uploads/'.$module->uploadPath.'/mobile/'.$this->image_xs;

        if ($width || $height) {
            return $this->thumbnailer->thumbnail(
                $file,
                $this->uploadPath .'/mobile',
                $width,
                $height,
                $crop
            );
        }

        return '/uploads/'.$module->uploadPath.'/mobile/'.$this->image_xs;
    }

    public function getImageXsUrlWebp($width = 0, $height = 0, $crop = true)
    {
        $file = $this->getImageXsUrl($width, $height, $crop);
        return $this->getImageUrlWebp($width, $height,$crop,null,null, null, $file);
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
			'category' => [self::BELONGS_TO, 'StoreCategory', ['cat_id' => 'id']],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                => 'ID',
			'name'              => Yii::t('SliderModule.slider', 'Name'),
			'name_short'        => Yii::t('SliderModule.slider', 'Short name'),
			'description_short' => Yii::t('SliderModule.slider', 'Full name'),
			'image'             => Yii::t('SliderModule.slider', 'Background image'),
			'status'            => Yii::t('SliderModule.slider', 'Status'),
			'position'          => Yii::t('SliderModule.slider', 'Sorting'),
			'description'       => Yii::t('SliderModule.slider', 'Description'),
			'button_name'       => Yii::t('SliderModule.slider', 'Button name'),
			'button_link'       => Yii::t('SliderModule.slider', 'Url'),
			'image_xs'          => Yii::t('SliderModule.slider', 'Image for mobile'),
			'discont'          => Yii::t('SliderModule.slider', 'Discont'),
			'discont_css'          => Yii::t('SliderModule.slider', 'Рассрочка'),
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

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name,true);
		$criteria->compare('name_short', $this->name_short,true);
		$criteria->compare('description_short', $this->description_short,true);
		$criteria->compare('image', $this->image,true);
		$criteria->compare('status', $this->status,true);
		$criteria->compare('position', $this->position,true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('button_name', $this->button_name, true);
		$criteria->compare('button_link', $this->button_link, true);
		$criteria->compare('image_xs', $this->image_xs, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 't.position'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slider the static model class
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
}
