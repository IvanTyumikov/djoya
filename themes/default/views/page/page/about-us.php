<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
$this->classLayout = 'about-layout';
// $this->breadcrumbs = $this->getBreadCrumbs();

$this->breadcrumbs = array_merge(
    [CHtml::encode($model->title)]
);
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: '';
if ($model->noindex) {
    $this->robots = 'noindex, nofollow';
}
?>

<div class="page-content about-us">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1><?= $model->title; ?></h1>
        <div class="about-us__content">
            <div class="text">
                <p>«Джойя» является одной из самых крупных и востребованных мастерских на территории РФ.</p>
                <p>Для нас главное – качество и результат. Наши свечи – это живые помощники и защитники, волшебные и полезные инструменты, которые подойдут и начинающему, и опытному практику.</p>
                <p>Мы создаем энергетически чистые свечи, свечи с программами и готовыми ритуалами, тонкие свечи, свечи для плотного взаимодействия с Духами и Богами, а также алтарные свечи для украшения, медитации и повседневного использования.</p>
                <p>У нас вы найдете уникальные, качественные магические товары, созданные и подобранные с любовью и вниманием. Алтарные принадлежности, амулеты и талисманы, черные зеркала, украшения и другие магические инструменты, необходимые как для колдовской практики, так и ежедневного использования в повседневной жизни.</p>
            </div>
            <div class="images">
                <img src="<?= $this->mainAssets . '/images/about/1.png' ?>" alt="">
                <img src="<?= $this->mainAssets . '/images/about/2.png' ?>" alt="">
                <img src="<?= $this->mainAssets . '/images/about/3.png' ?>" alt="">
            </div>
        </div>
    </div>
</div>