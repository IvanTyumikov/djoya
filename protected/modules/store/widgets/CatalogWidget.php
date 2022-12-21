<?php

Yii::import('application.modules.store.models.*');

class CatalogWidget extends yupe\widgets\YWidget
{
    public $id;
    public $ids;
    public $notIds;
    public $is_home; // Выборка по полю - Показывать на главной
    public $category_id = null; // Вывод дочерних категорий
    public $limit; // Лимит
    public $currentCategoryId = null; // ID Текущей категории

    public $view = 'category';
    protected $category;

    public function run()
    {
        $criteria = new CDbCriteria();

        if ($this->limit) {
            $criteria->limit = $this->limit;
        }

        $criteria->order = 't.sort ASC';
        $criteria->compare('is_home', $this->is_home);
        $criteria->addCondition('show_in_catalog = 1');

        if ($this->id) {
            $this->category = StoreCategory::model()->published()->findByPk($this->id);
        } else if ($this->category_id) {
            $criteria->compare('parent_id', $this->category_id);
            $this->category = StoreCategory::model()->published()->findAll($criteria);
        } else {
            $this->category = StoreCategory::model()->published()->roots()->findAll($criteria);
        }

        $this->render($this->view, [
            'category' => $this->category,
        ]);
    }
}
