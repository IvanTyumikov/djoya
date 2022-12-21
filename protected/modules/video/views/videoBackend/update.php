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
    Yii::t('VideoModule.video', 'Видео') => ['/video/videoBackend/index'],
    $model->name => ['/video/videoBackend/view', 'id' => $model->id],
    Yii::t('VideoModule.video', 'Редактирование'),
];

$this->pageTitle = Yii::t('VideoModule.video', 'Видео - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('VideoModule.video', 'Управление видео'), 'url' => ['/video/videoBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('VideoModule.video', 'Добавить видео'), 'url' => ['/video/videoBackend/create']],
    ['label' => Yii::t('VideoModule.video', 'Видео') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('VideoModule.video', 'Редактирование видео'), 'url' => [
        '/video/videoBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('VideoModule.video', 'Просмотреть видео'), 'url' => [
        '/video/videoBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('VideoModule.video', 'Удалить видео'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/video/videoBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('VideoModule.video', 'Вы уверены, что хотите удалить видео?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('VideoModule.video', 'Редактирование') . ' ' . Yii::t('VideoModule.video', 'видео'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>