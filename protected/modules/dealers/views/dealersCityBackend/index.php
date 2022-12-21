<?php
/**
 * Отображение для index:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('DealersModule.dealers', 'Города') => ['/dealers/dealersCityBackend/index'],
    Yii::t('DealersModule.dealers', 'Управление'),
];

$this->pageTitle = Yii::t('DealersModule.dealers', 'Города - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('DealersModule.dealers', 'Управление Городами'), 'url' => ['/dealers/dealersCityBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('DealersModule.dealers', 'Добавить Город'), 'url' => ['/dealers/dealersCityBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('DealersModule.dealers', 'Города'); ?>
        <small><?=  Yii::t('DealersModule.dealers', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('DealersModule.dealers', 'Поиск Городов');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('dealers-city-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('DealersModule.dealers', 'В данном разделе представлены средства управления Городами'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'dealers-city-grid',
        'type'         => 'striped condensed',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/dealers/dealersCityBackend/sortable',
        'type'         => 'condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            [
                'name' => 'image',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::image($model->getImageUrl(), $model->image, ["width" => 40, "height" => 40, "class" => "img-thumbnail"]);
                },
            ],
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/dealers/dealersCityBackend/update", "id" => $data->id]);
                    },
            ],
            'name_short',
            [
                'name' => 'big_city',
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'big_city', $model->getBigCityList(), ['encode' => false, 'empty' => '', 'class' => 'form-control']),
                'value' => function ($model) {
                    return ($model->big_city == 1) ? "Да" : "Нет";
                },
            ],

//            'meta_title',
//            'meta_keywords',
//            'meta_description',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/dealers/dealersCityBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    DealersCity::STATUS_PUBLIC => ['class' => 'label-success'],
                    DealersCity::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
