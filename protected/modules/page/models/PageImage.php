<?php

/**
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $image
 * @property string $title
 * @property string $alt
 *
 * @property-read Product $product
 * @method getImageUrl($width = 0, $height = 0, $options = [])
 */
class PageImage extends \yupe\models\YModel
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{page_page_image}}';
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Attribute the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['page_id, position', 'numerical', 'integerOnly' => true],
            ['image, title, alt', 'length', 'max' => 250],
            ['image, title, alt', 'safe'],
        ];
    }


    /**
     * @return array
     */
    public function relations()
    {
        return [
            'product' => [self::BELONGS_TO, 'Page', 'page_id'],
        ];
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
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => 'page/photo',
                'resizeOnUpload' => true,
                'resizeOptions' => [
                    'maxWidth' => 1900,
                    'maxHeight' => 1900,
                ],
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
        return [
            'image' => Yii::t('StoreModule.store', 'image'),
            'title' => Yii::t('StoreModule.store', 'Title'),
            'alt' => Yii::t('StoreModule.store', 'alt'),
        ];
    }

    /**
     * @return array customized attribute descriptions (name=>description)
     */
    public function attributeDescriptions()
    {
        return [
            'image' => Yii::t('StoreModule.store', 'image'),
            'title' => Yii::t('StoreModule.store', 'Title'),
            'alt' => Yii::t('StoreModule.store', 'alt'),
        ];
    }
}
