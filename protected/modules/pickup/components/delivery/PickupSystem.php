<?php

/**
 * Class PickupPiclupSystem
 */

Yii::import('application.modules.pickup.PickupModule');
Yii::import('application.modules.pickup.models.Pickup');
Yii::import('application.modules.delivery.components.DeliverySystem');

/**
 * Class PickupPiclupSystem
 */
class PickupSystem extends DeliverySystem
{
    public function renderCheckoutForm(Delivery $delivery, Order $order, $return = false)
    {
        $pickups = Pickup::model()->published()->findAll();
        $json = [];
        foreach ($pickups as $key => $pickup) {
            if ($pickup->latitude && $pickup->longitude) {
                $json[$key+1]['id']        = $pickup->id;
                $json[$key+1]['name']      = $pickup->name;
                $json[$key+1]['coords']    = [$pickup->latitude, $pickup->longitude];
                $json[$key+1]['mode']      = $pickup->mode;
                $json[$key+1]['phone']     = $pickup->phone;
                $json[$key+1]['address']   = $pickup->address;
                $json[$key+1]['email']     = $pickup->email;
            }
        }

        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap = [
                // В карте отключаем загрузку core-скриптов, УЖЕ подключенных до ajax загрузки
                'jquery.js' => false,
                'jquery.ui.js' => false,
                // На моей странице была ещё одна форма, поэтому jquery.yiiactiveform.js я исключил
                'jquery.yiiactiveform.js' => false,
            ];
        }

        return Yii::app()->getController()->renderPartial(
            'application.modules.pickup.views.form',
            [
                'settings' => $delivery->getDeliverySystemSettings(),
                'order'    => $order,
                'pickups'  => $pickups,
                'json'  => CJavaScript::encode($json),
            ],
            $return,
            true
        );
    }

    public function getMitCost(Delivery $delivery, Order $order)
    {
        return 0;
    }
}
