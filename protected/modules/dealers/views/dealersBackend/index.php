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
    Yii::t('DealersModule.dealers', 'Дилеры') => ['/dealers/dealersBackend/index'],
    Yii::t('DealersModule.dealers', 'Управление'),
];

$this->pageTitle = Yii::t('DealersModule.dealers', 'Дилеры - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('DealersModule.dealers', 'Управление Дилером'), 'url' => ['/dealers/dealersBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('DealersModule.dealers', 'Добавить Дилера'), 'url' => ['/dealers/dealersBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('DealersModule.dealers', 'Дилеры'); ?>
        <small><?=  Yii::t('DealersModule.dealers', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('DealersModule.dealers', 'Поиск Дилеров');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('dealers-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('DealersModule.dealers', 'В данном разделе представлены средства управления Дилером'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'dealers-grid',
        'type'         => 'striped condensed',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/dealers/dealersBackend/sortable',
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
                'name'  => 'city_id',
                'value' => function($data){
                    $categoryList = '<span class="label label-primary">'. (isset($data->cityDealers) ? $data->cityDealers->name_short : '---') . '</span>';

                    return $categoryList;
                },
                'type' => 'raw',
                'filter' => CHtml::activeDropDownList($model, 'city_id', $model->getCityList(), ['encode' => false, 'empty' => '', 'class' => 'form-control']),
                'htmlOptions' => ['width' => '220px'],
            ],
            [
                'name' => 'name',
                'type' => 'raw',
                'value' => function ($data) {
                        return CHtml::link(\yupe\helpers\YText::wordLimiter($data->name, 5), ["/dealers/dealersBackend/update", "id" => $data->id]);
                    },
            ],
            // 'name_short',
//            'phone',
//            'location',
//            'mode',
//            'coords',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/dealers/dealersBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Dealers::STATUS_PUBLIC => ['class' => 'label-success'],
                    Dealers::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
