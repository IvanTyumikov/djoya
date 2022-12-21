<?php
/**
 * Отображение для index:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Nikkable
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://vk.com/nikkable
 **/
$this->breadcrumbs = [
    Yii::t('QuestModule.quest', 'Quest') => ['/quest/questBackend/index'],
    Yii::t('QuestModule.quest', 'Управление'),
];

$this->pageTitle = Yii::t('QuestModule.quest', 'Управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('QuestModule.quest', 'Управление'), 'url' => ['/quest/questBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('QuestModule.quest', 'Добавить'), 'url' => ['/quest/questBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('QuestModule.quest', 'Quest'); ?>
        <small><?=  Yii::t('QuestModule.quest', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('QuestModule.quest', 'Поиск');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('quest-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('QuestModule.quest', 'В данном разделе представлены средства управления'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'quest-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/quest/questBackend/sortable',
        'type'         => 'condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
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
                'url' => $this->createUrl('/quest/questBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Quest::STATUS_PUBLIC   => ['class' => 'label-success'],
                    Quest::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
