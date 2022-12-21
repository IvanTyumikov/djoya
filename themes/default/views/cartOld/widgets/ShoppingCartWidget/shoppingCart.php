<div class="header-cart__wrap js-cart" id="cart-widget" data-cart-widget-url="<?= Yii::app()->createUrl('/cart/cart/widget'); ?>">
    <?php if (!empty(Yii::app()->cart->isEmpty())): ?>
        <div class="header-cart__main header-cart_empty">
            <span class="header-cart__icon">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/cart.svg'); ?>
            </span>
        </div>
    <?php else: ?>
        <a href="<?= Yii::app()->createUrl('/cart/cart/index') ?>" class="header-cart__main">
            <span class="header-cart__icon">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/cart.svg'); ?>
                <span class="header-cart__count active"><?= Yii::app()->cart->getItemsCount(); ?></span>
            </span>
        </a>
    <?php endif; ?>
</div>