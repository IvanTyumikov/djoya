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
    $this->title = $model->meta_title ?: $model->title;
    $this->description = $model->meta_description;
    $this->keywords = $model->meta_keywords;
?>

<?php
    $this->breadcrumbs = [
        Yii::t('NewsModule.news', 'News') => ['/news/news/index'],
        $model->title
    ];
?>

<div class="page-content news-content">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
                'links' => $this->breadcrumbs,
        ]); ?>
        <div class="news-view">
            <div class="news-view__header">
                <?php if ($model->image): ?>
                    <div class="news-view__prev">
                        <?= CHtml::image($model->getImageUrl(), $model->title, ['class' => 'img-responsive']); ?>
                    </div>
                <?php endif; ?>

                <?php //Если превью нет, до добавляем класс, который дает 100% ширине ?>
                <div class="news-view__text <?= $model->image ? '' : 'news-view__no-prev' ?>">
                    <h1 class="news-view__t"><?= CHtml::encode($model->title); ?></h1>
                    <?= $model->short_text; ?>
                </div>
            </div>
            <div class="news-view__body">
                <?= $model->full_text; ?>
            </div>
        </div>
    </div>
</div>