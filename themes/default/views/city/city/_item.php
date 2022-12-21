<div class="geography-company-city__item js-writeToUs-item">
	<div class="geography-city fl fl-di-c fl-ju-co-sp-b">
		<div class="geography-city__item">
			<div class="geography-city__name">
				<?= CHtml::link($data->name_short, Yii::app()->createUrl('/city/city/view', ['slug' => $data->slug])) ?>
			</div>
		</div>
		<div class="geography-city__item">
			<div class="geography-city__phone">
				<?= $data->phone; ?>
			</div>
		</div>
		<div class="geography-city__item">
			<div class="geography-city__loc">
				<?= $data->address; ?>
			</div>
			<div class="geography-city__callback">
				<a class="geography-city__link" data-fancybox data-type="iframe" data-src="<?= $data->code_map; ?>" href="javascript:;">Показать на карте</a>
			</div>
		</div>
		<div class="geography-city__item">
			<div class="geography-city__email js-writeToUs-email-to">
				<?= $data->email; ?>
			</div>
			<div class="geography-city__callback">
				<a class="geography-city__link js-modal-writeToUs" href="#">Написать нам</a>
			</div>
		</div>
	</div>
</div>