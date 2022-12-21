<?php
/**
* Отображение для video/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     http://yupe.ru
**/
$this->title = Yii::t('VideoModule.video', 'video');
$this->description = Yii::t('VideoModule.video', 'video');
$this->keywords = Yii::t('VideoModule.video', 'video');

$this->breadcrumbs = [
	Yii::t('VideoModule.video', 'video')
]; ?>

<div class="page-header">
    <div class="page-header__heading">
        <div class="content">
            <?php $this->widget('application.components.MyTbBreadcrumbs', [
                'links' => $this->breadcrumbs,
            ]); ?>

            <h1><?= Yii::t('VideoModule.video', 'video'); ?></h1>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="content">

        <?php
        $this->widget(
            'application.components.FtListView',
            [
                'dataProvider' => $dataProvider,
                'id' => 'product-box',
                'itemView' => '_video',
                'emptyText'=>'В данной категории нет товаров.',
                'itemsCssClass' => 'video-box fl fl-wr-w product__items',
                'htmlOptions' => [],
                'template'     => "{items}\n{pager}",
                'ajaxUpdate'=> true,
                'enableHistory' => false,
                'pagerCssClass' => 'pagination-box-more',
                'pager' => [
                    'class' => 'application.components.ShowMorePager',
                    'buttonText' => 'Смотреть еще',
                    'wrapTag' => 'div',
                    'htmlOptions' => [
                        'class' => 'but but-animate-transform'
                    ],
                    'wrapOptions' => [
                        'class' => 'pagination-box__wrap'
                    ],
                ],
            ]
        ); ?>
    </div>
    <?php $fancybox = $this->widget(
        'gallery.extensions.fancybox3.AlFancybox', [
            'target' => '[data-fancybox]',
            'lang'   => 'ru',
            'config' => [
                'animationEffect' => "fade",
                'buttons' => [
                    "zoom",
                    "close",
                ]
            ],
        ]
    ); ?>
</div>
