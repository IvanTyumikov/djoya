<?php

/**
 * DeliveryMethodWidget
 */
class DeliveryMethodWidget extends yupe\widgets\YWidget
{
    public $deliveryId = null;

    public function init()
    {
        if (isset($_POST['Order']['delivery_id'])) {
            $this->deliveryId = $_POST['Order']['delivery_id'];
        }

        if ($this->deliveryId===null) {
            throw new CException('deliveryId обязательный параметр виджета');
        }
    }

    public function run()
    {
        $order = new Order;
        $order->setAttributes($_POST['Order']);
        $deliveryType = Delivery::model()->published()->findByPk($this->deliveryId);
        
        $this->render('delivery-method-widget', [
            'deliveryType' => $deliveryType,
            'order' => $order,
        ]);
    }
}
