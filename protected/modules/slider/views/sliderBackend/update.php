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
    Yii::t('SliderModule.slider', 'Слайды') => ['/slider/sliderBackend/index'],
    $model->name => ['/slider/sliderBackend/view', 'id' => $model->id],
    Yii::t('SliderModule.slider', 'Редактирование'),
];

$this->pageTitle = Yii::t('SliderModule.slider', 'Слайды - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SliderModule.slider', 'Управление слайдами'), 'url' => ['/slider/sliderBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SliderModule.slider', 'Добавить слайд'), 'url' => ['/slider/sliderBackend/create']],
    ['label' => Yii::t('SliderModule.slider', 'Слайд') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('SliderModule.slider', 'Редактирование слайда'), 'url' => [
        '/slider/sliderBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('SliderModule.slider', 'Просмотреть слайд'), 'url' => [
        '/slider/sliderBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('SliderModule.slider', 'Удалить слайд'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/slider/sliderBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('SliderModule.slider', 'Вы уверены, что хотите удалить слайд?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SliderModule.slider', 'Редактирование') . ' ' . Yii::t('SliderModule.slider', 'слайда'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>