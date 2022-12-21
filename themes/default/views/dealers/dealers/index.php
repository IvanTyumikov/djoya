<?php
/**
 * Отображение для ./themes/default/views/news/news/news.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 *
 * @var $this NewsController
 * @var $model News
 **/
?>
<?php
$this->title = $model->meta_title ?: $model->name;
$this->description = $model->meta_description;
$this->keywords = $model->meta_keywords;
?>

<?php
$this->breadcrumbs = [
    Yii::t('DealersModule.dealers', 'Дилерам') => ['/dealers/dealers/index'],
    $model->name
]; ?>

<div class="page-content">
    <div class="content">
        
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>

        <h1><?= CHtml::encode($model->name); ?></h1>
        <?= $model->description; ?>
    </div>
</div>
