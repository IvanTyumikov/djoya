<?php
/**
 * @var array $settings
 * @var Order $order
 */
?>
<?= CHtml::form(Yii::app()->createUrl('/credittinkoff/payment/init', ['orderId' => $order->id]), 'get') ?>
    <input type="text" name="payment_id" value="<?= $paymentId ?>">
<?= CHtml::endForm() ?>
