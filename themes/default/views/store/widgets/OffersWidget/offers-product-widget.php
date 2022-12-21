<?php $class = isset($items[$this->id]) ? 'active' : '' ; ?>
<a href="<?= Yii::app()->createUrl('/store/offers/index', ['id' => $this->id]) ?>" class="product-but__but product-but__compare js-product-compare <?= $class; ?>">
    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/product-compare.svg'); ?>
    <span>Сравнить</span>
</a>