<?php
Yii::import('application.modules.city.models.*');
/**
 * CityListWidget - вывод городов по категории на главной
 */
class CityListWidget extends \yupe\widgets\YWidget
{
	public $category_id;
	public $limit = null;
    /**
     * @var string
     */
    public $view = 'city-list';
    protected $models;

    public function init()
    {
        $this->limit = Yii::app()->getModule('city')->itemsPerCity_1; 
        
        if($this->category_id == 2){
            $this->limit = Yii::app()->getModule('city')->itemsPerCity_2; 
        }

        if (isset($_GET['limit'])) {
            $this->limit = $_GET['limit'];
        }
        return parent::init();
    }

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->limit = $this->limit;
        $criteria->order = 't.position ASC';

        $criteria->compare('category_id', $this->category_id);
        
        if(isset($_GET['geography-city-search'])){
            $criteria->addSearchCondition('t.name', $_GET['geography-city-search'], true);
        }

        $this->models = new CActiveDataProvider(
            'City', [
                'criteria' => $criteria,
                'pagination' => ['pageSize' => $this->limit],
            ]
        );

        $this->render($this->view, [
            'dataProvider' => $this->models,
            'id' => $this->category_id,
        ]);
    }
}
