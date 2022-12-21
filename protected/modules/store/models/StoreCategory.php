<?php

use yupe\components\Event;
use yupe\widgets\YPurifier;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $slug
 * @property integer $status
 * @property integer $parent_id
 * @property integer $sort
 * @property string $external_id
 * @property string $title
 * @property string $meta_canonical
 * @property string $image_alt
 * @property string $image_title
 * @property string $view
 * @property string $image
 * @property string $image_two
 * @property integer $show_in_catalog
 *
 * @property-read StoreCategory $parent
 * @property-read StoreCategory[] $children
 *
 * @method StoreCategory published
 * @method StoreCategory roots
 * @method getImageUrl
 *
 */
class StoreCategory extends \yupe\models\YModel
{
    /**
     *
     */
    const STATUS_DRAFT = 0;
    /**
     *
     */
    const STATUS_PUBLISHED = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{store_category}}';
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return StoreCategory the static model class
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
            [
                'name, title, description, short_description, slug, meta_title, meta_keywords, meta_description',
                'filter',
                'filter' => 'trim',
            ],
            ['name, slug', 'filter', 'filter' => [$obj = new YPurifier(), 'purify']],
            ['name, slug', 'required'],
            ['parent_id, status, sort', 'numerical', 'integerOnly' => true],
            ['parent_id, status', 'length', 'max' => 11],
            ['parent_id', 'default', 'setOnEmpty' => true, 'value' => null],
            ['status, show_in_catalog', 'numerical', 'integerOnly' => true],
            ['status', 'length', 'max' => 11],
            ['name, title, image, image_two, image_alt, image_title, meta_title, meta_keywords, meta_canonical', 'length', 'max' => 250],
            ['meta_description', 'length', 'max' => 500],
            ['slug', 'length', 'max' => 150],
            ['external_id, view', 'length', 'max' => 100],
            [
                'slug',
                'yupe\components\validators\YSLugValidator',
                'message' => Yii::t('StoreModule.store', 'Bad characters in {attribute} field'),
            ],
            ['slug', 'unique'],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['meta_canonical', 'url'],
            ['id, parent_id, name, description, sort, short_description, slug, status', 'safe', 'on' => 'search'],
        ];
    }


    /**
     * @return array
     */
    public function behaviors()
    {
        $module = Yii::app()->getModule('store');

        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module !== null ? $module->uploadPath . '/category' : null,
            ],
            'imageUploadTwo' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image_two',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module !== null ? $module->uploadPath . '/category/two' : null,
            ],
            'tree' => [
                'class' => 'store\components\behaviors\DCategoryTreeBehavior',
                'aliasAttribute' => 'slug',
                'requestPathAttribute' => 'path',
                'parentAttribute' => 'parent_id',
                'parentRelation' => 'parent',
                'statAttribute' => 'productCount',
                'defaultCriteria' => [
                    'order' => 't.sort',
                    'with' => 'productCount',
                ],
                'titleAttribute' => 'name',
                'useCache' => true,
            ],
            'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
                'attributeName' => 'sort',
            ],
        ];
    }

    public function getImageTwoUrl($width = 0, $height = 0, $crop = true)
    {
        $module = Yii::app()->getModule('store');
        if ($this->image_two) {
            $file = Yii::getPathOfAlias('webroot') . '/uploads/' . $module->uploadPath . '/category/two/' . $this->image_two;

            if ($width || $height) {
                return $this->thumbnailer->thumbnail(
                    $file,
                    $module->uploadPath . '/category/two',
                    $width,
                    $height,
                    $crop
                );
            }

            return '/uploads/' . $module->uploadPath . '/category/two/' . $this->image_two;
        } else {
            $theme = Yii::app()->getTheme();
            return '';
        }
    }

    /**
     * @return array
     */
    public function relations()
    {
        return [
            'parent' => [self::BELONGS_TO, 'StoreCategory', 'parent_id'],
            'children' => [self::HAS_MANY, 'StoreCategory', 'parent_id'],
            'productCount' => [self::STAT, 'Product', 'category_id'],
            'product' => [self::HAS_MANY, 'Product', 'category_id'],
            'products' => [self::MANY_MANY, 'Product', 'yupe_store_product_category(category_id, product_id)'],
        ];
    }

    /**
     * @return array
     */
    public function scopes()
    {
        return [
            'published' => [
                'condition' => 'status = :status',
                'params' => [':status' => self::STATUS_PUBLISHED],
            ],
            'roots' => [
                'condition' => 'parent_id IS NULL',
            ],
            'child' => [
                'condition' => 'parent_id = :id',
                'params' => [':id' => $this->id],
            ]
        ];
    }

    /**
     *
     */
    public function afterSave()
    {
        Yii::app()->eventManager->fire(StoreEvents::CATEGORY_AFTER_SAVE, new Event($this));

        return parent::afterSave();
    }

    /**
     *
     */
    public function afterDelete()
    {
        Yii::app()->eventManager->fire(StoreEvents::CATEGORY_AFTER_DELETE, new Event($this));

        parent::afterDelete();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('StoreModule.store', 'Id'),
            'parent_id' => Yii::t('StoreModule.store', 'Parent'),
            'name' => Yii::t('StoreModule.store', 'Name'),
            'image' => Yii::t('StoreModule.store', 'Image'),
            'short_description' => Yii::t('StoreModule.store', 'Short description'),
            'description' => Yii::t('StoreModule.store', 'Description'),
            'slug' => Yii::t('StoreModule.store', 'Alias'),
            'meta_title' => Yii::t('StoreModule.store', 'Meta title'),
            'meta_keywords' => Yii::t('StoreModule.store', 'Meta keywords'),
            'meta_description' => Yii::t('StoreModule.store', 'Meta description'),
            'status' => Yii::t('StoreModule.store', 'Status'),
            'sort' => Yii::t('StoreModule.store', 'Order'),
            'external_id' => Yii::t('StoreModule.store', 'External id'),
            'title' => Yii::t('StoreModule.store', 'SEO_title'),
            'meta_canonical' => Yii::t('StoreModule.store', 'Canonical'),
            'image_alt' => Yii::t('StoreModule.store', 'Image alt'),
            'image_title' => Yii::t('StoreModule.store', 'Image title'),
            'view' => Yii::t('StoreModule.store', 'Template'),
            'show_in_catalog' => 'Показать в каталоге',
        ];
    }

    /**
     * @return array customized attribute descriptions (name=>description)
     */
    public function attributeDescriptions()
    {
        return [
            'id' => Yii::t('StoreModule.store', 'Id'),
            'parent_id' => Yii::t('StoreModule.store', 'Parent'),
            'name' => Yii::t('StoreModule.store', 'Title'),
            'image' => Yii::t('StoreModule.store', 'Image'),
            'short_description' => Yii::t('StoreModule.store', 'Short description'),
            'description' => Yii::t('StoreModule.store', 'Description'),
            'slug' => Yii::t('StoreModule.store', 'Alias'),
            'meta_title' => Yii::t('StoreModule.store', 'Meta title'),
            'meta_keywords' => Yii::t('StoreModule.store', 'Meta keywords'),
            'meta_description' => Yii::t('StoreModule.store', 'Meta description'),
            'status' => Yii::t('StoreModule.store', 'Status'),
            'sort' => Yii::t('StoreModule.store', 'Order'),
            'title' => Yii::t('StoreModule.store', 'SEO_title'),
            'meta_canonical' => Yii::t('StoreModule.store', 'Canonical'),
            'image_alt' => Yii::t('StoreModule.store', 'Image alt'),
            'image_title' => Yii::t('StoreModule.store', 'Image title'),
            'view' => Yii::t('StoreModule.store', 'Template'),
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('meta_title', $this->meta_title, true);
        $criteria->compare('meta_keywords', $this->meta_keywords, true);
        $criteria->compare('meta_description', $this->meta_description, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('sort', $this->sort);

        return new CActiveDataProvider(
            StoreCategory::_CLASS_(),
            [
                'criteria' => $criteria,
                'sort' => ['defaultOrder' => 't.sort'],
            ]
        );
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT => Yii::t('StoreModule.store', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('StoreModule.store', 'Published'),
        ];
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('StoreModule.store', '*unknown*');
    }

    /**
     * @return string
     */
    public function getParentName()
    {
        return $this->parent ? $this->parent->name : '---';
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title ?: $this->name;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->meta_title ?: $this->name;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * Get canonical url
     *
     * @return string
     */
    public function getMetaCanonical()
    {
        return $this->meta_canonical;
    }

    /**
     * Get image alt tag text
     *
     * @return string
     */
    public function getImageAlt()
    {
        return $this->image_alt ?: $this->getTitle();
    }

    /**
     * Get image title tag text
     *
     * @return string
     */
    public function getImageTitle()
    {
        return $this->image_title ?: $this->getTitle();
    }

    // Формируем линк на категорию
    public function getCategoryUrl()
    {
        $slug = $this->slug;
        $parent = $this->parent;
        $city = Yii::app()->getComponent('cityRepository')->getCityFromUrl($_SERVER['REQUEST_URI'])->slug;
        if ($city) {
            $city = '/' . $city;
        }

        while ($parent) {
            $slug = $parent->slug . '/' . $slug;
            $parent = $parent->parent;
        }

        return $city . '/store/' . $slug;
    }

    // Добавляем массив с категориями
    public function isProducts()
    {
        $count = $this->productCount;
        foreach ($this->children as $key => $child) {
            $count += $child->productCount;
        }
        return (bool)$count;
    }

    public function getChildProducts()
    {
        $ids = $this->getChildsArray();
        $ids[] = $this->id;
        $criteria = new CDbCriteria();

        $criteria->limit = 30;

        $criteria->order = 't.position ASC';
        $criteria->addInCondition('category_id', $ids);
        // $criteria->addCondition('is_home = 1');
        return Product::model()->published()->findAll($criteria);
    }

    public function getAllProducts()
    {
        return array_merge($this->product, $this->products);
    }

    public function num_decline($number, $titles, $param2 = '', $param3 = '')
    {

        if ($param2)
            $titles = [$titles, $param2, $param3];

        if (is_string($titles))
            $titles = preg_split('/, */', $titles);

        if (empty($titles[2]))
            $titles[2] = $titles[1]; // когда указано 2 элемента

        $cases = [2, 0, 1, 1, 1, 2];

        $intnum = abs(intval(strip_tags($number)));

        return "$number " . $titles[($intnum % 100 > 4 && $intnum % 100 < 20) ? 2 : $cases[min($intnum % 10, 5)]];
    }
    public function getCountNotInStock()
    {
        $ids = array_merge($this->getChildsArray(), [$this->id]);
        return Yii::app()->getDb()->createCommand()
            ->select('count(*)')
            ->from('{{store_product}}')
            ->where(['and', ['in', 'category_id', $ids], 'in_stock = 0'])
            ->queryScalar();
    }
}
