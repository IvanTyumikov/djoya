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
    Yii::t('StocksModule.stocks', 'Stocks') => ['/stocks/stocksBackend/index'],
    Yii::t('StocksModule.stocks', 'Control'),
];


$this->pageTitle = Yii::t('StocksModule.stocks', 'Stocks - control');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('StocksModule.stocks', 'Control stocks'), 'url' => ['/stocks/stocksBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('StocksModule.stocks', 'Add stock'), 'url' => ['/stocks/stocksBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('StocksModule.stocks', 'Stocks'); ?>
        <small><?=  Yii::t('StocksModule.stocks', 'Control'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('StocksModule.stocks', 'Search stocks');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('stocks-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('StocksModule.stocks', 'This section provides a list of stocks'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'stocks-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            [
                'name' => 'title',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::link($model->title, array("/stocks/stocksBackend/update", "id" => $model->id));
                },
            ],
            'slug',
            [
                'name' => 'lang',
                'value' => '$data->getFlag()',
                'filter' => $this->yupe->getLanguagesList(),
                'type' => 'html',
            ],
            [
                'name' => 'badge',
                'value' => function ($model) {
                    return $model->badge;
                },
                'htmlOptions' => [
                    'class' => '',
                ],
            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/stocks/stocksBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Stocks::STATUS_PUBLISHED => ['class' => 'label-success'],
                    Stocks::STATUS_MODERATION => ['class' => 'label-warning'],
                    Stocks::STATUS_DRAFT => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
