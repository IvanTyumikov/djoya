<?php 
/**
 * Шаблон в модальном окне, добавленного товара в корзину.
**/  
?>

<div class="product-cart">
	<div class="product-cart__item fl fl-al-it-c fl-ju-co-sp-b">
		<div class="product-cart__img">
			<picture class="js-product-image">
                <source srcset="<?= $data->getImageNewUrl(640, 573,false,null,'image'); ?>" type="image/webp">
                <img src="<?= $data->getImageUrlWebp(640, 573,false,null,'image'); ?>" alt="">
            </picture>
		</div>
		<div class="product-cart__info fl fl-al-it-c fl-ju-co-sp-b">
			<div class="product-cart__name">
				<span class="product-name">
                	<?= CHtml::encode($data->getName()); ?>
				</span>
	        </div>
	        <div class="product-cart__price product-price <?= ($data->hasDiscount()) ? 'product-price-new' : ''; ?> fl fl-wr-w fl-al-it-fl-e fl-ju-co-sp-b">
                <?php if ($data->hasDiscount()) : ?>
	            	<div class="product-price__benefit">
	                    <?= $data->getBenefit(); ?>
	            	</div>
                <?php endif; ?>
	            <span class="product-price__res">
	                <span class="price-result" id="result-price<?= $data->id?>">
	                    <?= round($data->getResultPrice(), 2); ?>
	                </span>
	                <span class="ruble"><?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble.svg'); ?></span>
	            </span>
	            <?php if ($data->hasDiscount()) : ?>
	                <span class="product-price__old">
	                    <span class="price-old">
	                        <!--  -->
	                        <?= round($data->getBasePrice(), 2); ?>
	                    </span>
	                    <span class="ruble"><?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/ruble.svg'); ?></span>
	                </span>
	            <?php endif; ?>
	        </div>
	    </div>
	</div>
</div>