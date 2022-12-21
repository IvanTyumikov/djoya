<?php
$this->title = Yii::app()->getModule('news')->metaTitle ?: Yii::t('NewsModule.news', 'News');
$this->description = Yii::app()->getModule('news')->metaDescription;
$this->keywords = Yii::app()->getModule('news')->metaKeyWords;

$this->breadcrumbs = [Yii::t('NewsModule.news', 'Пресс-центр')];
?>

<div class="breadcrumbs">
    <div class="container">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
    </div>
</div>

<div class="news">
    <div class="container">
        <div class="news__top title_top">
            <div class="news__title title">Пресс-центр</div>
        </div>
        <div class="news__main">
        	<?php $this->widget(
				'bootstrap.widgets.TbListView',
				[
					'dataProvider' => $dataProvider,
					'itemView' => '_item',
					'template' => '{items}',
					'itemsCssClass' => 'news__row',
					'summaryText' => '',
				]
			); ?>
        </div>
    </div>
</div>
