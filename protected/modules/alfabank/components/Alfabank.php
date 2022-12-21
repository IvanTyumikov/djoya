<?php

/**
 * Class for working with AlfaBank
 *
 **/
class AlfaBank
{
    // Payment key
    private $key;

    // Payment mode (secure or sandbox)
    private $userName;
    private $password;
    private $returnUrl;
    private $merchant;
    private $failUrl;
    private $sessionTimeoutSecs;
    private $language;


    public function __construct(Payment $payment)
    {
        $settings = $payment->getPaymentSystemSettings();

        $this->userName = $settings['userName'];
        $this->password = $settings['password'];
        $this->returnUrl = $settings['returnUrl'];
        $this->server = $settings['server'];
        $this->merchant = $settings['merchant'];
        $this->sessionTimeoutSecs = $settings['sessionTimeoutSecs'];
        $this->language = $settings['language'];
        $this->failUrl = $settings['failUrl'];
    }

    /**
     * Generate url
     *
     * @param string $method Payler API method
     * @return string
     * @link 12. Координаты подключения (см. guide)
     */
    public function getUrl($method)
    {
        return $this->server . $method;
    }

    /**
     * Starts a payment session and returns its ID
     *
     * @param Order $order
     * @return string|bool
     */
    public function getFormUrl(Order $order)
    {
        if ($order->orderId) {
            return $this->merchant . '?mdOrder=' . $order->orderId;
        }

        //Общее количество продуктов в корзине
        $productsCount = $order->getProductsCount();
        //Общая сумма скидки
        $orderDiscount = $order->discount + $order->coupon_discount;

        // echo ('<pre>');
        // // print_r($order->discount);
        // print_r($order->coupon_discount);
        // exit;
        //Расчёт размера скидки для каждого товара из корзины *товарная скидка*
        $productAllDiscount = round($orderDiscount / $productsCount, 2);

        $order->total_price;

        // echo ('<pre>');
        // print_r($order->getCouponProductDiscount($order->coupons));
        // exit;

        $newPricesWithDiscount = $order->getCouponProductDiscount($order->coupons, $order->total_price);

        //Подсчёт кол-ва товаров, к которым нельзя применить *товарную скидку*
        $productsUnused = 0;
        foreach ($order->products as $product) {
            if ($product->price < $productAllDiscount) {
                $productsUnused = $productsUnused + $product->quantity;
            }
        }

        //Подсчёт кол-ва товаров, к которым можно применить *товарную скидку*
        $productsUsed = $productsCount - $productsUnused;
        //Перерасчёт размера скидки для каждого товара (использую только те товары, к которым можно применить *товарную скидку*)
        $productUsedDiscount = round($orderDiscount / $productsUsed, 2);

        //Отстаток от деления общей суммы скидки на кол-во товаров, к которым можно применить *товарную скидку*
        $remainder = $orderDiscount % $productsUsed;

        // echo ('<pre>');
        // print_r('productsCount: ' . $productsCount);
        // echo ('<pre>');
        // print_r('productsUnused: ' . $productsUnused);
        // echo ('<pre>');
        // print_r('productsUsed: ' . $productsUsed);
        // echo ('<br>');
        // print_r('orderDiscount: ' . $orderDiscount);
        // echo ('<br>');
        // print_r('productAllDiscount: ' . $productAllDiscount);
        // echo ('<br>');
        // print_r('productUsedDiscount: ' . $productUsedDiscount);
        // echo ('<br>');
        // print_r('remainder: ' . $remainder);
        // echo ('<br>');
        // exit;

        // echo ('<pre>');
        // print_r($newPricesWithDiscount);
        // exit;

        $k = 0;
        foreach ($order->products as $product) {
            //Если к товару нельзя применить *товарную скидку*, то указываем полную стоимость товара
            $items[$k] = [
                'positionId' => $product->id,
                'name' => $product->product_name,
                'quantity' => [
                    'value' => $product->quantity,
                    'measure' => 0,
                ],
                'itemCode' => $product->product_id,
                'tax' => [
                    'taxType' => 0,
                ],
                'itemPrice' => array_key_exists($product->product_id, $newPricesWithDiscount) ? $newPricesWithDiscount[$product->product_id] * 100 : $product->price * 100,
            ];
            $k++;

            // иначе указываем стоимость товара с вычетом *товарной скидки*
        };

        $orderBundle = [
            'customerDetails' => [
                'email' => $order->email,
                'fullName' => $order->name,
            ],
            'cartItems' => [
                'items' => $items,
            ],
        ];

        $data = [
            'userName' => $this->userName,
            'password' => $this->password,
            'returnUrl' => $this->returnUrl,
            'failUrl' => $this->failUrl,
            'sessionTimeoutSecs' => $this->sessionTimeoutSecs,
            'language' => $this->language,
            // 'jsonParams' => json_encode(['email' => $order->email]),
            'orderNumber' => $order->id . 'test',
            'amount' => ($order->getTotalPriceWithDelivery()) * 100,
            'description' =>  $description,
            'taxSystem' => 0,
            'orderBundle' => json_encode($orderBundle)
            // 'orderBundle' => $orderBundle
        ];

        // echo "<pre>";
        // print_r($data);
        // //    print_r($orderBundle);
        // die;
        //
        //        echo "<pre>";
        //        print_r($data);
        //        die;

        $sessionData = $this->sendRequest($data, 'register.do');
       
        if (!isset($sessionData['formUrl'])) {
            Yii::log(Yii::t('AlfabankModule.alfabank', 'Session ID is not defined.'), CLogger::LEVEL_ERROR);
            return false;
        }

        if (isset($sessionData['orderId'])) {
            $order->orderId = $sessionData['orderId'];
            $order->save();
        }

        return $sessionData['formUrl'];
    }

