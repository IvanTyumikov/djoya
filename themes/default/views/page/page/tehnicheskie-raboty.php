<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;

$this->breadcrumbs = array_merge(
    [CHtml::encode($model->title)]
);
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: '';
?>

<div class="page-content tehnic">
    <div class="container tehnic__wrapper">
        <?= file_get_contents('.' . $this->mainAssets . '/images/tehnicheskie-raboty/star.svg') ?>
        <h2>
            На сайте производятся <br>
            <strong>Технические работы</strong>
        </h2>
        <p>
            Мы скоро к вам вернёмся!
        </p>
    </div>
    <div class="kran">
        <?= file_get_contents('.' . $this->mainAssets . '/images/tehnicheskie-raboty/1.svg') ?>
    </div>
</div>