<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

/* @var $category StoreCategory */
$this->title = Yii::t("StoreModule.store", "Search");
$this->breadcrumbs = [
    Yii::t("StoreModule.store", "Catalog") => ['/store/product/index'],
    Yii::t("StoreModule.store", "Search"),
];
?>

<div class="category-view">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>


        <div class="title">
            Поиск по:   <?= CHtml::encode(Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME)) ?>
        </div>

        <?php
        $this->widget(
            'application.components.MyListView',
            [
                'dataProvider' => $dataProvider,
                'id' => 'product-box',
                'itemView' => '//store/product/'.$this->storeItem,
                'emptyText'=>'По заданным параметрам товары не найдены',
                'summaryTagName' => 'div',
                'summaryCssClass' => 'items-info-count',
                'summaryText' => '
                        <div class="items-info-count__label">Товаров на странице:</div>
                        <div class="items-info-count__value">{start}-{end} из {count}</div>
                    ',
                'sorterDropDown' => [
                    'visits.desc' => 'Популярные',
                    'price_result' => 'Дешевле',
                    'price_result.desc' => 'Дороже',
                    'name' => 'По алфавиту',
                    'raiting.desc' => 'По рейтингу',
                ],
                'sorterClassUl' => 'sort-box__list',
                'sorterHeader' => '',
                'itemsCssClass' => 'product__items',
                'htmlOptions' => [],
                'template'=> '
                        {items}
                        <div class="product-nav">
                            {pager}
                        </div>
                    ',
                'ajaxUpdate'=> true,
                'enableHistory' => true,
                'pagerCssClass' => 'pagination-box',
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

