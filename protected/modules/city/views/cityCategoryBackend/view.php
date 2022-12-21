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
    Yii::t('CityModule.city', 'Категории') => ['/city/cityCategoryBackend/index'],
    $model->name,
];

$this->pageTitle = Yii::t('CityModule.city', 'Категории - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CityModule.city', 'Управление Категориями'), 'url' => ['/city/cityCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CityModule.city', 'Добавить Категорию'), 'url' => ['/city/cityCategoryBackend/create']],
    ['label' => Yii::t('CityModule.city', 'Категория') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('CityModule.city', 'Редактирование Категории'), 'url' => [
        '/city/cityCategoryBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('CityModule.city', 'Просмотреть Категорию'), 'url' => [
        '/city/cityCategoryBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('CityModule.city', 'Удалить Категорию'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/city/cityCategoryBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('CityModule.city', 'Вы уверены, что хотите удалить Категорию?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CityModule.city', 'Просмотр') . ' ' . Yii::t('CityModule.city', 'Категории'); ?>        <br/>
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
