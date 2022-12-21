<?php
/**
 * Отображение для view:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('SliderModule.slider', 'Слайды') => ['/slider/sliderBackend/index'],
    $model->name,
];

$this->pageTitle = Yii::t('SliderModule.slider', 'Слайды - просмотр');

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
        <?=  Yii::t('SliderModule.slider', 'Просмотр') . ' ' . Yii::t('SliderModule.slider', 'слайда'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'title',
        'slug',
        'logo',
        'image',
        'url',
        'name',
        'description_short',
        'description',
    ],
]); ?>