    /**
     * Gets the status of the current payment
     *
     * @param CHttpRequest $request
     * @return string|bool
     * Номер состояния Описание
            0 Заказ зарегистрирован, но не оплачен
            1 Предавторизованная сумма захолдирована (для двухстадийных платежей)
            2 Проведена полная авторизация суммы заказа
            3 Авторизация отменена
            4 По транзакции была проведена операция возврата
            5 Инициирована авторизация через ACS банка-эмитента
            6 Авторизация отклонена
     */
    public function getPaymentStatus(CHttpRequest $request)
    {
        $data = [
            'userName' => $this->userName,
            'password' => $this->password,
            'orderId' => $request->getParam('orderId'),
        ];

        $response = $this->sendRequest($data, 'getOrderStatus.do');

        if (!isset($response['OrderStatus'])) {
            return false;
        }

        if ($response['OrderStatus'] == 2) {
            return true;
        }

        return false;
    }

    /**
     * Sends a request to the server
     *
     * @param array $data API method parameters
     * @param string $method Payler API method
     * @return bool|mixed
     */
    private function sendRequest($data, $method)
    {
        $data = http_build_query($data, '', '&');

        // echo ('<pre>');
        // print_r($data);
        // exit;

        $options = [
            CURLOPT_URL => $this->getUrl($method),
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 45,
            CURLOPT_VERBOSE => false,
            CURLOPT_HTTPHEADER => [
                'Content-type: application/x-www-form-urlencoded',
                'Cache-Control: no-cache',
                'charset="utf-8"',
            ],
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $json = curl_exec($ch);

        if ($json === false) {
            Yii::log(Yii::t(
                'AlfabankModule.alfabank',
                'Request error: {message}',
                ['{message}' => curl_error($ch)]
            ), CLogger::LEVEL_ERROR);

            return false;
        }
        $result = json_decode($json, true);

        // echo ('<pre>');
        // print_r($result);
        // exit;

        //                 echo '<pre>';
        //                 print_r($result);
        //                 Yii::app()->end();
        curl_close($ch);

        return $result;
    }
}
