<?php

/**
 * DeliveryWidget
 */
class DeliveryWidget extends yupe\widgets\YWidget
{
    public $view = 'delivery-widget';
    public $order = null;

    public function init()
    {
        $assetsfm = Yii::app()->getAssetManager()->publish(
            Yii::getPathOfAlias('application.modules.delivery.views.assets')
        );
    }

    public function run()
    {
        $deliveryTypes = Delivery::model()->published()->findAll();

        $this->render($this->view, [
            'deliveryTypes' => $deliveryTypes,
            'order' => $this->order,
        ]);
    }
}
