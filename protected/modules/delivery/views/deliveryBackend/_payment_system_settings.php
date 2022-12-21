<?php
/* @var $deliverySettings Array */
/* @var $deliverySystem string */

$deliverySystemObject = Yii::app()->deliveryManager->getPaymentSystemObject($deliverySystem);
if ($deliverySystemObject) {
    $deliverySystemObject->renderSettings($deliverySettings);
}
