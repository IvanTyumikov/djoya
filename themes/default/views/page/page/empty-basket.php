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
?>

<div class="page-content empty-basket">
    <div class="container">
        <div class="empty-basket__content">
            <h1>
                Сложите в корзину нужные товары
            </h1>
            <h2>
                А что бы их найти загляните в каталог
            </h2>
            <a class="go-to-catalog" href="/store" class="btn btn-white">В каталог</a>
            <a class="go-to-main" href="/">На главную</a>
        </div>
    </div>
</div>