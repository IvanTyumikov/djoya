<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
// $this->breadcrumbs = $this->getBreadCrumbs();

$this->breadcrumbs = array_merge(
    [CHtml::encode($model->title)]
);
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: '';
if ($model->noindex) {
    $this->robots = 'noindex, nofollow';
}
?>

<div class="page-content">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>

        <h1><?= $model->title; ?></h1>

        <div class="wg-product">
            <div class="container">
                <?php $this->widget('application.modules.store.widgets.ProductWidget', [
                    'is_hit' => true,
                    'title' => 'Хиты продаж',
                    'view' => 'product-home',
                    'order' => 't.update_time DESC'
                ]); ?>
            </div>
        </div>
    </div>
</div>