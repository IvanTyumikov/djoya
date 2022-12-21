<div class="cart-static">
    <a href="#" data-target=".js-static-table" class="cart-static__link bt-cart-link bt-cart-link-green bt-cart-link-svg bt-cart-link-svg-left js-static-table-toggle">
        <span>Детали заказа</span>
        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/prev-arrow.svg'); ?>
    </a>
</div>

<div class="cart-list cart-list-composition js-static-table" style="display: none;">
    <?php foreach ($positions as $key => $position) : ?>
        <?php Yii::app()->controller->renderPartial('//cart/cart/_item', [
            'isButton' => false,
            'position' => $position,
        ]); ?>
    <?php endforeach; ?>
</div>
