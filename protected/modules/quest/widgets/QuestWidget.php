<?php

Yii::import('application.modules.quest.models.Quest');

class QuestWidget extends yupe\widgets\YWidget
{
    public $limit;
    public $order = 'id';
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

        $criteria->addCondition("(t.body IS NOT NULL AND t.body != '')");

        $this->models = Quest::model()->published()->findAll($criteria);
        
        parent::init();
    }

    public function run()
    {
        $this->render($this->view, [
            'models' => $this->models
        ]);
    }
}
