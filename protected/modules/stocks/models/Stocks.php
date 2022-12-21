<?php
/**
 * Stocks основная моделька для акций
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.stocks.models
 * @since 1
 *
 */

/**
 * This is the model class for table "Stocks".
 *
 * The followings are the available columns in table 'Stocks':
 * @property integer $id
 * @property string $create_time
 * @property string $update_time
 * @property string $date
 * @property string $title
 * @property string $slug
 * @property string $short_text
 * @property string $full_text
 * @property integer $status
 * @property string $image
 * @property string $description
 * @property string $title_seo
 * @property string $badge
 * @property string $badge_color
 * @property string $bg_stock
 */

use yupe\components\Event;
use yupe\widgets\YPurifier;

class Stocks extends yupe\models\YModel
{

	/**
     *  Статус - черновик
     */
    const STATUS_DRAFT = 0;
    /**
     *  Статус - опубликовано
     */
    const STATUS_PUBLISHED = 1;
    /**
     *  Статус - на модерации
     */
    const STATUS_MODERATION = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{stocks}}';
	}

	/**
	 * @return array validation rules for model attributes.
	*/
	public function rules()
	{
		return [
			['title, slug, short_text, full_text, description', 'filter', 'filter' => 'trim'],
            ['date, title, slug, full_text', 'required', 'on' => ['update', 'insert']],
            ['status', 'numerical', 'integerOnly' => true],
            ['title, slug, badge', 'length', 'max' => 150],
            ['lang', 'length', 'max' => 2],
            ['badge, badge_color', 'safe'],
            ['lang', 'default', 'value' => Yii::app()->sourceLanguage],
            ['lang', 'in', 'range' => array_keys(Yii::app()->getModule('yupe')->getLanguagesList())],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['slug', 'yupe\components\validators\YUniqueSlugValidator'],
            [
                'slug',
                'yupe\components\validators\YSLugValidator',
                'message' => Yii::t('StocksModule.stocks', 'Bad characters in {attribute} field')
            ],
            [
                'id, description, create_time, update_time, date, title, slug, short_text, full_text, status, lang, badge_color',
                'safe',
                'on' => 'search'
            ],
		];
	}

    /**
     * @return array
    */
    public function behaviors()
    {
        $module = Yii::app()->getModule('stocks');

        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module->uploadPath,
                'deleteFileKey' => 'delete-image',
            ],
            'imageBgStockUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'bg_stock',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module->uploadPathBgStock,
                'deleteFileKey' => 'delete-image-bg-stock',
            ],
        ];
    }

    public function getIBgStockUrl($width = 0, $height = 0, $crop = true)
    {
        $module = Yii::app()->getModule('stocks');
        $file = Yii::getPathOfAlias('webroot').'/uploads/'.$module->uploadPathBgStock.'/'.$this->bg_stock;

        if ($width || $height) {
            return $this->thumbnailer->thumbnail(
                $file,
                $module->uploadPathBgStock,
                $width,
                $height,
                $crop
            );
        }

        return '/uploads/'.$module->uploadPathBgStock.'/'.$this->bg_stock;
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return [

        ];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_time' => Yii::t('StocksModule.stocks', 'Create time'),
			'update_time' => Yii::t('StocksModule.stocks', 'Update time'),
			'date' => Yii::t('StocksModule.stocks', 'Date'),
			'title' => Yii::t('StocksModule.stocks', 'Title actions'),
			'slug' => Yii::t('StocksModule.stocks', 'Slug'),
			'image' => Yii::t('StocksModule.stocks', 'Image stocks'),
			'lang' => Yii::t('StocksModule.stocks', 'Language'),
			'short_text' => Yii::t('StocksModule.stocks', 'Short text'),
			'full_text' => Yii::t('StocksModule.stocks', 'Full text'),
			'status' => Yii::t('StocksModule.stocks', 'Status'),
			'description' => Yii::t('StocksModule.stocks', 'Seo description'),
            'badge' => Yii::t('StocksModule.stocks', 'Name badge'),
            'badge_color' => Yii::t('StocksModule.stocks', 'Color background badge'),
            'bg_stock' => Yii::t('StocksModule.stocks', 'Background stock'),
		);
	}

	public function beforeValidate()
    {
        if (!$this->slug) {
            $this->slug = yupe\helpers\YText::translit($this->title);
        }

        if (!$this->lang) {
            $this->lang = Yii::app()->getLanguage();
        }

        return parent::beforeValidate();
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $this->update_time = new CDbExpression('NOW()');
        $this->date = date('Y-m-d', strtotime($this->date));

        if ($this->getIsNewRecord()) {
            $this->create_time = $this->update_time;
        }

        return parent::beforeSave();
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

		$criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        if ($this->date) {
            $criteria->compare('date', date('Y-m-d', strtotime($this->date)));
        }
        $criteria->compare('title', $this->title, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('short_text', $this->short_text, true);
        $criteria->compare('full_text', $this->full_text, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('lang', $this->lang);
        $criteria->compare('badge_color', $this->badge_color);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'sort' => ['defaultOrder' => 'date DESC'],
        ]);
	}

	/**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT => Yii::t('StocksModule.stocks', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('StocksModule.stocks', 'Published'),
            self::STATUS_MODERATION => Yii::t('StocksModule.stocks', 'On moderation'),
        ];
    }

	/**
     * @return mixed|string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('StocksModule.stocks', '*unknown*');
    }

    /**
     * @return string
     */
    public function getFlag()
    {
        return yupe\helpers\YText::langToflag($this->lang);
    }

    public function listStocks($lang){
        $criteria = new CDbCriteria();
		$criteria->order = 'title ASC';
		$stocks = self::model()->findAllByAttributes(['lang' => $lang], $criteria);
		
		return CHtml::listData($stocks, 'id', 'title');
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function language($lang)
    {
        $this->getDbCriteria()->mergeWith(
            [
                'condition' => 'lang = :lang',
                'params' => [':lang' => $lang],
            ]
        );

        return $this;
    }  
}
