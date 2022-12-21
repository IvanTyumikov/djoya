<?php if(false === $favorite->has($product->id)):?>
    <div class="but but-border product-favorite__button yupe-product-favorite-add" data-id="<?= $product->id;?>">
		<?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite.svg'); ?>
		<span>В избранное</span>
    </div>
<?php else:?>
    <div class="but but-border product-favorite__button yupe-product-favorite-remove text-error" data-id="<?= $product->id;?>">
    	<?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/favorite_active.svg'); ?>
    	<span>Удалить</span>
	</div>
<?php endif;?>