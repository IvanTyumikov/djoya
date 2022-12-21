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
    $this->getModule()->getCategory() => [],
    Yii::t('ReviewModule.review', 'Отзывы') => ['/review/ReviewBackend/index'],
    Yii::t('ReviewModule.review', 'Добавление'),
];

$this->pageTitle = Yii::t('ReviewModule.review', 'Отзывы - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ReviewModule.review', 'Управление Отзывами'), 'url' => ['/review/ReviewBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ReviewModule.review', 'Добавить Отзыв'), 'url' => ['/review/ReviewBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('ReviewModule.review', 'Отзывы'); ?>
        <small><?=  Yii::t('ReviewModule.review', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>