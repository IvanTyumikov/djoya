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
    Yii::t('SliderModule.slider', 'Слайды') => ['/slider/sliderBackend/index'],
    Yii::t('SliderModule.slider', 'Добавление'),
];

$this->pageTitle = Yii::t('SliderModule.slider', 'Слайды - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SliderModule.slider', 'Управление слайдами'), 'url' => ['/slider/sliderBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SliderModule.slider', 'Добавить слайд'), 'url' => ['/slider/sliderBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SliderModule.slider', 'Слайды'); ?>
        <small><?=  Yii::t('SliderModule.slider', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>