<?php
/**
 * Отображение для create:
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
    Yii::t('CityModule.city', 'Добавление'),
];

$this->pageTitle = Yii::t('CityModule.city', 'Категории - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CityModule.city', 'Управление Категориями'), 'url' => ['/city/cityCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CityModule.city', 'Добавить Категорию'), 'url' => ['/city/cityCategoryBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CityModule.city', 'Категории'); ?>
        <small><?=  Yii::t('CityModule.city', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>