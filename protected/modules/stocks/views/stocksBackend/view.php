<?php
/**
 * Отображение для view:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('StocksModule.stocks', 'Stocks') => ['/tags/tagsBackend/index'],
    $model->title,
];

$this->pageTitle = Yii::t('StocksModule.stocks', 'Views stock');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('StocksModule.stocks', 'Control stocks'), 'url' => ['/stocks/stocksBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('StocksModule.stocks', 'Add stock'), 'url' => ['/stocks/stocksBackend/create']],
    ['label' => Yii::t('StocksModule.Sstocks', 'Stock') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('StocksModule.stocks', 'Edit stock'), 'url' => [
        '/stocks/stocksBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('StocksModule.stocks', 'Views stock'), 'url' => [
        '/stocks/stocksBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('StocksModule.stocks', 'Delete stock'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/stocks/stocksBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('StocksModule.stocks', 'Are you sure you want to remove the tag?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('StocksModule.stocks', 'View') . ' ' . Yii::t('StocksModule.stocks', 'тега'); ?>        <br/>
        <small>&laquo;<?=  $model->title; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'title',
        'slug',
        'description',
    ],
]); ?>
