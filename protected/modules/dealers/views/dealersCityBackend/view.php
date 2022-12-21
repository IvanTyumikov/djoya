<?php
/**
 * Отображение для view:
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
    $model->name,
];

$this->pageTitle = Yii::t('DealersModule.dealers', 'Города - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('DealersModule.dealers', 'Управление Городами'), 'url' => ['/dealers/dealersCityBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('DealersModule.dealers', 'Добавить Город'), 'url' => ['/dealers/dealersCityBackend/create']],
    ['label' => Yii::t('DealersModule.dealers', 'Город') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('DealersModule.dealers', 'Редактирование Города'), 'url' => [
        '/dealers/dealersCityBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('DealersModule.dealers', 'Просмотреть Город'), 'url' => [
        '/dealers/dealersCityBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('DealersModule.dealers', 'Удалить Город'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/dealers/dealersCityBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('DealersModule.dealers', 'Вы уверены, что хотите удалить Город?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('DealersModule.dealers', 'Просмотр') . ' ' . Yii::t('DealersModule.dealers', 'Города'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'create_user_id',
        'update_user_id',
        'create_time',
        'update_time',
        'name_short',
        'name',
        'image',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
        'position',
    ],
]); ?>
