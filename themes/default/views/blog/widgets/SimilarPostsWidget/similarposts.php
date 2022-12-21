<?php Yii::import('application.modules.blog.BlogModule'); ?>

<?php if (count($posts)): ?>
    <h4 class="title"><?= Yii::t('BlogModule.blog', 'Read also:'); ?></h4>

    <div class="related-posts posts-list">
        <div class="items">
            <?php foreach ($posts as $post): ?>
            <div class="posts-list-block">
                <div class="posts-list-block-text">
                    <p style="margin-top: 0;">
                        <a href="<?= Yii::app()->createUrl('/blog/post/view', ['slug' => $post->slug]) ?>">
                        <?= $post->getImageUrl() ? CHtml::image($post->getImageUrl(), CHtml::encode($post->title), ['class' => 'img-responsive']) : ''; ?>
                        </a>
                    </p>
                    <div class="posts-list-block-header">
                        <?= CHtml::link(
                            CHtml::encode($post->title),
                            ['/blog/post/view', 'slug' => $post->slug]
                        ); ?>
                    </div>
                    <div class="posts-list-block-meta">
                        <span>
                            <i class="glyphicon glyphicon-calendar"></i>

                            <?= Yii::app()->getDateFormatter()->formatDateTime(
                                $post->publish_time,
                                "long",
                                "short"
                            ); ?>
                        </span>
                    </div>
                    <div class="posts-list-block-quote">
                        <?= strip_tags($post->getQuote()); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
