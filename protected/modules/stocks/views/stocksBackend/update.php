<?php
/**
 * Отображение для update:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('StocksModule.stocks', 'Stocks') => ['/stocks/stocksBackend/index'],
    $model->title => ['/stocks/stocksBackend/view', 'id' => $model->id],
    Yii::t('stocksModule.stocks', 'Edit'),
];

$this->pageTitle = Yii::t('StocksModule.stocks', 'Edit stock');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('StocksModule.stocks', 'Control stocks'), 'url' => ['/stocks/stocksBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('StocksModule.stocks', 'Add stock'), 'url' => ['/stocks/stocksBackend/create']],
    ['label' => Yii::t('StocksModule.stocks', 'Тег') . ' «' . mb_substr($model->id, 0, 32) . '»'],
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
        <?=  Yii::t('StocksModule.stocks', 'Edit') . ' ' . Yii::t('StocksModule.stocks', 'stock'); ?>        <br/>
        <small>&laquo;<?=  $model->title; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model, 'languages' => $languages, 'langModels' => $langModels]); ?>