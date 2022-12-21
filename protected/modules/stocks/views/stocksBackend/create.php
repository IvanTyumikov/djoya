<?php
/**
 * Отображение для create:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('StocksModule.stocks', 'Stocks') => ['/stocks/stocksBackend/index'],
    Yii::t('StocksModule.stocks', 'Add'),
];

$this->pageTitle = Yii::t('stocksModule.stocks', 'Add stock');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('StocksModule.stocks', 'Control stocks'), 'url' => ['/stocks/stocksBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('stocksModule.stocks', 'Add stock'), 'url' => ['/stocks/stocksBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('stocksModule.stocks', 'Stocks'); ?>
        <small><?=  Yii::t('StocksModule.stocks', 'Add'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model, 'languages' => $languages]); ?>