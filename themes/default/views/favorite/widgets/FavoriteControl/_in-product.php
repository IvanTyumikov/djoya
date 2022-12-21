<?php if(false === $favorite->has($product->id)):?>
    <div class="product-buts__link yupe-store-favorite-add" data-id="<?= $product->id;?>">
        <!-- <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/favorite-product.svg'); ?> -->
        <span>В избранное</span>
    </div>
<?php else:?>
    <div class="product-buts__link yupe-store-favorite-remove" data-id="<?= $product->id;?>">
        <!-- <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/favorite-product.svg'); ?> -->
        <span>В избранном</span>
    </div>
<?php endif;?>
