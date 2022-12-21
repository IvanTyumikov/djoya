<div class="prev-stock">
	<?php foreach ($pages as $page): ?>
		<div class="prev-stock__item prev-stock-box">
			<div class="prev-stock-box__img">
				<img src="<?= $page->getImageUrl(); ?>" alt="">
			</div>
			<div class="prev-stock-box__name">
				<?= $page->title; ?>
			</div>
			<div class="prev-stock-box__desc">
				<?= $page->text_mirror; ?>
			</div>
			<a href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$page->slug]);?>" class="prev-stock-box__link">
				<span>Подробнее</span>
				<i class="icon-arrow-next"></i>
			</a>
		</div>
	<?php endforeach ?>
</div>

