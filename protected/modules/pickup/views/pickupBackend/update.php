<?php
/**
 * Отображение для update:
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
    $model->name => ['/pickup/pickupBackend/view', 'id' => $model->id],
    Yii::t('PickupModule.pickup', 'Редактирование'),
];

$this->pageTitle = Yii::t('PickupModule.pickup', 'Точки - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('PickupModule.pickup', 'Управление точками'), 'url' => ['/pickup/pickupBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('PickupModule.pickup', 'Добавить точку'), 'url' => ['/pickup/pickupBackend/create']],
    ['label' => Yii::t('PickupModule.pickup', 'Точка') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('PickupModule.pickup', 'Редактирование точки'), 'url' => [
        '/pickup/pickupBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('PickupModule.pickup', 'Просмотреть точку'), 'url' => [
        '/pickup/pickupBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('PickupModule.pickup', 'Удалить точку'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/pickup/pickupBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('PickupModule.pickup', 'Вы уверены, что хотите удалить точку?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('PickupModule.pickup', 'Редактирование') . ' ' . Yii::t('PickupModule.pickup', 'точки'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>