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
    Yii::t('CityModule.city', 'Категории') => ['/city/cityCategoryBackend/index'],
    Yii::t('CityModule.city', 'Управление'),
];

$this->pageTitle = Yii::t('CityModule.city', 'Категории - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CityModule.city', 'Управление Категориями'), 'url' => ['/city/cityCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CityModule.city', 'Добавить Категорию'), 'url' => ['/city/cityCategoryBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CityModule.city', 'Категории'); ?>
        <small><?=  Yii::t('CityModule.city', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('CityModule.city', 'Поиск Категорий');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('city-category-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('CityModule.city', 'В данном разделе представлены средства управления Категориями'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'city-category-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/city/cityCategoryBackend/sortable',
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
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/city/cityCategoryBackend/update", "id" => $data->id]);
                    },
            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/city/cityCategoryBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    CityCategory::STATUS_PUBLIC => ['class' => 'label-success'],
                    CityCategory::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
