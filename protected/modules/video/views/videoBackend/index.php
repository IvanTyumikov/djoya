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
    Yii::t('VideoModule.video', 'Видео') => ['/video/videoBackend/index'],
    Yii::t('VideoModule.video', 'Управление'),
];

$this->pageTitle = Yii::t('VideoModule.video', 'Видео - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('VideoModule.video', 'Управление видео'), 'url' => ['/video/videoBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('VideoModule.video', 'Добавить видео'), 'url' => ['/video/videoBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('VideoModule.video', 'Видео'); ?>
        <small><?=  Yii::t('VideoModule.video', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('VideoModule.video', 'Поиск видео');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('video-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('VideoModule.video', 'В данном разделе представлены средства управления видео'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'video-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/video/videoBackend/sortable',
        'type'         => 'condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            [
                'name' => 'image',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::image($model->getImageUrl(), $model->image, ["width" => 100, "height" => 100, "class" => "img-thumbnail"]);
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
            'name',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/video/videoBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Video::STATUS_PUBLIC   => ['class' => 'label-success'],
                    Video::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
