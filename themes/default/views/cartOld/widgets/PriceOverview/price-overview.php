<?php
/** @var int $couponsSumm */
/** @var array $coupons */
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
        <?php //if ($discountSumm > 0) : ?>
        <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b hidden">
            <span class="cart-total__name">Скидка</span>
            <span class="cart-total__res cart-total__res_red">
                    <span class="js-cart-discount-cost"><?= $discountSumm ?></span>
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
                </span>
        </div>
        <?php //endif ?>
        <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b hidden">
            <span class="cart-total__name">Доставка</span>
            <span class="cart-total__res cart-total__res_red">
                <span id="cart-shipping-cost"></span>
                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
            </span>
        </div>
        <!--<div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
            <span class="cart-total__name">Вес</span>
            <span class="cart-total__res cart-total__res_red">
                <span><?/*= $weight */?> г.</span>
            </span>
        </div>-->

    </div>
    <div class="cart-result__footer">
        <?php if (Yii::app()->hasModule('coupon') and Yii::app()->controller->action->id !== 'index') : ?>
            <?php foreach ($coupons as $coupon) : ?>
                <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
                    <span class="cart-total__name cart-result-header"><?= $coupon->name ?></span>
                    <span class="cart-total__res cart-result-header">
                        <span class="js-coupon"><?= round($coupon->value) ?></span>
                        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
                    </span>
                </div>
                <?= CHtml::hiddenField(
                    "Order[couponCodes][{$coupon->code}]",
                    $coupon->code,
                    [
                        'class' => 'coupon-input',
                        'data-code' => $coupon->code,
                        'data-name' => $coupon->name,
                        'data-value' => $coupon->value,
                        'data-type' => $coupon->type,
                        'data-min-order-price' => $coupon->min_order_price,
                        'data-free-shipping' => $coupon->free_shipping,
                    ]
                ); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="cart-total fl fl-al-it-c fl-ju-co-sp-b">
            <span class="cart-total__name cart-result-header">Итого:</span>
            <span class="cart-total__res cart-result-header">
                <span class="js-cart-full-cost-with-shipping"><?= $cart->getCost() ?></span>
                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
            </span>
        </div>
        <?php if ($isButton) : ?>
            <div class="cart-result__but">
                <?php
                $htmlOptions = [
                    'class' => 'btn btn-green hide js-next-button ',
                ];
                $link = ['/cart/cart/order'];
                if (Yii::app()->user->isGuest) {
                    $htmlOptions['data-target'] = '#modal-login-registration';
                    $htmlOptions['data-toggle'] = 'modal';
                    $link = '#';
                }
                ?>
                <?= CHtml::link('Продолжить оформление', $link, $htmlOptions) ?>
            </div>
        <?php endif; ?>
    </div>
</div>