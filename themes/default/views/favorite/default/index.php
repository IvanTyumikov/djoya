<?php
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->getClientScript()->registerScriptFile(
    Yii::app()->getAssetManager()->publish(
        Yii::getPathOfAlias('application.modules.favorite.view.web') . '/favorite.js'
    ),
    CClientScript::POS_END
);

Yii::app()->clientScript->registerMetaTag('noindex, nofollow', 'robots');

$this->title = 'Избранные товары';
$this->breadcrumbs = [
    Yii::t("StoreModule.store", "Catalog") => ['/store/product/index'],
    'Избранные товары'
];
?>

<div class="page-content product-favorite">
    <div class="container">
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', [
                'links' => $this->breadcrumbs,
        ]); ?>
        <h1>Избранные товары</h1>
        <?php $this->widget(
            'zii.widgets.CListView', [
                'dataProvider' => $dataProvider,
                'viewData' => [
                    'isdelete' => true
                ],
                'itemView' => '//store/product/_item',
                'template' => '
                    {items}
                    {pager}
                ',
                'summaryText' => '',
                'enableHistory' => true,
                'cssFile' => false,
                'itemsCssClass' => 'product__items',
                'pagerCssClass' => 'pagination-box',
                'ajaxUpdate'=>'true',
                'pager' => [
                    'header' => '',
                    'lastPageLabel' => '<i class="icon-double_arrow-right" aria-hidden="true"></i>',
                    'firstPageLabel' => '<i class="icon-double_arrow-left" aria-hidden="true"></i>',
                    'prevPageLabel' => '<i class="icon-arrow-left" aria-hidden="true"></i>',
                    'nextPageLabel' => '<i class="icon-arrow-right" aria-hidden="true"></i>',
                    'maxButtonCount' => 5,
                    'htmlOptions' => [
                        'class' => 'pagination'
                    ],
                ]
            ]
        ); ?>
    </div>
</div>