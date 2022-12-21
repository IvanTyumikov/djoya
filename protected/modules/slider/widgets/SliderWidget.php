<?php

Yii::import('application.modules.slider.models.Slider');

class SliderWidget extends yupe\widgets\YWidget
{
    public $limit = 10;
    /**
     * @var string
     */
    public $view = 'slider-widget';
    protected $models;

    public function init()
    {
        $criteria = new CDbCriteria();
        $criteria->limit = $this->limit;
        $criteria->order = 't.position ASC';

        $this->models = Slider::model()->published()->findAll($criteria);

        parent::init();
    }

    public function run()
    {
        $this->render($this->view, [
            'models' => $this->models
        ]);
    }
}
