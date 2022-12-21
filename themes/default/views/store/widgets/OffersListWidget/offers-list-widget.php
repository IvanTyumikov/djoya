<?php $active = $count > 0 ? 'active' : '' ; ?>

<div class="header-compare">
	<a class="header-compare__link" href="<?= Yii::app()->createUrl('/store/offers/view') ?>">
		<span class="header-compare__icon">
			<?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/compare.svg'); ?>
			<span class="header-compare__count <?= $active ?>"><?= $count; ?></span>
		</span>
		<span class="header-compare__txt"><?= Yii::t("StoreModule.store", "Comparison"); ?></span>
    </a>
</div>