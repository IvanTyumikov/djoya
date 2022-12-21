<?php

/**
 * Class OrderController
 */
class OrderController extends \yupe\components\controllers\FrontController
{
    /**
     * @param null $url
     * @throws CHttpException
     */
    public function actionView($url = null)
    {
        if (!Yii::app()->getModule('order')->showOrder && !Yii::app()->getUser()->isAuthenticated()) {
            throw new CHttpException(404, Yii::t('OrderModule.order', 'Page not found!'));
        }

        $model = Order::model()->findByUrl($url);

        $coupons = [];

        $coupons_get = explode(',', $_GET['coupons']);

        foreach ($coupons_get as $coup) {
            $coupons[] = Coupon::model()->findByAttributes(['code' => $coup]);
        }

        if ($model === null) {
            throw new CHttpException(404, Yii::t('OrderModule.order', 'Page not found!'));
        }

        $this->render('view', ['model' => $model, 'coupons' => $coupons]);
    }

    /**
     *
     */
    public function actionCreate()
    {
        $model = new Order(Order::SCENARIO_USER);

        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getPost('Order')) {
            $order = Yii::app()->getRequest()->getPost('Order');

            $products = Yii::app()->getRequest()->getPost('OrderProduct');

            $coupons = isset($order['couponCodes']) ? $order['couponCodes'] : [];

            if ($model->store($order, $products, Yii::app()->getUser()->getId(), (int)Yii::app()->getModule('order')->defaultStatus)) {

                Yii::app()->cart->clear();

                if (!empty($coupons)) {
                    $model->applyCoupons($coupons);
                }

                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('OrderModule.order', 'The order created')
                );

                Yii::app()->eventManager->fire(OrderEvents::CREATED_HTTP, new OrderEvent($model));

                if (Yii::app()->getModule('order')->showOrder) {

                    $coups = implode(',', $coupons);

                    $this->redirect(['/order/order/view', 'url' => $model->url, 'coupons' => $coups]);
                }

                $this->redirect(['/store/product/index']);
            } else {
                $error = CHtml::errorSummary($model);
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                    $error ?: Yii::t('OrderModule.order', 'Order error')
                );

                $this->redirect(['/cart/cart/order']);
            }
        }

        $this->redirect(Yii::app()->getUser()->getReturnUrl());
    }

    /**
     * @throws CHttpException
     */
    public function actionCheck()
    {
        if (!Yii::app()->getModule('order')->enableCheck) {
            throw new CHttpException(404);
        }

        $form = new CheckOrderForm();

        $order = null;

        if (Yii::app()->getRequest()->getIsPostRequest()) {

            $form->setAttributes(
                Yii::app()->getRequest()->getPost('CheckOrderForm')
            );

            if ($form->validate()) {
                $order = Order::model()->findByNumber($form->number);
            }
        }

        $this->render('check', ['model' => $form, 'order' => $order]);
    }
}
