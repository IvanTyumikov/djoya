<?php

/**
 * @var $this PostController
 */

$this->title = $post->meta_title ?: $post->title;
$this->description = !empty($post->meta_description) ? $post->meta_description : strip_tags($post->getQuote());
$this->keywords = !empty($post->meta_keywords) ? $post->meta_keywords : implode(', ', $post->getTags());

Yii::app()->clientScript->registerScript(
    "ajaxBlogToken",
    "var ajaxToken = " . json_encode(
        Yii::app()->getRequest()->csrfTokenName . '=' . Yii::app()->getRequest()->csrfToken
    ) . ";",
    CClientScript::POS_BEGIN
);

$this->breadcrumbs = [
    Yii::t('BlogModule.blog', 'Blog') => ['/blog/blog/index/'],
    CHtml::encode($post->blog->name)   => ['/blog/blog/view', 'slug' => $post->blog->slug],
    $post->title,
];

Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/css/blog.min.css');
?>

<div class="post-image">
    <?php if ($post->image) : ?>
        <?= CHtml::image($post->getImageUrl()); ?>
    <?php endif; ?>
    <div class="container post-main__info">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1 class="title"><strong><?= CHtml::encode($post->title); ?></strong></h1>
    </div>
</div>
<div class="post container blog-wrapper">
    <div class="post-content">
        <div class="post-content__wrapper">
            <div class="post-topper">
                <div class="post-topper__info">
                    <p class="author">
                        Евгения Андросенко
                    </p>
                    <p class="date">
                        <?= file_get_contents('.' . $this->mainAssets . '/images/blog/calendar.svg') ?>
                        <?= Yii::app()->getDateFormatter()->format("dd MMMM yyyy", $post->publish_time); ?>
                    </p>
                    <p class="views">
                        <?= file_get_contents('.' . $this->mainAssets . '/images/blog/views.svg') ?>
                        Просмотров: 0
                    </p>
                </div>
                <div class="post-topper__share">
                    <a class="btn-white" href="">
                        Поделиться
                    </a>
                </div>
            </div>
            <div class="post-time">
                <div class="timer">
                    <?= file_get_contents('.' . $this->mainAssets . '/images/blog/timer.svg') ?>
                    <p> Время чтения: <span>15 минут</span></p>
                </div>
                <div class="counter">
                    <?= file_get_contents('.' . $this->mainAssets . '/images/blog/comments.svg') ?>
                    <p>0 комментариев</p>
                </div>
            </div>
            <?= $post->content; ?>
        </div>
        <?php $this->widget('blog.widgets.SimilarPostsWidget', ['post' => $post]); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#post img').addClass('img-responsive');
        $('pre').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });
</script>

<?php $this->widget('application.modules.image.widgets.colorbox.ColorBoxWidget', [
    'targets' => [
        '#post img' => [
            'maxWidth'  => 1200,
            'maxHeight' => 800,
            'href'      => new CJavaScriptExpression("js:function(){
                    return $(this).prop('src');
                }")
        ]
    ]
]); ?>