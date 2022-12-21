<?php

// Yii::import('application.modules.store.components.AttributeFilter');

/**
 * Class SearchProductWidget
 */
class OffersListWidget extends \yupe\widgets\YWidget
{
    public $id;
    /**
     * @var string
     */
    public $view = 'offers-list-widget';

    /**
     * @throws CException
     */
    public function run()
    {
        $products = [];
        if (Yii::app()->session['offers']===null) {
            $items = [];
        } else {
            $items = Yii::app()->session['offers'];
            $products = Product::model()->findAllByPk($items);
        }
        $this->render($this->view, [
            'products' => $products,
            'items' => $items,
            'count' => count($items),
        ]);
    }
}
