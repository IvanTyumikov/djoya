<?php

/**
 * Class PriceFilterWidget
 */
class PriceFilterWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'price-filter';

    /**
     * @throws CException
     */
    public function run()
    {
        $cost = Yii::app()->db->createCommand('SELECT max(price) as price FROM yupe_store_product where 1')->queryRow();
        $this->render($this->view, ['cost' => $cost]);
    }
}