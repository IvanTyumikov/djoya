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
    Yii::t('QuestModule.quest', 'Категории') => ['/quest/questCategoryBackend/index'],
    Yii::t('QuestModule.quest', 'Управление'),
];

$this->pageTitle = Yii::t('QuestModule.quest', 'Категории - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('QuestModule.quest', 'Управление'), 'url' => ['/quest/questCategoryBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('QuestModule.quest', 'Добавить'), 'url' => ['/quest/questCategoryBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('QuestModule.quest', 'Категории'); ?>
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
            $.fn.yiiGridView.update('quest-category-grid', {
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
        'id'           => 'quest-category-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/quest/questCategoryBackend/sortable',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            'name',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/quest/questCategoryBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    QuestCategory::STATUS_PUBLIC   => ['class' => 'label-success'],
                    QuestCategory::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
