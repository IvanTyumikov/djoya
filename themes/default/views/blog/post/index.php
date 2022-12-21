<?php

/**
 * @var $this PostController
 */
// $this->title = Yii::t('BlogModule.blog', 'Latest posts');
// $this->description = Yii::t('BlogModule.blog', 'Latest post');
$this->title = 'Полезные статьи для мастеров маникюра, педикюра, ботокса и кератина';
$this->description = 'Читайте в нашем блоге полезные статьи про маникюр, педикюр, ботокс и кератин. Блог от производителей вытяжек Анвикор⭐️ Самые полезные советы для всех кто хочет открыть маникюрный салон. Лайфхаки для мастеров маникюра, ботокса и кератина';
$this->keywords = Yii::t('BlogModule.blog', 'Latest post');
?>

<?php
Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/css/blog.min.css');
?>

<?php $this->breadcrumbs = [
    Yii::t('BlogModule.blog', 'Blog') => ['/blog/blog/index/'],
]; ?>

<div class="posts container">

    <?php $this->widget('application.components.MyTbBreadcrumbs', [
        'links' => $this->breadcrumbs,
    ]); ?>

    <h1 class="title">Журнал</h1>

    <div class="blog-wrapper">
        <div class="blog-sidebar">
            <div class="blog-categories">
                <a href="/blog/vdohnovenie">
                    Вдохновение
                </a>
            </div>
        </div>
        <?php $this->widget(
            'bootstrap.widgets.TbListView',
            [
                'id'           => 'posts-list',
                'dataProvider' => $model->allPosts(),
                'itemView'     => '_item',
                'template'     => "{items}\n{pager}",
                'ajaxUpdate'   => false,
                'htmlOptions'  => [
                    'class' => 'posts-list post-list-all'
                ]
            ]
        ); ?>
    </div>
</div>