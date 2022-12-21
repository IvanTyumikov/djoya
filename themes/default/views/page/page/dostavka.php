<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;

$this->breadcrumbs = array_merge(
    [CHtml::encode($model->title)]
);
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: '';
?>

<div class="page-content delivery">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1><?= $model->title; ?></h1>

        <div class="delivery__content">
            <h3>Для Вашего удобства, мы используем различные способы доставки.</h3>

            <p>
                Обращаем Ваше внимание, что мы не отправляем заказы наложенным платежом! <br>
                Отправка происходит только после оплаты заказа!
            </p>

            <p>Для оформления заказа регистрироваться на сайте <span>НЕОБЯЗАТЕЛЬНО!</span></p>

            <p><span>ВНИМАНИЕ! ПЕРЕД ОПЛАТОЙ</span>, дождитесь информации от нашего менеджера, о готовности товара к отправке и сумме платежа!</p>

            <h3>Способы доставки:</h3>

            <p><span>Самовывоз</span></p>

            <p>
                <span>Доставка Почтой России</span><br>
                Стоимость доставки - 350 рублей. <br>
                При заказе от 3000 рублей - доставка БЕСПЛАТНО!
            </p>

            <p>
                <span>Доставка курьерской службой СДЭК до пункта выдачи в России и Беларуси.</span> <br>
                Стоимость доставки 300 руб. При заказе от 3000 рублей - доставка БЕСПЛАТНО! <br>
                Посмотреть список пунктов выдачи заказов можно здесь.
            </p>

            <p>
                <span>Доставка курьерской службой BOXBERRY до пункта выдачи в России.</span> <br>
                Стоимость доставки 300 рублей. При заказе от 3000 рублей - доставка БЕСПЛАТНО! <br>
                Посмотреть список пунктов выдачи заказов можно здесь.
            </p>


            <div class="free-delivery">
                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/attention.svg'); ?>
                <p>Доставка от 3000 ₽ - БЕСПЛАТНО</p>
            </div>

            <div class="delivery-img">
                <img src="<?= $this->mainAssets . '/images/delivery/pochta_rossii.png' ?>" alt="">
                <img src="<?= $this->mainAssets . '/images/delivery/logo-sdek.png' ?>" alt="">
                <img src="<?= $this->mainAssets . '/images/delivery/boxberry.png' ?>" alt="">
            </div>
        </div>
    </div>
</div>