<?php

Yii::import('application.modules.store.models.*');

class CategoryListWidget extends yupe\widgets\YWidget
{   
    public $category_id = null;
    public $limit;
    
    public $view = 'category-filter';
    protected $category;

    public function run()
    {
        $criteria = new CDbCriteria();

        if($this->limit){
            $criteria->limit = $this->limit;
        }
        $criteria->order = 't.sort ASC';

        if($this->category_id){
            $criteria->compare('parent_id', $this->category_id);
            $this->category = StoreCategory::model()->published()->findAll($criteria);
        } else{
            $this->category = StoreCategory::model()->published()->roots()->findAll($criteria);
        }
        
        $this->render($this->view, [
            'category' => $this->category
        ]);
    }
}