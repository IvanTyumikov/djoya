<?php
/* @var $data News */
?>

<div class="news__col news-box">
	<div class="news-box__row">
		<a href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $data->slug]); ?>" class="news-box__img">
			<img src="<?= $data->getImageUrl(450, 240) ?>" alt="">
		</a>
		<span class="news-box__date"><?= Yii::app()->dateFormatter->format("dd MMMM yyyy", $data->date); ?></span>
		<a href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $data->slug]); ?>" class="news-box__title"><?= $data->title ?></a>
	</div>
	<a href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $data->slug]); ?>" class="news-box__link-more">
		<span>Читать далее</span>
		<i class="icon-arrow-down"></i>
	</a>
</div>

