<?php
/* @var $deliverySettings Array */
/* @var $deliverySystem string */

$deliverySystemObject = Yii::app()->deliveryManager->getDeliverySystemObject($deliverySystem);
if ($deliverySystemObject) {
    $deliverySystemObject->renderSettings($deliverySettings);
}
