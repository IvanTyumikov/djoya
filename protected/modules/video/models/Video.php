<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $status
 * @property integer $code_vimeo
 * @property integer $is_footer
 */
class Video extends \yupe\models\YModel
{
	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{video}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('status, position, category_id', 'numerical', 'integerOnly'=>true),
			array('name, image', 'length', 'max'=>255),
			array('code', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, image, status, position, category_id', 'safe', 'on'=>'search'),
		);
	}

	public function behaviors()
    {
        $module = Yii::app()->getModule('video');
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'category' => [self::BELONGS_TO, 'VideoCategory', ['category_id' => 'id']],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function beforeSave(){
		$module = Yii::app()->getModule('video');
		
    	/*if(!$this->image && $this->code){
	    	$link = "https://i.ytimg.com/vi/{$this->getCodeYoutube()}/";
			
			if(file_get_contents($link . "maxresdefault.jpg") !== false){ 
		        $result = $link . "maxresdefault.jpg";
		    } else if(file_get_contents($link . "sddefault.jpg") !== false){
	    		$result = $link . "sddefault.jpg";
		    } else {
		    	$result = $link . "hqdefault.jpg";
		    }

		    $filename = md5(time());
		    $ext = pathinfo($result, PATHINFO_EXTENSION);

		    if(copy($result, Yii::getPathOfAlias("webroot.uploads.{$module->uploadPath}").DIRECTORY_SEPARATOR.$filename . '.' . $ext)){
		    	$this->image = $filename.'.'.$ext;
		    }
        }*/

        return parent::beforeSave();
	}

	public function attributeLabels()
	{
		return array(
			'id'       => 'ID',
			'name'     => 'Название',
			'image'    => 'Изображение(миниатюра)',
			'status'   => 'Статус',
			'position' => 'Сортировка',
			'category_id' => 'Категория',
			'code'       => 'Код видео (Youtube)',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('position',$this->position);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 't.position DESC'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Video the static model class
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
		return CHtml::listData(VideoCategory::model()->published()->findAll(), 'id', 'name');
	}

	public function getImageYoutube()
    {
    	$result = Yii::app()->getTheme()->getAssetsUrl() . '/images/nophoto.jpg';

    	if($this->getCodeYoutube()){
        	$link = "https://i.ytimg.com/vi/{$this->getCodeYoutube()}/";
			
			if(file_get_contents($link . "maxresdefault.jpg") !== false){ 
		        $result = $link . "maxresdefault.jpg";
		    } else if(file_get_contents($link . "sddefault.jpg") !== false){
	    		$result = $link . "sddefault.jpg";
		    } else {
		    	$result = $link . "hqdefault.jpg";
		    }
        }

	    return $result;    
    }

    public function getLinkYoutube()
    {
    	if($this->getCodeYoutube()){
    		return "https://www.youtube-nocookie.com/embed/{$this->getCodeYoutube()}";
    	}

    	return "#";
    }

    public function getCodeYoutube()
    {
    	if(preg_match('/(\/|=)([_\w-]{11})($|&|")/', $this->code, $match)){
    		return $match[2];
    	} 
    	return null;
    }

    public function getLinkVimeo(){
		if (preg_match('@vimeo.com\/(.+)@', $this->code_vimeo, $match)) {
		  return "http://player.vimeo.com/video/".$match[1];
		}
    }
}
