<?php

$this->title = $model->meta_title ?: $model->name;
$this->breadcrumbs = [
    'Филиалы' => '/filialy',
    $model->name
];
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>

<div class="page-content txt-style">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>


        <div class="city-view fl fl-wr-w fl-ju-co-sp-b">
            <div class="city-view__info">
                <h1><?= $model->name; ?></h1>
                <div class="city-view-contact">
                    <div class="city-view-contact__item fl fl-wr-w fl-al-it-fl-s">
                        <div class="city-view-contact__header">
                            <?= $model->getAttributeLabel('address'); ?>
                        </div>
                        <div class="city-view-contact__value">
                            <?= $model->getAddress(); ?>
                        </div>
                    </div>
                    <div class="city-view-contact__item fl fl-wr-w fl-al-it-fl-s">
                        <div class="city-view-contact__header">
                            <?= $model->getAttributeLabel('mode'); ?>
                        </div>
                        <div class="city-view-contact__value">
                            <?= $model->mode; ?>
                        </div>
                    </div>
                    <div class="city-view-contact__item fl fl-wr-w fl-al-it-fl-s">
                        <div class="city-view-contact__header">
                            <?= $model->getAttributeLabel('phone'); ?>
                        </div>
                        <div class="city-view-contact__value">
                            <?= $model->phone; ?>
                        </div>
                    </div>
                    <div class="city-view-contact__item fl fl-wr-w fl-al-it-fl-s">
                        <div class="city-view-contact__header">
                            <?= $model->getAttributeLabel('email'); ?>
                        </div>
                        <div class="city-view-contact__value">
                            <?= $model->email; ?>
                        </div>
                    </div>
                </div>
                <div class="catalog-price-home">
                    <div class="catalog-price-home__header">
                        Прайс-лист
                    </div>
                    <div class="catalog-price-home__body fl fl-al-it-c">
                        <div class="catalog-price-home__info fl fl-al-it-c">
                            <?= $model->getPriceInfo(); ?>
                        </div>
                        <div class="catalog-price-home__link">
                            <a class="" target="_blank" href="<?= $model->getPathPriceFile(); ?>">Скачать</a>
                        </div>
                    </div>
                    <br>
                    <div class="company-home__but" style="max-width: 320px;">
                        <a class="but but-svg but-svg-right but-svg-animation-plus but-animation" href="<?= Yii::app()->createUrl('/store/product/index') ?>">
                            <span>Перейти в интернет-магазин</span>
                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/plus.svg'); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="city-view__img">
                <?php if ($model->image) : ?>
                    <?= CHtml::image($model->getImageUrl(), ''); ?>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <?= $model->description; ?>
            <?php if ($model->code_map) : ?>
                <iframe src="<?= $model->code_map; ?>" width="100%" height="400" frameborder="0"></iframe>
            <?php endif; ?>
        </div>
    </div>
</div>
