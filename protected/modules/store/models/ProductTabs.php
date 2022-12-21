<?php
/**
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $title
 * @property text $body
 *
 * @property-read Product $product
 */

class ProductTabs extends \yupe\models\YModel
{
    /**
     * @return string the associated database table name
     */

    public function tableName()
    {
        return '{{store_product_tabs}}';
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
        return [
            ['product_id', 'numerical', 'integerOnly' => true],
            ['title', 'length', 'max' => 250],
            ['body', 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function relations()
    {
        return [
            'product' => [self::BELONGS_TO, 'Product', 'product_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('StoreModule.store', 'Заголовок таба'),
            'body' => Yii::t('StoreModule.store', 'Содержание таба'),
        ];
    }

    /**
     * @return array customized attribute descriptions (name=>description)
     */
    public function attributeDescriptions()
    {
        return [
            'title' => Yii::t('StoreModule.store', 'Заголовок таба'),
            'body' => Yii::t('StoreModule.store', 'Содержание таба'),
        ];
    }
}
