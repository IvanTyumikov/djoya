<?php

Yii::import('application.modules.dealers.models.DealersCity');

class DealersCityWidget extends yupe\widgets\YWidget
{
    public $limit = null;
    /**
     * @var string
     */
    public $view = 'dealers-city-widget';
    protected $models;

    public function init()
    {
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
        
        if(isset($_GET['dealers-city-search'])){
            $criteria->addSearchCondition('t.name', $_GET['dealers-city-search'], true);
        }

        // $this->models = DealersCity::model()->published()->findAll($criteria);
        $this->models = new CActiveDataProvider(
            'DealersCity', [
                'criteria' => $criteria,
                'pagination' => ['pageSize' => $this->limit],
            ]
        );

        $city = [];
        foreach ($this->models->getData() as $key => $item) {
            $city[] = [
                'label' => $item->name,
                'value' => $item->name,
            ];
        }
        $this->render($this->view, [
            'dataProvider' => $this->models,
            'city' => $city,
        ]);
    }
}
