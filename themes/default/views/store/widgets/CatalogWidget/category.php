<?php if($category) : ?>
	<div class="category">
	    <div class="container">
	        <div class="category__top top">
	            <a href="<?= Yii::app()->createUrl('/store/product/index');?>" class="top__title">Каталог</a>
	        </div>
	        <div class="category__main">
	        	<?php foreach ($category as $key => $data) : ?>
		            <div class="category__item category-item">
		                <div class="category-item__image">
		                    <img src="<?= $data->getImageUrl(); ?>" alt="<?= $data->name; ?>">
		                </div>
		                <div class="category-item__wrap-name-price">
		                    <div class="category-item__name">
		                        <span class="value"><?= $data->name; ?></span>
		                    </div>
		                    <div class="category-item__price">
		                        <span class="value">от 24 000 </span>
		                        <span class="current">₽</span>
		                    </div>
		                </div>
		                <div class="category-item__more">
		                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/category_arrow.svg'); ?>
		                </div>
		                <a href="<?= $data->getCategoryUrl(); ?>" class="category-item__link"></a>
		            </div>
		        <?php endforeach; ?>
	        </div>
	    </div>
	</div>
<?php endif; ?>