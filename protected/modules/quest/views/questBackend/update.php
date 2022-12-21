<?php
/**
 * Отображение для update:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Nikkable
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://vk.com/nikkable
 **/
$this->breadcrumbs = [
    Yii::t('QuestModule.quest', 'Quest') => ['/quest/questBackend/index'],
    $model->name => ['/quest/questBackend/view', 'id' => $model->id],
    Yii::t('QuestModule.quest', 'Редактирование'),
];

$this->pageTitle = Yii::t('QuestModule.quest', 'Редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('QuestModule.quest', 'Управление'), 'url' => ['/quest/questBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('QuestModule.quest', 'Добавить'), 'url' => ['/quest/questBackend/create']],
    ['label' => Yii::t('QuestModule.quest', 'Видео') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('QuestModule.quest', 'Редактирование'), 'url' => [
        '/quest/questBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('QuestModule.quest', 'Просмотреть'), 'url' => [
        '/quest/questBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('QuestModule.quest', 'Удалить'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/quest/questBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('QuestModule.quest', 'Вы уверены, что хотите удалить?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('QuestModule.quest', 'Редактирование') . ' ' . Yii::t('QuestModule.quest', 'Quest'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>