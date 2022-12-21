<?php
/**
 * Отображение для index:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('SliderModule.slider', 'Слайды') => ['/slider/sliderBackend/index'],
    Yii::t('SliderModule.slider', 'Управление'),
];

$this->pageTitle = Yii::t('SliderModule.slider', 'Слайды - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SliderModule.slider', 'Управление слайдами'), 'url' => ['/slider/sliderBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SliderModule.slider', 'Добавить слайд'), 'url' => ['/slider/sliderBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SliderModule.slider', 'Слайды'); ?>
        <small><?=  Yii::t('SliderModule.slider', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('SliderModule.slider', 'Поиск слайдов');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('slider-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('SliderModule.slider', 'В данном разделе представлены средства управления слайдами'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'slider-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/slider/sliderBackend/sortable',
        'type'         => 'condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            [
                'name' => 'image',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::image($model->getImageUrl(), $model->image, ["width" => 200, "height" => 200, "class" => "img-thumbnail"]);
                },
            ],
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/slider/sliderBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/slider/sliderBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Slider::STATUS_PUBLIC => ['class' => 'label-success'],
                    Slider::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
