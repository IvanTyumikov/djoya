<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
// $this->breadcrumbs = $this->getBreadCrumbs();

$this->breadcrumbs = array_merge(
    [CHtml::encode($model->title)]
);
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: '';
?>

<div class="page-content oplata">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1><?= $model->title; ?></h1>

        <div class="oplata__content">
            <h3>Для Вашего удобства, возможны различные варианты оплаты.</h3>

            <p>
                Обращаем Ваше внимание, что мы не отправляем заказы наложенным платежом! <br>
                Отправка происходит только после оплаты заказа!
            </p>

            <p>Для оформления заказа регистрироваться на сайте <span>НЕОБЯЗАТЕЛЬНО!</span></p>

            <p><span>ВНИМАНИЕ! ПЕРЕД ОПЛАТОЙ</span>, дождитесь информации от нашего менеджера, о готовности товара к отправке и сумме платежа!</p>

            <div class="payment-list">
                <img src="<?= $this->mainAssets . '/images/payment/paypal.png' ?>" alt="">
                <img src="<?= $this->mainAssets . '/images/payment/yandex.png' ?>" alt="">
                <img src="<?= $this->mainAssets . '/images/payment/mastercard.png' ?>" alt="">
            </div>

            <p>Отправка заказа по России осуществляется после получения оплаты за заказ. Не забывайте проинформировать нас об оплате - это сокращает срок оформления и отправки заказа.</p>

            <p>Оплатить заказ можно следующими способами:</p>

            <p>переводом на карту Сбербанка или Альфа-Банка <br>
                (после обработки заказа мы пришлём Вам данные для оплаты)</p>

            <p>банковской картой Visa, MasterCard, МИР итд. <br>
                (после обработки заказа мы пришлём Вам ссылку для оплаты)</p>

            <p>переводом на кошелёк Яндекс-деньги: *******************</p>
        </div>
    </div>
</div>