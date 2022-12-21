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
    Yii::t('PickupModule.pickup', 'Точки') => ['/pickup/pickupBackend/index'],
    Yii::t('PickupModule.pickup', 'Добавление'),
];

$this->pageTitle = Yii::t('PickupModule.pickup', 'Точки - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('PickupModule.pickup', 'Управление точками'), 'url' => ['/pickup/pickupBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('PickupModule.pickup', 'Добавить точку'), 'url' => ['/pickup/pickupBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('PickupModule.pickup', 'Точки'); ?>
        <small><?=  Yii::t('PickupModule.pickup', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>