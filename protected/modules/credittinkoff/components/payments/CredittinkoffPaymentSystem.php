<?php

/**
 * Class CredittinkoffPaymentSystem
 * @link
 */

Yii::import('application.modules.credittinkoff.CredittinkoffModule');

/**
 * Class CredittinkoffPaymentSystem
 */
class CredittinkoffPaymentSystem extends PaymentSystem
{
    /**
     * @param Payment $payment
     * @param Order $order
     * @param bool|false $return
     * @return mixed|string
     */
    public function renderCheckoutForm(Payment $payment, Order $order, $return = false)
    {
        return Yii::app()->getController()->renderPartial(
            'application.modules.credittinkoff.views.form',
            [
                'order' => $order,
                'orderCheckUrl' => Yii::app()->createUrl('payment/payment/process', ['id' => $payment->id]),
                'paymentId' => $payment->id,
            ],
            $return
        );
    }

    /**
     * @param Payment $payment
     * @param CHttpRequest $request
     * @return bool
     */
    public function processCheckout(Payment $payment, CHttpRequest $request)
    {
        $data = $request->getRestParams();
        $status = $data['status'];
        $orderId = (int)$data['id'];
        $orderAmount = (int)$data['order_amount'];


        file_put_contents('credittinkoff.log', var_export($status, true)."\n", FILE_APPEND);

        $order = Order::model()->findByPk($orderId);

        if (null === $order) {
            Yii::log(
                Yii::t('CredittinkoffModule.credittinkoff', 'Order with id = {id} not found!', ['{id}' => $orderId]),
                CLogger::LEVEL_ERROR,
                self::LOG_CATEGORY
            );

            return false;
        }

        if ($order->isPaid()) {
            Yii::log(
                Yii::t('CredittinkoffModule.credittinkoff', 'Order with id = {id} already payed!', ['{id}' => $orderId]),
                CLogger::LEVEL_ERROR,
                self::LOG_CATEGORY
            );

            return false;
        }

        // $orderAmount != $order->getTotalPrice()

        if ($status != 'signed') {
            Yii::log(
                Yii::t(
                    'CredittinkoffModule.credittinkoff',
                    'Error pay order with id = {id}! Incorrect price!',
                    ['{id}' => $orderId]
                ),
                CLogger::LEVEL_ERROR,
                self::LOG_CATEGORY
            );

            return false;
        }

        if ($order->pay($payment)) {
            Yii::log(
                Yii::t('CredittinkoffModule.credittinkoff', 'Success pay order with id = {id}!', ['{id}' => $orderId]),
                CLogger::LEVEL_INFO,
                self::LOG_CATEGORY
            );

            return true;
        } else {
            Yii::log(
                Yii::t(
                    'CredittinkoffModule.credittinkoff',
                    'Error pay order with id = {id}! Error change status!',
                    ['{id}' => $orderId]
                ),
                CLogger::LEVEL_ERROR,
                self::LOG_CATEGORY
            );

            return false;
        }
    }

    /**
     * @param Payment $payment
     * @param CHttpRequest $request
     * @param int $orderId
     */
    public function processInit(CHttpRequest $request, Order $order)
    {
        if (!$order) {
            $message = Yii::t('TinkoffPayModule.tpay', 'The order doesn\'t exist.');
            Yii::log($message, CLogger::LEVEL_ERROR);
            throw new Exception($message, self::ERROR_ORDER_NOT_FOUND);
        }

        $this->payment = Payment::model()->findByAttributes(['module' => 'credittinkoff']);

        if (!$this->payment instanceof Payment)
            throw new Exception('Создайте способ оплаты');

        $postData = $this->getPaymentPostData($this->payment, $order);

//        echo json_encode($postData);die;
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://forma.tinkoff.ru/api/partners/v2/orders/create-demo', [
                \GuzzleHttp\RequestOptions::JSON => $postData,
            ]);

            $body = $response->getBody()->getContents();

            if (!empty($body)) {
                $body = json_decode($body, true);
                if (empty($body['PaymentURL']))
                    throw new Exception('Ошибка оплаты', self::ERROR_PROCESS_PAYMENT);
                Yii::app()->controller->redirect($body['PaymentURL']);
            }
        } catch (Exception $e) {
            throw new Exception('Ошибка оплаты', self::ERROR_PROCESS_PAYMENT);
        }
    }

    /**
     * @param Payment $payment
     * @param Order $order
     * @return mixed|string
     */
    public function getPaymentPostData(Payment $payment, Order $order)
    {
        $settings = $payment->getPaymentSystemSettings();

        $receipt = [];
        if ($settings['includeReceipt']) {
            $receipt["Email"] = $order->email;
            $receipt["Taxation"] = $settings['Taxation'];
            $receipt["Items"] = [];
            $arr = [];
            foreach ($order->products as $product) {
                /** @var Product $product */
                $arr["Name"] = $product->product_name;
                $arr["Quantity"] = (int)$product->quantity;
                $arr["Price"] = $product->price * 100;
                $arr["Amount"] = ($product->price * 100) * $product->quantity;
                $arr["Tax"] = $settings['Tax'];
                $receipt["Items"][] = $arr;
            }

            //Включаем доставку в позиции заказа
            if ($order->delivery->price > 0) {
                $arr["Name"] = Yii::t('TinkoffPayModule.tpay', 'Delivery') . ": " . $order->delivery->name;
                $arr["Quantity"] = 1; // доставка всегда одна штука в заказе
                $arr["Price"] = $order->delivery->price * 100;
                $arr["Amount"] = $order->delivery->price * 100;
                $arr["Tax"] = $settings['Tax'];
                $arr["PaymentObject"] = 'service';
                $receipt["Items"][] = $arr;
            }
        }

        $data = [
            'TerminalKey' => $settings['TerminalKey'],
            'Amount' => $order->getTotalPriceWithDelivery() * 100,
            'OrderId' => $order->id,
            'SuccessURL' => Yii::app()->createAbsoluteUrl('/order/order/view', ['url' => $order->url]),
            'NotificationURL' => Yii::app()->createAbsoluteUrl('payment/payment/process', ['id' => $payment->id]),
            'PayType' => 'О',
            'Description' => Yii::t('TinkoffPayModule.tpay', 'Order payment in store «{n}»', Yii::app()->getModule('yupe')->siteName ),
        ];

        if ($settings['includeReceipt'])
            $data['Receipt'] = $receipt;

        return $data;
    }
}
