<?php

Yii::import('application.modules.video.models.Video');

class VideoWidget extends yupe\widgets\YWidget
{
    public $limit;
    public $is_footer;
    public $order = 'position DESC';
    /**
     * @var string
     */
    public $slide = false;
    public $category_id;
    public $view = 'view';

    protected $models;

    public function init()
    {
        $criteria = new CDbCriteria();
        if($this->limit){
            $criteria->limit = $this->limit;
        }
        $criteria->order = $this->order;

        if($this->slide == true){
            $this->view = 'view-carousel';
        }

        if($this->category_id){
            $criteria->addCondition("t.category_id = {$this->category_id}");
        }
        $criteria->addCondition("(t.code IS NOT NULL AND t.code != '')");

        $criteria->compare('t.is_footer', $this->is_footer);

        $this->models = Video::model()->published()->findAll($criteria);

        parent::init();
    }

    public function run()
    {
        $this->render($this->view, [
            'models' => $this->models
        ]);
    }
}
