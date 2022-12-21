<?php
/**
 * Отображение для create:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Nikkable
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://vk.com/nikkable
 **/
$this->breadcrumbs = [
    Yii::t('QuestModule.quest', 'Категории') => ['/quest/questCategoryBackend/index'],
    Yii::t('QuestModule.quest', 'Добавление'),
];

$this->pageTitle = Yii::t('QuestModule.quest', 'Категории - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('QuestModule.quest', 'Управление Категориями'), 'url' => ['/quest/questCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('QuestModule.quest', 'Добавить Категорию'), 'url' => ['/quest/questCategoryBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('QuestModule.quest', 'Категории'); ?>
        <small><?=  Yii::t('QuestModule.quest', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>