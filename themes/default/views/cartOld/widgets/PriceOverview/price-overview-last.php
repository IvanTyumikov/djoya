<?php
/**
 * @var $orderModule OrderModule
 * @var $payment Payment
 * @var $delivery Delivery
 * @var string $prevlinkname
 * @var integer $itemsCount
 * @var $order Order
 * @var $system DeliverySystem
 */

$payment = $order->payment;
$delivery = $order->delivery;
?>

<?php $prevlinkname = file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/prev-arrow.svg') . '<span>Вернуться в каталог</span>'; ?>

<div class="cart-result">
    <div class="cart-result__header">
        <div class="cart-result-header cart-color-212121 cart-text-18-normal cart-text-bold">Ваша корзина</div>
        <div class="cart-result-desc cart-color-757575 cart-text-13-normal">Доступные способы доставки и форму оплаты
            можно выбрать при оформлении заказа
        </div>
    </div>
    <div class="cart-result__body">
        <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
            <span class="cart-total__name">Товары (<span id="cart-total-product-count"><?= $itemsCount ?></span>)</span>
            <span class="cart-total__res">
                <span class="js-cart-full-cost">0</span>
                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
            </span>
        </div>
    </div>
    <?php if ($delivery && $system) : ?>
        <?php $deliveryCost = $order->delivery_price ?? $system->getOutCost() ?>
        <div class="cart-total-br">
            <?php if ($deliveryCost > 0): ?>
                <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
                    <span class="cart-total__name">Доставка </span>
                    <span class="cart-total__res">
                        <span><?= $deliveryCost ?></span>
                        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
                    </span>
                </div>
            <?php endif; ?>
            <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
                <span class="cart-total__name">Способ доставки</span>
                <span class="cart-total__res">
                        <span><?= CHtml::encode($order->delivery->name); ?></span>
                    </span>
            </div>
            <?php if ($system->getOutTrack()): ?>
                <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
                    <span class="cart-total__name">Трек номер</span>
                    <span class="cart-total__res">
                            <span><?= CHtml::encode($system->getOutTrack()); ?></span>
                        </span>
                </div>
            <?php endif; ?>
            <?php if ($system->getOutToAddress()): ?>
                <div>
                    <span class="cart-total__name">Адрес доставки</span>
                    <div class="cart-total__res cart-total-left-text"><?= CHtml::encode($system->getOutToAddress()); ?></div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ($payment && $system) : ?>
        <div class="cart-total-br">
            <div class="cart-total cart-total-bt">
                <div>
                    <span class="cart-total__name">Способ оплаты</span>
                    <div class="cart-total__res cart-total-left-text"><?= CHtml::encode($payment->name); ?></div>
                </div>
            </div>
            <?php if ($system->getOutPayment()): ?>
                <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
                    <span class="cart-total__name">Сумма налож. плат.</span>
                    <span class="cart-total__res"><span><?= CHtml::encode($system->getOutPayment()); ?></span></span>
                </div>
            <?php endif; ?>
            <?php if ($order->coupons): ?>
                <?php foreach ($order->coupons as $coupon): ?>
                <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
                    <span class="cart-total__name">Купон <?= $coupon->name ?></span>
                    <span class="cart-total__res">
                        <span><?= CHtml::encode($coupon->value); ?></span>
                        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="cart-total-br">
        <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
            <span class="cart-total__name">Статус заказа</span>
            <span class="cart-total__res cart-total__res_red"><?= $order->getPaidStatus(); ?></span>
        </div>
    </div>
    <div class="cart-total-br">
        <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
            <span class="cart-total__name cart-result-header">Итоговая стоимость</span>
            <span class="cart-total__res cart-result-header">
                <span><?= $order->getTotalPriceWithDelivery(); ?></span>
                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
            </span>
        </div>
    </div>
</div>