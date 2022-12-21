<div class="product-item__img-slider js-product-item-img-slider">
    <?php foreach ($product->getImages() as $key => $image): { ?>
    	<?php if($image->option_color_id == $optionId): ?>
	        <div class="product-item__img">
	            <a href="<?= ProductHelper::getUrl($product); ?>">
	                <img src="<?= $image->getImageUrl(240, 200); ?>"
	                     alt="<?= CHtml::encode($image->alt) ?>"
	                     title="<?= CHtml::encode($image->title) ?>"
	                     data-option-id="<?= $image->option_color_id ?>">
	            </a>
	            <a href="#" data-url="<?= Yii::app()->createUrl('/store/product/product', ['id' => $product->id]); ?>" class="product-item__fast-view js-product-modal">
	                <span>Быстрый просмотр</span>
	            </a>
	        </div>
	    <?php endif; ?>
    <?php } endforeach; ?>
</div>