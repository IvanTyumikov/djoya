<?php

// Yii::import('application.modules.store.components.AttributeFilter');

/**
 * Class SearchProductWidget
 */
class OffersWidget extends \yupe\widgets\YWidget
{
    public $id;
    /**
     * @var string
     */
    public $view = 'offers-widget';

    /**
     * @throws CException
     */
    public function run()
    {
        if (Yii::app()->session['offers']===null) {
            $items = [];
        } else {
            $items = Yii::app()->session['offers'];
        }
        $this->render($this->view, [
            'items' => $items,
            'count' => count($items),
        ]);
    }
}
