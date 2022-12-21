<?php
/* @var $orders Order[] */

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
$this->breadcrumbs = [
    "Личный кабинет" => [Yii::app()->createUrl('/user/profile/index')],
    Yii::t('OrderModule.order', 'Orders history')
];
$this->layout = "//layouts/user";

$this->title = Yii::t('OrderModule.order', 'Orders history');
?>

<!-- <h1><?= Yii::t('OrderModule.order', 'Orders history'); ?></h1> -->

<div class="lk-order grid">
    <div class="lk-order__header">
        <div class="lk-order__column lk-order__column-date"><?= Yii::t("OrderModule.order", "Date");?></div>
        <div class="lk-order__column lk-order__column-name"><?= Yii::t("OrderModule.order", "Order #");?></div>
        <div class="lk-order__column"><?= Yii::t("OrderModule.order", "Status");?></div>
    </div>
    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        [
            'dataProvider' => $dataProvider,
            'id' => '',
            'itemView' => '_item',
            'summaryText' => '',
            'template'=>'{items} {pager}',
            'itemsCssClass' => 'lk-order__box',
            'ajaxUpdate'=> true,
            'pagerCssClass' => 'pagination-box',
            'pager' => [
                'header' => '',
                'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                'maxButtonCount' => 5,
                'htmlOptions' => [
                    'class' => 'pagination'
                ],
            ]
        ]
    ); ?>
</div>