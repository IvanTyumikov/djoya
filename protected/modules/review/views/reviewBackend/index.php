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
    $this->getModule()->getCategory() => [],
    Yii::t('ReviewModule.review', 'Отзывы') => ['/review/ReviewBackend/index'],
    Yii::t('ReviewModule.review', 'Управление'),
];

$this->pageTitle = Yii::t('ReviewModule.review', 'Отзывы - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ReviewModule.review', 'Управление Отзывами'), 'url' => ['/review/ReviewBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ReviewModule.review', 'Добавить Отзыв'), 'url' => ['/review/ReviewBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('ReviewModule.review', 'Отзывы'); ?>
        <small><?=  Yii::t('ReviewModule.review', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('ReviewModule.review', 'Поиск Отзывов');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('review-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('ReviewModule.review', 'В данном разделе представлены средства управления Отзывами'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'review-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/review/reviewBackend/sortable',
        'type'         => 'condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            'date_created',
            'username',
            'order',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'moderation',
                'url' => $this->createUrl('/review/reviewBackend/inline'),
                'source' => $model->getModerationList(),
                'options' => [
                    Review::STATUS_PUBLIC => ['class' => 'label-success'],
                    Review::STATUS_MODERATE => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
