<a class="fl fl-di-c fl-al-it-c fl-ju-co-c js-shopping-cart-widget-mobile" href="<?= Yii::app()->createUrl('/cart/cart/index'); ?>">
    <div class="header-mobile__icon js-cart-widget-mobile" data-cart-widget-url="<?= Yii::app()->createUrl('/cart/cart/widgetMobile'); ?>">
        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/icon-cart-mobile.svg'); ?>
        <div class="header-mobile__count fl fl-al-it-c fl-ju-co-c <?= (empty(Yii::app()->cart->isEmpty())) ? 'active' : ''; ?>">
            <?= Yii::app()->cart->getItemsCount(); ?>
        </div>
    </div>
    <span><?= Yii::t("CartModule.cart", "Корзина"); ?></span>
</a>