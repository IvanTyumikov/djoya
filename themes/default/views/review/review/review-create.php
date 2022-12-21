
<?php
$this->title = Yii::app()->getModule('review')->metaTitle ?: Yii::t('ReviewModule.news', 'Оставить отзыв');
$this->description = Yii::app()->getModule('review')->metaDescription ?: Yii::app()->getModule('yupe')->siteDescription;

$this->keywords = Yii::app()->getModule('review')->metaKeyWords ?: Yii::app()->getModule('yupe')->siteKeyWords;
// $this->breadcrumbs = $this->getBreadCrumbs();
$this->breadcrumbs = ["Оставить отзыв"];

Yii::app()->clientScript->registerMetaTag('noindex, nofollow', 'robots');

?>

<div class="review page-content">
    <div class="review-form" id="review-form">
        <div class="container">
            <h1 class="title">Оставить отзыв о компании</h1>
            <?php $this->widget('application.modules.review.widgets.ReviewFormWidget'); ?>
        </div>
    </div>
</div>