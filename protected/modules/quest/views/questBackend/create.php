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
    Yii::t('QuestModule.quest', 'Quest') => ['/quest/questBackend/index'],
    Yii::t('QuestModule.quest', 'Добавление'),
];

$this->pageTitle = Yii::t('QuestModule.quest', 'Добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('QuestModule.quest', 'Управление'), 'url' => ['/quest/questBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('QuestModule.quest', 'Добавить'), 'url' => ['/quest/questBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('QuestModule.quest', 'Quest'); ?>
        <small><?=  Yii::t('QuestModule.quest', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>