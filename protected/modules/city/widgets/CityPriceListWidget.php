<?php
Yii::import('application.modules.city.models.*');
/**
 * CityPriceListWidget - вывод всех прайсов
 */
class CityPriceListWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'price-widget';
    protected $models;

    public function init()
    {
        return parent::init();
    }

    public function run()
    {
        $this->models = City::model()->published()->findAll();

        $this->render($this->view, [
            'models' => $this->models,
        ]);
    }
}
