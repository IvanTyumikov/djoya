<div class="stocks">
    <div class="container">
        <div class="stocks__top top">
            <a href="<?= Yii::app()->createUrl('/stocks/stocks/index');?>" class="top__title">Покупайте выгодно</a>
        </div>
        <div class="stocks__main stocks-slider js-stocks-slider">
        	<?php foreach ($model as $key => $item): ?>
	            <a href="<?= Yii::app()->createUrl('/stocks/stocks/view', ['slug' => $item->slug]) ?>" class="stocks__item stocks-item">
					<img src="<?= $item->getImageUrl(); ?>" alt="<?= $item->title; ?>">
	            </a>
	        <?php endforeach ?>
        </div>
    </div>
</div>