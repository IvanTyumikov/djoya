<?php if(false === $favorite->has($product->id)):?>
	<span class="product-item__favorite yupe-store-favorite-add" data-id="<?= $product->id;?>">
    	<!-- <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/favorite.svg'); ?> -->
    </span>
<?php else:?>
	<span class="product-item__favorite product-item__favorite_add yupe-store-favorite-remove" data-id="<?= $product->id;?>">
    	<!-- <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/favorite-remove.svg'); ?> -->
    </span>
<?php endif;?>