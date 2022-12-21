<?php if ($type == 'page'): ?>
	<li>
		<a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => $data->slug]) ?>"><?= $data->title ?></a>
	</li>
	<?php if ($data->slug == 'optovikam'): ?>
		<?php foreach (City::model()->getAvailableCities() as $city): ?>
			<li>
				<a href="<?=  Yii::app()->createUrl('page/page/view', ['city' => $city, 'slug' => $data->slug]) ?>">
					<?= $data->title ?>[[w:CityReplacement|caseRus=предложный;pretext=в;displayOnMain=false;city=<?=$city?>]]
				</a>
			</li>
		<?php endforeach ?>
	<?php endif ?>
<?php elseif ($type == 'post'): ?>
	<li>
		<a href="<?= Yii::app()->createUrl('blog/post/view', ['slug' => $data->slug]) ?>"><?= $data->title ?></a>
	</li>
<?php elseif ($type == 'product'): ?>
	<li>
		<a href="<?= Yii::app()->createUrl('store/product/view', ['name' => $data->slug]) ?>"><?= $data->title ?: $data->name ?></a>
	</li>
	<?php foreach (City::model()->getAvailableCities() as $city): ?>
		<li>
			<a href="<?=  Yii::app()->createUrl('store/product/view', ['city' => $city, 'name' => $data->slug]) ?>">
				<?= $data->title ?: $data->name ?>[[w:CityReplacement|caseRus=предложный;pretext=в;displayOnMain=false;city=<?=$city?>]]
			</a>
		</li>
	<?php endforeach ?>
<?php elseif ($type == 'category'): ?>
	<li>
		<a href="<?= Yii::app()->createUrl('store/category/view', ['path' => $data->slug]) ?>"><?= $data->name ?></a>
	</li>
	<?php foreach (City::model()->getAvailableCities() as $city): ?>
		<li>
			<a href="<?=  Yii::app()->createUrl('store/category/view', ['city' => $city, 'path' => $data->slug]) ?>">
				<?= $data->name ?>[[w:CityReplacement|caseRus=предложный;pretext=в;displayOnMain=false;city=<?=$city?>]]
			</a>
		</li>
	<?php endforeach ?>
<?php endif ?>