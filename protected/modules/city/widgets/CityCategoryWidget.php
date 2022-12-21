<?php
Yii::import('application.modules.city.models.*');
Yii::import('application.modules.city.CityModule');
/**
 * CityWidget
 */
class CityCategoryWidget extends \yupe\widgets\YWidget
{
    public $order = 't.position ASC';
    public $limit;
    public $id;
    public $ids;
    public $view = 'city-category-widget';

    protected $models = [];

    public function run()
    {
        if($this->ids) {
            $this->ids = explode(',', $this->ids);
            if(is_array($this->ids) and !empty($this->ids)) {
                $this->models = CityCategory::model()->findAllByPk($this->ids, ['order' => $this->order]);
            }
        } elseif($this->id) {
            $this->models = CityCategory::model()->published()->findByPk($this->id);
        } else {
            $criteria = new CDbCriteria();

            $criteria->order = $this->order;

            if($this->limit){
                $criteria->limit = $this->limit;
            }
            $this->models = CityCategory::model()->published()->findAll($criteria);
        }
        
        $this->render($this->view, [
            'models' => $this->models,
            'order' => $this->order
        ]);
    }
}
