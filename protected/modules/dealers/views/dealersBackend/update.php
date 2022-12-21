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
    Yii::t('DealersModule.dealers', 'Дилеры') => ['/dealers/dealersBackend/index'],
    $model->name => ['/dealers/dealersBackend/view', 'id' => $model->id],
    Yii::t('DealersModule.dealers', 'Редактирование'),
];

$this->pageTitle = Yii::t('DealersModule.dealers', 'Дилеры - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('DealersModule.dealers', 'Управление Дилером'), 'url' => ['/dealers/dealersBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('DealersModule.dealers', 'Добавить Дилера'), 'url' => ['/dealers/dealersBackend/create']],
    ['label' => Yii::t('DealersModule.dealers', 'Дилер') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('DealersModule.dealers', 'Редактирование Дилера'), 'url' => [
        '/dealers/dealersBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('DealersModule.dealers', 'Просмотреть Дилера'), 'url' => [
        '/dealers/dealersBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('DealersModule.dealers', 'Удалить Дилера'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/dealers/dealersBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('DealersModule.dealers', 'Вы уверены, что хотите удалить Дилера?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('DealersModule.dealers', 'Редактирование') . ' ' . Yii::t('DealersModule.dealers', 'Дилера'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>