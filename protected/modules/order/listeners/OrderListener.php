<?php

use yupe\components\Event;

/**
 * Class OrderListener
 */
class OrderListener
{
    /**
     * @param Event $event
     */
    public static function onCreate(Event $event)
    {
        $order = $event->getOrder();

//        if (Yii::app()->hasModule('amocrm')){
//            $amocrm = new Amocrm;
//            $amocrm->addLead([
//                'phone' => $order->phone,
//                'name' => $order->name
//            ]);
//        }

//        if (Yii::app()->hasModule('retailcrm')){
//            $retailcrm = new Retailcrm;
//            $retailcrm->addOrder($order->products, $order->getAttributes(), $order->id);
//        }

        Yii::app()->orderNotifyService->sendOrderCreatedAdminNotify($order);

        Yii::app()->orderNotifyService->sendOrderCreatedUserNotify($order);
    }

    /**
     * @param Event $event
     */
    public static function onUpdate(Event $event)
    {
        $order = $event->getOrder();

        Yii::app()->orderNotifyService->sendOrderChangesNotify($order);
    }
}