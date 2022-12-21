<?php

/**
 * This is the model class for table "{{review_image}}".
 *
 * The followings are the available columns in table '{{review_image}}':
 * @property integer $id
 * @property integer $review_id
 * @property string $image
 * @property string $title
 * @property string $alt
 * @property integer $position
 *
 * The followings are the available model relations:
 * @property Review $review
 */
class ReviewImage extends yupe\models\YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{review_image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('review_id, position', 'numerical', 'integerOnly'=>true),
			array('image, title, alt', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, review_id, image, title, alt, position', 'safe', 'on'=>'search'),
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
			'review' => array(self::BELONGS_TO, 'Review', 'review_id'),
		);
	}

    /**
     * @return array
     */
    public function behaviors()
    {
        $module = Yii::app()->getModule('page');

        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => 'review/images',
            ],
            'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
            ],
        ];
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'review_id' => 'Id отзыва',
			'image' => 'Изображение',
			'title' => 'Title',
			'alt' => 'Alt',
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
		$criteria->compare('review_id',$this->review_id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReviewImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
