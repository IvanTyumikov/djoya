<?php
/**
 * Отображение для create:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('DealersModule.dealers', 'Города') => ['/dealers/dealersCityBackend/index'],
    Yii::t('DealersModule.dealers', 'Добавление'),
];

$this->pageTitle = Yii::t('DealersModule.dealers', 'Города - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('DealersModule.dealers', 'Управление Городами'), 'url' => ['/dealers/dealersCityBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('DealersModule.dealers', 'Добавить Город'), 'url' => ['/dealers/dealersCityBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('DealersModule.dealers', 'Города'); ?>
        <small><?=  Yii::t('DealersModule.dealers', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>