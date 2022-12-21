<?php

/**
 * Class SberbankPaymentSystem
 * @link
 */

use yupe\widgets\YFlashMessages;

Yii::import('application.modules.alfabank.AlfabankModule');
Yii::import('application.modules.alfabank.components.Alfabank');
/**
 * Class AlfabankPaymentSystem
 */
class AlfabankPaymentSystem extends PaymentSystem
{
    /**
     * @param Payment $payment
     * @param Order $order
     * @param bool|false $return
     * @return mixed|string
     */
    public function renderCheckoutForm(Payment $payment, Order $order, $return = false)
    {
        $sbank = new Alfabank($payment);
        $action = $sbank->getFormUrl($order);
        
        if (!$action) {
            Yii::app()->getUser()->setFlash(
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('AlfabankModule.alfabank', 'Payment by "{name}" is impossible', ['{name}' => $payment->name])
            );

            return false;
        }

        return Yii::app()->getController()->renderPartial('application.modules.alfabank.views.form', [
            'action' => $action
        ], $return);
    }

    /**
     * @param Payment $payment
     * @param CHttpRequest $request
     * @return bool
     */
    public function processCheckout(Payment $payment, CHttpRequest $request)
    {
        $orderId = $request->getParam('orderId');
        
        $sbank = new Alfabank($payment);
        $order = Order::model()->findByAttributes(['orderId'=>$orderId]);

        if ($order === null) {
            Yii::log(Yii::t('AlfabankModule.alfabank', 'The order doesn\'t exist.'), CLogger::LEVEL_ERROR);
            return false;
        }

        if ($order->isPaid()) {
            Yii::log(
                Yii::t('AlfabankModule.alfabank', 'The order #{n} is already payed.', $order->getPrimaryKey()),
                CLogger::LEVEL_ERROR
            );

            return $order;
        }

        if ($sbank->getPaymentStatus($request) && $order->pay($payment)) {
            Yii::log(
                Yii::t('AlfabankModule.alfabank', 'The order #{n} has been payed successfully.', $order->getPrimaryKey()),
                CLogger::LEVEL_INFO
            );
            Yii::app()->getUser()->setFlash(
                YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('AlfabankModule.alfabank', 'The order #{n} has been payed successfully.', $order->getPrimaryKey())
            );
        } else {
            Yii::app()->getUser()->setFlash(
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('AlfabankModule.alfabank', 'Attempt to pay failed')
            );
            Yii::log(Yii::t('AlfabankModule.alfabank', 'An error occurred when you pay the order #{n}.',
                $order->getPrimaryKey()), CLogger::LEVEL_ERROR);
        }

        return $order;

    }
}
