<?php
/**
 * Отображение для update:
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
    $model->id => ['/review/ReviewBackend/view', 'id' => $model->id],
    Yii::t('ReviewModule.review', 'Редактирование'),
];

$this->pageTitle = Yii::t('ReviewModule.review', 'Отзывы - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ReviewModule.review', 'Управление Отзывами'), 'url' => ['/review/ReviewBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ReviewModule.review', 'Добавить Отзыв'), 'url' => ['/review/ReviewBackend/create']],
    ['label' => Yii::t('ReviewModule.review', 'Отзыв') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('ReviewModule.review', 'Редактирование Отзыва'), 'url' => [
        '/review/ReviewBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('ReviewModule.review', 'Просмотреть Отзыв'), 'url' => [
        '/review/ReviewBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('ReviewModule.review', 'Удалить Отзыв'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/review/ReviewBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('ReviewModule.review', 'Вы уверены, что хотите удалить Отзыв?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('ReviewModule.review', 'Редактирование') . ' ' . Yii::t('ReviewModule.review', 'Отзыва'); ?>        <br/>
        <small>&laquo;<?=  $model->id; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>