<?php
/* @var $model Page */
/* @var $this PageController */

$this->title = $model->meta_title ?: $model->title;
// $this->breadcrumbs = $this->getBreadCrumbs();

$this->breadcrumbs = array_merge(
    [CHtml::encode($model->title)]
);
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: '';
Yii::app()->clientScript->registerMetaTag('noindex, follow', 'robots');
?>

<div class="page-content">
	<div class="container">
		<?php $this->widget('application.components.MyTbBreadcrumbs', [
			'links' => $this->breadcrumbs,
		]); ?>
		<h1><?= $model->title; ?></h1>

		<?= $model->body; ?>
	</div>
</div>