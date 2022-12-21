<section class="pop pr-slider">
    <div class="container">
        <div class="pop__top title_top">
            <div class="title">Каталог</div>
        </div>
        <div class="pop__main pr-slider__slider">
            <form id="pop-categories-filter" name="project-filter" method="get">
                <?php $this->widget('application.modules.store.widgets.CategoryListWidget'); ?>
            </form>
            <?php
                $this->widget(
                    'application.components.FtListView', [
                    'id' => 'project-list',
                    'itemView' => '../../product/_item',
                    'dataProvider' => $dataProvider,
                    'itemsCssClass' => 'js-pr-slider pr-slider__items',
                    'template' => '{items}{pager}',
                    'htmlOptions' => [
                        "class" => "project-list"
                    ],
                    'pagerCssClass' => 'pagination-box',
                    'pager' => [
                        'class' => 'application.components.ShowMorePager',
                        'buttonText' => '',
                        'wrapTag' => 'div',
                        'htmlOptions' => [
                            'class' => 'project-link-pager but-border'
                        ],
                        'wrapOptions' => [
                            'class' => 'project-button'
                        ],
                    ]
                ]); ?>
            <a href="<?= Yii::app()->createUrl('store/product/index') ?>" class="link-catalog">Перейти в каталог</a>
        </div>
    </div>
</section>