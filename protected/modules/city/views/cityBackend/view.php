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
    Yii::t('CityModule.city', 'Города') => ['/city/cityBackend/index'],
    $model->name,
];

$this->pageTitle = Yii::t('CityModule.city', 'Города - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CityModule.city', 'Управление Городами'), 'url' => ['/city/cityBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CityModule.city', 'Добавить Город'), 'url' => ['/city/cityBackend/create']],
    ['label' => Yii::t('CityModule.city', 'Город') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('CityModule.city', 'Редактирование Города'), 'url' => [
        '/city/cityBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('CityModule.city', 'Просмотреть Город'), 'url' => [
        '/city/cityBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('CityModule.city', 'Удалить Город'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/city/cityBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('CityModule.city', 'Вы уверены, что хотите удалить Город?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CityModule.city', 'Просмотр') . ' ' . Yii::t('CityModule.city', 'Города'); ?>        <br/>
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
        'category_id',
        'name_short',
        'name',
        'phone',
        'email',
        'mode',
        'address',
        'code_map',
        'coords',
        'description',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'position',
    ],
]); ?>
