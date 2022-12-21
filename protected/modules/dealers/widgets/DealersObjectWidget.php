<?php

Yii::import('application.modules.dealers.models.Dealers');

class DealersObjectWidget extends yupe\widgets\YWidget
{
    public $limit = null;
    /**
     * @var string
     */
    public $view = 'dealers-object-widget';
    public $city_id;

    public $models;

    public function init()
    {
        return parent::init();
    }

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 't.position ASC';

        if($this->city_id){
            $this->models = Dealers::model()->findAllByAttributes(['city_id' => $this->city_id], $criteria);
        } else{
            $this->models = Dealers::model()->findAll();
        }

        $this->render($this->view, [
            'models' => $this->models,
        ]);
    }
}
