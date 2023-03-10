<?php

/**
 *
 * @property integer $id
 * @property integer $attribute_id
 * @property string $value
 * @property integer $position
 *
 * @property-read Attribute $parent
 */
class AttributeOption extends \yupe\models\YModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{store_attribute_option}}';
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
            ['attribute_id, value', 'required'],
            ['color', 'safe'],
            ['attribute_id, position', 'numerical', 'integerOnly' => true],
            ['value, color', 'length', 'max' => 255],
        ];
    }


    /**
     * @return array
     */
    public function relations()
    {
        return [
            'parent' => [self::BELONGS_TO, 'AttributeStore', 'attribute_id'],
            'optionValue' => [self::HAS_MANY, 'AttributeValue', 'option_value'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('StoreModule.store', 'ID'),
            'position' => Yii::t('StoreModule.store', 'Position'),
            'value' => Yii::t('StoreModule.store', 'Value'),
            'color' => Yii::t('StoreModule.store', 'Цвет'),
        ];
    }

    /**
     * @return array customized attribute descriptions (name=>description)
     */
    public function attributeDescriptions()
    {
        return [
            'id' => Yii::t('StoreModule.store', 'ID'),
            'position' => Yii::t('StoreModule.store', 'Position'),
            'value' => Yii::t('StoreModule.store', 'Value'),
            'color' => Yii::t('StoreModule.store', 'Цвет'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
            ],
        ];
    }
}
