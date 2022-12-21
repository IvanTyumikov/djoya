<?php
/**
 * Отображение для create:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('VideoModule.video', 'Категории') => ['/video/videoCategoryBackend/index'],
    Yii::t('VideoModule.video', 'Добавление'),
];

$this->pageTitle = Yii::t('VideoModule.video', 'Категории - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('VideoModule.video', 'Управление Категориями'), 'url' => ['/video/videoCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('VideoModule.video', 'Добавить Категорию'), 'url' => ['/video/videoCategoryBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('VideoModule.video', 'Категории'); ?>
        <small><?=  Yii::t('VideoModule.video', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>