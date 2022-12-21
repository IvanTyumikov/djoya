<?php
/* @var $model Order */
/* @var $delivery Delivery */
/* @var $system DeliverySystem */
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
$delivery = $model->delivery;
$system = $delivery->getDeliverSystem();

if(!$system === null){
    $system->setRegisteredOrder($model->delivery_data);
}

// Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/order-frontend.css');
// Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');

$this->title = Yii::t('OrderModule.order', 'Order #{n}', [$model->id]);
$this->breadcrumbs = [Yii::t('OrderModule.order', 'Order #{n}', [$model->id])];
?>
<?php $array = Yii::app()->user->getFlashes(); ?>
<div class="page-content cart-page-content">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        
        <h1>Оформление заказа</h1>
        <div class="cart-section fl fl-wr-w fl-ju-co-sp-b">
            <div class="cart-section__content">
                <?php $this->widget('application.modules.cart.widgets.CartStaticWidget', ['positions' => $model->products]) ?>
                <div class="order-message-section">
                    <h4>Заказ № <?= $model->id ?> успешно создан</h4>
                    <div class="cart-form-content cart-text-18-normal m-b-25">
                        <p>Заказ с номером <strong><?= $model->id ?> от <?= date('d.m.Y', strtotime($model->date)) ?>г.</strong> успешно оформлен. С вами свяжется наш менеджер по номеру телефона <strong><?= $model->phone ?></strong> и уточнит информацию по данному заказу. <strong><?= CHtml::encode($model->name); ?></strong>, уведомления о статусе заказа вы будете получать по электронной почте <strong><?= $model->email ?></strong></p>
                    </div>
                    <h4>Детали заказа</h4>
                    <div class="pay-details">
                        <div class="pay-details__items fl">
                            <div class="pay-details__left">
                                <?= CHtml::activeLabel($model, 'name'); ?>:
                            </div>
                            <div class="pay-details__right">
                                <?= CHtml::encode($model->name); ?>
                            </div>
                        </div>
                        <div class="pay-details__items fl">
                            <div class="pay-details__left">
                                <?= CHtml::activeLabel($model, 'phone'); ?>:
                            </div>
                            <div class="pay-details__right">
                                <?= CHtml::encode($model->phone); ?>
                            </div>
                        </div>
                        <div class="pay-details__items fl">
                            <div class="pay-details__left">
                                <?= CHtml::activeLabel($model, 'email'); ?>:
                            </div>
                            <div class="pay-details__right">
                                <?= CHtml::encode($model->email); ?>
                            </div>
                        </div>
                        <?php if($model->getAddress()) : ?>
                            <div class="pay-details__items fl">
                                <div class="pay-details__left">
                                    <label><?= Yii::t("OrderModule.order", "Address"); ?>:</label>
                                </div>
                                <div class="pay-details__right">
                                    <?= CHtml::encode($model->getAddress()); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!$model->isPaid() && $model->payment_method_id == 2 && !empty($model->delivery) && $model->delivery->hasPaymentMethods()) : ?>
                        <div class="pay-payments hidden">
                            <div class="pay-payments__header">
                                Способы оплаты:
                            </div>
                            <ul id="payment-methods">
                                <?php foreach ((array)$model->delivery->paymentMethods as $payment) : ?>
                                    <li class="payment-method">
                                        <div class="rich-radio">
                                            <input class="payment-method-radio" type="radio" name="payment_method_id"
                                                   value="<?= $payment->id; ?>" <?= ($model->payment_method_id == $payment->id) ? 'checked' : ''; ?>
                                                   id="payment-<?= $payment->id; ?>">
                                            <label for="payment-<?= $payment->id; ?>">
                                                <?= CHtml::encode($payment->name); ?>
                                            </label>
                                            <?php if ($payment->description) : ?>
                                                <div class="description">
                                                    <?= $payment->description; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="payment-form hidden">
                                                <?= $payment->getPaymentForm($model); ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="text-right pay-payments__button">
                                <button type="submit" class="button" id="start-payment">
                                    <?= Yii::t("OrderModule.order", "Pay"); ?>
                                    <!-- <span class="glyphicon glyphicon-play"></span> -->
                                </button>
                            </div>
                        </div>
                        <?php Yii::app()->getClientScript()->registerScript(
                            "pay-redirect",
                            "$('#start-payment').trigger('click');"
                        ); ?>
                    <?php endif; ?>
                    <div class="fl fl-wr-w fl-ju-co-fl-s">
                        <?= CHtml::link('Вернуться на главную', '/', ['class' => 'btn btn-green']) ?>
                    </div>
                </div>

            </div>
            <div class="cart-section__result">
                <?php $this->widget('application.modules.cart.widgets.PriceOverview', ['order' => $model, 'system' => $system]) ?>
            </div>
        </div>
    </div>
</div>