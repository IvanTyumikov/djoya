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
    Yii::t('PickupModule.pickup', 'Точки') => ['/pickup/pickupBackend/index'],
    Yii::t('PickupModule.pickup', 'Управление'),
];

$this->pageTitle = Yii::t('PickupModule.pickup', 'Точки - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('PickupModule.pickup', 'Управление точками'), 'url' => ['/pickup/pickupBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('PickupModule.pickup', 'Добавить точку'), 'url' => ['/pickup/pickupBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('PickupModule.pickup', 'Точки'); ?>
        <small><?=  Yii::t('PickupModule.pickup', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('PickupModule.pickup', 'Поиск точек');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('pickup-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('PickupModule.pickup', 'В данном разделе представлены средства управления точками'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'pickup-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            'name',
            'address',
            'description',
            'mode',
            'phone',
//            'email',
//            'latitude',
//            'longitude',
//            'status',
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
