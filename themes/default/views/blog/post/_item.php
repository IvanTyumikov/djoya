<?php

/**
 * @var $data Post
 */
?>
<div class="posts-list-block">
    <div class="posts-list-block-text">
        <p style="margin-top: 0;">
            <a href="<?= Yii::app()->createUrl('/blog/post/view', ['slug' => $data->slug]) ?>">
                <?= $data->getImageUrl() ? CHtml::image($data->getImageUrl(), CHtml::encode($data->title), ['class' => 'img-responsive']) : ''; ?>
            </a>
        </p>
        <div class="posts-list-block-header">
            <?= CHtml::link(
                CHtml::encode($data->title),
                ['/blog/post/view', 'slug' => $data->slug]
            ); ?>
        </div>
        <div class="posts-list-block-meta">
            <span>
                <?= file_get_contents('.' . $this->mainAssets . '/images/blog/calendar.svg') ?>
                <?= Yii::app()->getDateFormatter()->format("dd MMMM yyyy", $data->publish_time); ?>
            </span>
        </div>
        <!-- <div class="posts-list-block-quote">
            <?= strip_tags($data->getQuote()); ?>
        </div> -->
    </div>
</div>