<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
// $this->breadcrumbs = $this->getBreadCrumbs();

$this->breadcrumbs = array_merge(
    [CHtml::encode($model->title)]
);
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: '';
$sitemapLinks = $this->getSitemapLinks();
?>

<div class="page-content">
	<div class="container">
		<?php $this->widget('application.components.MyTbBreadcrumbs', [
			'links' => $this->breadcrumbs,
		]); ?>
		<h1><?= $model->title; ?></h1>

		<?php $this->widget(
		    'bootstrap.widgets.TbListView',
		    [
		        'id'           => 'pages',
		        'dataProvider' => $sitemapLinks['pages'],
		        'viewData' 	   => ['type' => 'page'],
		        'itemView'     => '_sitemap-link',
		        'itemsTagName' => 'ul',
		        'template'     => "{items}",
		        'ajaxUpdate'   => false,
		        'htmlOptions'  => [
		            'class' => 'sitemap-list'
		        ]
		    ]
		); ?>

		<ul>
			<li>
				<a href="<?= Yii::app()->createUrl('store/product/index') ?>">Модельный ряд</a>
				<?php foreach (City::model()->getAvailableCities() as $city): ?>
					<li>
						<a href="<?=  Yii::app()->createUrl('store/product/index', ['city' => $city]) ?>">
							Модельный ряд[[w:CityReplacement|caseRus=предложный;pretext=в;displayOnMain=false;city=<?=$city?>]]
						</a>
					</li>
				<?php endforeach ?>
			</li>
			
		</ul>
		<?php $this->widget(
		    'bootstrap.widgets.TbListView',
		    [
		        'id'           => 'category',
		        'dataProvider' => $sitemapLinks['categories'],
		        'viewData' 	   => ['type' => 'category'],
		        'itemView'     => '_sitemap-link',
		        'itemsTagName' => 'ul',
		        'template'     => "{items}",
		        'ajaxUpdate'   => false,
		        'htmlOptions'  => [
		            'class' => 'sitemap-list'
		        ]
		    ]
		); ?>
		<?php $this->widget(
		    'bootstrap.widgets.TbListView',
		    [
		        'id'           => 'product',
		        'dataProvider' => $sitemapLinks['products'],
		        'viewData' 	   => ['type' => 'product'],
		        'itemView'     => '_sitemap-link',
		        'itemsTagName' => 'ul',
		        'template'     => "{items}",
		        'ajaxUpdate'   => false,
		        'htmlOptions'  => [
		            'class' => 'sitemap-list'
		        ]
		    ]
		); ?>

		<!-- <br>
		<div style="margin-bottom: 20px;">
			<a href="<?= Yii::app()->createUrl('blog/post/index') ?>" class="title">Блог</a>
		</div> -->
		<?php /*$this->widget(
		    'bootstrap.widgets.TbListView',
		    [
		        'id'           => 'posts',
		        'dataProvider' => $sitemapLinks['posts'],
		        'viewData' 	   => ['type' => 'post'],
		        'itemView'     => '_sitemap-link',
		        'itemsTagName' => 'ul',
		        'template'     => "{items}",
		        'ajaxUpdate'   => false,
		        'htmlOptions'  => [
		            'class' => 'sitemap-list'
		        ]
		    ]
		); */?>
	</div>
</div>