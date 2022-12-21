<?php

/**
 * @var Category $category
 */

$this->title = Yii::app()->getModule('stocks')->title ?: Yii::t('StocksModule.stocks', 'Stocks');
$this->description = Yii::app()->getModule('stocks')->description;

$this->breadcrumbs = [
    'Акции'
];
?>
<div class="breadcrumbs">
    <div class="container">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        ); ?>
    </div>
</div>

<div class="stocks stocks-index">
    <div class="container">
        <div class="stocks__top">
            <h1 class="stocks__title">Акции</h1>
        </div>
        <div class="stocks__main">
            <?php foreach ($model as $key => $item) : ?>
                <div class="stocks__item stocks-item">
                    <div class="stocks__preview">
                        <img src="<?= $item->getImageUrl(); ?>" alt="<?= $item->title; ?>">
                    </div>
                    <div class="stocks__info">
                        <div class="stocks__name">
                            <p>
                                <?= $item->title; ?>
                            </p>
                        </div>
                        <div class="stocks__text">
                            <?= $item->full_text; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="stocks__banners">
            <a href="https://t.me/anvikor_ru" target="_blank">
                <img src="<?= Yii::app()->getTheme()->getAssetsUrl(); ?>/images/stocks-banners/telegram.png" alt="">
            </a>
            <a href="https://vk.com/app5898182_-204274054#s=1769777" target="_blank">
                <img src="<?= Yii::app()->getTheme()->getAssetsUrl(); ?>/images/stocks-banners/vk.png" alt="">
            </a>
        </div>
    </div>
</div>