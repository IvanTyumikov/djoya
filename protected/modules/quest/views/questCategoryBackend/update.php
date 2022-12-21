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
    Yii::t('QuestModule.quest', 'Категории') => ['/quest/questCategoryBackend/index'],
    $model->name => ['/quest/questCategoryBackend/view', 'id' => $model->id],
    Yii::t('QuestModule.quest', 'Редактирование'),
];

$this->pageTitle = Yii::t('QuestModule.quest', 'Категории - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('QuestModule.quest', 'Управление'), 'url' => ['/quest/questCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('QuestModule.quest', 'Добавить'), 'url' => ['/quest/questCategoryBackend/create']],
    ['label' => Yii::t('QuestModule.quest', 'Категория') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('QuestModule.quest', 'Редактирование'), 'url' => [
        '/quest/questCategoryBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('QuestModule.quest', 'Просмотреть'), 'url' => [
        '/quest/questCategoryBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('QuestModule.quest', 'Удалить'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/quest/questCategoryBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('QuestModule.quest', 'Вы уверены, что хотите удалить Категорию?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('QuestModule.quest', 'Редактирование') . ' ' . Yii::t('QuestModule.quest', 'Категории'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>