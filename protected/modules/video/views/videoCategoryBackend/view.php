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
    Yii::t('VideoModule.video', 'Категории') => ['/video/videoCategoryBackend/index'],
    $model->name,
];

$this->pageTitle = Yii::t('VideoModule.video', 'Категории - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('VideoModule.video', 'Управление Категориями'), 'url' => ['/video/videoCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('VideoModule.video', 'Добавить Категорию'), 'url' => ['/video/videoCategoryBackend/create']],
    ['label' => Yii::t('VideoModule.video', 'Категория') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('VideoModule.video', 'Редактирование Категории'), 'url' => [
        '/video/videoCategoryBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('VideoModule.video', 'Просмотреть Категорию'), 'url' => [
        '/video/videoCategoryBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('VideoModule.video', 'Удалить Категорию'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/video/videoCategoryBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('VideoModule.video', 'Вы уверены, что хотите удалить Категорию?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('VideoModule.video', 'Просмотр') . ' ' . Yii::t('VideoModule.video', 'Категории'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'name',
        'status',
        'position',
    ],
]); ?>
