<?php

/**
 * CartProdictList
 */
class CartStaticWidget extends yupe\widgets\YWidget
{
    public $view = 'cart-static';
    public $positions = [];

    public function init()
    {
        if (empty($this->positions)) {
            $this->positions = Yii::app()->cart->getPositions();
        }
    }

    public function run()
    {
        $this->render($this->view, ['positions' => $this->positions]);
    }
}
