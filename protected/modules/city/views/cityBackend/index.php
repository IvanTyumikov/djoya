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
    Yii::t('CityModule.city', 'Города') => ['/city/cityBackend/index'],
    Yii::t('CityModule.city', 'Управление'),
];

$this->pageTitle = Yii::t('CityModule.city', 'Города - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CityModule.city', 'Управление Городами'), 'url' => ['/city/cityBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CityModule.city', 'Добавить Город'), 'url' => ['/city/cityBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CityModule.city', 'Города'); ?>
        <small><?=  Yii::t('CityModule.city', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('CityModule.city', 'Поиск Городов');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('city-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('CityModule.city', 'В данном разделе представлены средства управления Городами'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'city-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/city/cityBackend/sortable',
        'columns'      => [
            'id',
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/city/cityBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'name' => 'slug',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->slug, 5), ["/city/cityBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'name'  => 'category_id',
                'value' => function($data){
                    $categoryList = '<span class="label label-primary">'. (isset($data->category) ? $data->category->name : '---') . '</span>';

                    return $categoryList;
                },
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'category_id', $model->getCategoryList(), ['encode' => false, 'empty' => '', 'class' => 'form-control']),
                'htmlOptions' => ['width' => '220px'],
            ],
            [
                'name'  => 'parent_id',
                'value' => function($data){
                    $parentCityList = '<span class="label label-primary">'. (isset($data->parentCity) ? $data->parentCity->name : '---') . '</span>';

                    return $parentCityList;
                },
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'parent_id', $model->getFormattedList(), ['encode' => false, 'empty' => '', 'class' => 'form-control']),
                'htmlOptions' => ['width' => '220px'],
            ],
//            'phone',
//            'email',
//            'mode',
//            'address',
//            'code_map',
//            'coords',
//            'description',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/city/cityBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    City::STATUS_PUBLIC => ['class' => 'label-success'],
                    City::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
