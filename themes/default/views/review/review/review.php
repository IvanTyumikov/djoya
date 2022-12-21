<?php
$this->title = Yii::app()->getModule('review')->metaTitle ?: Yii::t('ReviewModule.news', 'Отзывы');
$this->description = Yii::app()->getModule('review')->metaDescription ?: Yii::app()->getModule('yupe')->siteDescription;

$this->keywords = Yii::app()->getModule('review')->metaKeyWords ?: Yii::app()->getModule('yupe')->siteKeyWords;
// $this->breadcrumbs = $this->getBreadCrumbs();
$this->breadcrumbs = ["Отзывы"];

if ($countImage) {
    $checkbox = 'checked';
} else {
    $checkbox = '';
}

$this->canonical = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/review';
?>

<div class="review page-content">
    <div class="container">
        <?php /*$this->widget('application.components.MyTbBreadcrumbs', [
                'links' => $this->breadcrumbs,
        ]);*/ ?>

        <h1 class="title">Все отзывы о товарах</h1>

        <div class="review__main">
            <?php $this->widget('application.modules.gallery.widgets.GalleryWidget', [
                'view' => 'review',
                'galleryId' => 4,
                'limit' => 1000,
                'js_class' => 'js-review-slider-stories-2'
            ]) ?>
        </div>

        <?php $this->widget('application.components.FtListView', [
            'id' => 'review-box',
            'itemView' => '_item',
            'dataProvider' => $dataProvider,
            'itemsCssClass' => 'review__lists',
            'template' => '
                {items}
                <div class="product-nav">
                    {pager}
                </div>
            ',
            'sortableAttributes' => [
                'date_created' => 'По дате',
            ],
            'sorterHeader' => 'Сортировать по:',
            'htmlOptions' => [
                "class" => "review__main"
            ],
            'pagerCssClass' => 'pagination-box',
            // 'emptyText' => '',
            'emptyTagName' => 'div',
            'emptyCssClass' => 'empty-form',
            'ajaxUpdate' => true,
            'enableHistory' => false,
            'pager' => [
                'class' => 'application.components.ShowMorePager',
                'buttonText' => 'Загрузить еще отзывы',
                'wrapTag' => 'div',
                'htmlOptions' => [
                    'class' => 'review-pagination__more button_border',
                ],
                'wrapOptions' => [
                    'class' => 'review-pagination'
                ],
            ],
            'pagerCssClass' => 'pagination-box',
        ]); ?>

    </div>
</div>