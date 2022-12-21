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
    Yii::t('CityModule.city', 'Города') => ['/city/cityBackend/index'],
    Yii::t('CityModule.city', 'Добавление'),
];

$this->pageTitle = Yii::t('CityModule.city', 'Города - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CityModule.city', 'Управление Городами'), 'url' => ['/city/cityBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CityModule.city', 'Добавить Город'), 'url' => ['/city/cityBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CityModule.city', 'Города'); ?>
        <small><?=  Yii::t('CityModule.city', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>