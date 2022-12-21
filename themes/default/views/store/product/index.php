<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

/* @var $category StoreCategory */

$this->title = Yii::app()->getModule('store')->metaTitle ?: Yii::t('StoreModule.store', 'Catalog');
$this->description = Yii::app()->getModule('store')->metaDescription;
$this->keywords = Yii::app()->getModule('store')->metaKeyWords;

$this->breadcrumbs = [Yii::t("StoreModule.store", "Catalog")];
?>

<div class="category">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1>Каталог[[w:CityReplacement|caseRus=предложный;pretext=в;displayOnMain=false;]]</h1>
        <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
            'view' => 'category-index',
        ]); ?>
    </div>
</div>



