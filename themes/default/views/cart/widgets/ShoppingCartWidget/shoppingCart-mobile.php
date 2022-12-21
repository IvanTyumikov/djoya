<div class="header-cart__wrap js-cart" id="cart-widget" data-cart-widget-url="<?= Yii::app()->createUrl('/cart/cart/widget'); ?>">
    <?php if (!empty(Yii::app()->cart->isEmpty())): ?>
        <div class="header-cart__main header-cart_empty">
            <span class="header-mobile__icon header-cart__icon">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/mobile/icon-cart.svg'); ?>
            </span>
            <span class="header-mobile__label header-cart__value"><?= Yii::t("CartModule.cart", "Cart"); ?></span>
        </div>
    <?php else: ?>
        <a href="<?= Yii::app()->createUrl('/cart/cart/order') ?>" class="header-cart__main">
            <span class="header-mobile__icon header-cart__icon">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/mobile/icon-cart.svg'); ?>
                <span class="header-cart__count active"><?= Yii::app()->cart->getItemsCount(); ?></span>
            </span>
            <span class="header-mobile__label header-cart__value"><?= Yii::t("CartModule.cart", "Cart"); ?></span>
        </a>
    <?php endif; ?>
</div>