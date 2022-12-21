<?php

Yii::import('application.modules.store.models.*');

class ProductWidget extends yupe\widgets\YWidget
{
    /**
     * @var
     */
    public $title;
    public $product_id;
    public $category_id;
    public $is_hit = false;
    public $order = false;
    /**
     * @var bool
     */
    public $limit = false;
    public $isButton = true;
    /**
     * @var string
     */
    public $view = 'default';

    /**
     * @return bool
     * @throws CException
     */
    public function run()
    {
        $criteria = new CDbCriteria();

        if ($this->limit) {
            $criteria->limit = $this->limit;
        }

        if ($this->order) {
            $criteria->order = $this->order;
        } else {
            $criteria->order = 't.position DESC';
        }

        if ($this->category_id) {
            $criteria->addCondition("t.category_id={$this->category_id}");
        }

        if ($this->is_hit) {
            $criteria->addCondition("t.is_hit={$this->is_hit}");
        }

        if ($this->product_id) {
            $this->product_id = explode(',', $this->product_id);
            $criteria->addNotInCondition('id', $this->product_id);
        }

        $products = Product::model()->published()->findAll($criteria);

        $this->render(
            $this->view,
            [
                'products' => $products,
                'isButton' => $this->isButton,
            ]
        );
    }
}
