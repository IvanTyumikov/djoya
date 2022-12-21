<?php

/**
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name 
 * @property string $title
 * @property string $alt
 * @property string $path
 *
 * @property-read Product $product
 */
class ProductPhotosReviewsMarketplace extends \yupe\models\YModel
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{store_product_photos_reviews_marketplace}}';
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
            ['product_id', 'numerical', 'integerOnly' => true],
            ['alt, title, name', 'length', 'max' => 250],
            ['alt, title, name, path', 'safe'],            
        ];
    }


    /**
     * @return array
     */
    public function relations()
    {
        return [];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            // 'upload' => [
            //     'class' => 'yupe\components\behaviors\ImageUploadBehavior',
            //     'attributeName' => 'image',
            //     'uploadPath' => 'advertising',
            //     'resizeOnUpload' => true,
            //     'resizeOptions' => [
            //         'maxWidth' => 900,
            //         'maxHeight' => 900,
            //     ],
            // ],
            // 'sortable' => [
            //     'class' => 'yupe\components\behaviors\SortableBehavior',
            // ],            
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'ID продукта',
            'name' => 'Имя изображения',          
            'alt' => 'Короткое описание',
            'title' => 'Title изображения',
            'path' => 'Путь к изображению'       
        ];
    }

    
    
}


