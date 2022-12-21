<?php
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

$this->title =  $category->getMetaTitle();
$this->description = $category->getMetaDescription();
$this->keywords =  $category->getMetaKeywords();
$this->canonical = $category->getMetaCanonical();

$this->breadcrumbs = [Yii::t("StoreModule.store", "Catalog") => ['/store/product/index']];

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    $category->getBreadcrumbs(false)
);
?>

<div class="category-view" id="category-view">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <div class="sidebar-filter filter-mobile">
            <h3>Фильтр</h3>
            <div class="filter-group filter-materials">
                <div class="group-title">
                    Материал
                </div>
                <div class="filter-close">
                    <?= file_get_contents('.' . $this->mainAssets . '/images/icons/close.svg') ?>
                </div>
                <div class="group-list">
                    <div class="group-item">
                        <input type="checkbox" name="" id="material-1" class="tab-radio-input input-check" value="" data-price="">
                        <label class="tab-radio js-tab-radio gift-label" for="material-1" data-tab="">Камень</label>
                    </div>
                    <div class="group-item">
                        <input type="checkbox" name="" id="material-2" class="tab-radio-input input-check" value="" data-price="">
                        <label class="tab-radio js-tab-radio gift-label" for="material-2" data-tab="">Серебро</label>
                    </div>
                </div>
            </div>
            <div class="filter-group filter-materials">
                <div class="group-title">
                    Цвет
                </div>
                <div class="group-list">
                    <div class="group-item">
                        <input type="checkbox" name="" id="color-1" class="tab-radio-input input-check" value="" data-price="">
                        <label class="tab-radio js-tab-radio gift-label" for="color-1" data-tab="">Черный</label>
                    </div>
                    <div class="group-item">
                        <input type="checkbox" name="" id="color-2" class="tab-radio-input input-check" value="" data-price="">
                        <label class="tab-radio js-tab-radio gift-label" for="color-2" data-tab="">Белый</label>
                    </div>
                </div>
            </div>
            <a class="filter-apply" href="#">Применить</a>
        </div>
    </div>
    <div class="container category-main">
        <div class="sidebar-filter">
            <h3>Фильтр</h3>
            <div class="filter-list">
                <?php foreach ($categories as $cat) : ?>
                    <div class="filter-category <?= ($cat->slug == $category->slug ? 'active' : '') ?>">
                        <a href="/store/<?= $cat->slug ?>"><?= $cat->name ?></a>
                        <?php if ($cat->slug == $category->slug) : ?>
                            <!-- <div class="filter-category_children">
                                <a href="">test</a>
                            </div> -->
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <form id="store-filter" name="store-filter" method="get">
                <?php $this->widget('application.modules.store.widgets.filters.FilterBlockWidget', [
                    'attributes' => '*',
                    'category' => $category
                ]); ?>

            </form>


            <?php $this->widget('application.modules.store.widgets.ProductWidget', [
                'is_hit' => true,
                'title' => 'Хиты продаж',
                'view' => 'sidebar-slider',
                'order' => 't.update_time DESC'
            ]); ?>
        </div>
        <div class="category__wrapper">

            <h1><?= CHtml::encode($category->getTitle()); ?></h1>

            <?php if(!empty($category->children)):?>            
            <div class="tags">
                <?php foreach($category->children as $item):?>
                <div class="tags__list">
                    <div class="tags__item">
                        <a href="/store/<?= $item->slug;?>"><?= $item->name;?></a>
                    </div>                  
                </div>
                <?php endforeach;?>
            </div>            
            <?php endif;?>

            <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
                'view' => 'category-view',
                'currentCategoryId' => $category->id
            ]); ?>

            <div class="filter">
                <div class="filter__main">
                    <form id="store-filter" class="filter__form" name="store-filter" method="get">
                        <div class="filter__attr">
                            <div class="sort-box">
                                <div class="sort-box__label">
                                    <span>Сортировка: </span>
                                    <?/*= file_get_contents('.' . $this->mainAssets . '/images/icons/sort.svg') */ ?>
                                </div>
                                <div class="sort-box__wrap js-sort-box">
                                    <div class="sort-box__value">
                                        <span id="sort-box-value">По популярности</span>
                                        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/dropdown.svg');  ?>
                                    </div>
                                    <div class="sort-box__lists">
                                        <span class="sort-box__list" data-href="?<?/*= http_build_query($_GET) */ ?>&sort=visits.desc">По популярности</span>
                                        <span class="sort-box__list" data-href="?<?/*= http_build_query($_GET) */ ?>&sort=price_result.desc">Сначала дорогие</span>
                                        <span class="sort-box__list" data-href="?<?/*= http_build_query($_GET) */ ?>&sort=price_result">Сначала дешевые</span>
                                        <span class="sort-box__list" data-href="?<?/*= http_build_query($_GET) */ ?>&sort=name">По алфавиту</span>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-mobile__opener">
                                <?= file_get_contents('.' . $this->mainAssets . '/images/icons/filter.svg') ?>
                                Фильтр
                            </div>
                        </div>
                    </form>
                    <div class="template-product">
                        <div data-view="_item-list" class="template-product__item <?/*= $this->storeItem == "_item-list" ? "active" : "" */ ?>">
                            <?/*= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/filter-view-lists.svg') */ ?>
                        </div>
                        <div data-view="_item" class="template-product__item <?/*= $this->storeItem == "_item" ? "active" : "" */ ?>">
                            <?/*= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/filter-view-items.svg') */ ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $this->widget(
                'application.components.MyListView',
                [
                    'dataProvider' => $dataProvider,
                    'id' => 'product-box',
                    'itemView' => '//store/product/' . $this->storeItem,
                    'emptyText' => 'По заданным параметрам товары не найдены',
                    'summaryTagName' => 'div',
                    'summaryCssClass' => 'items-info-count',
                    'summaryText' => '
                        <div class="items-info-count__label">Товаров на странице:</div>
                        <div class="items-info-count__value">{start}-{end} из {count}</div>
                    ',
                    'sorterDropDown' => [
                        'visits.desc' => 'Популярные',
                        'price_result' => 'Дешевле',
                        'price_result.desc' => 'Дороже',
                        'name' => 'По алфавиту',
                        'raiting.desc' => 'По рейтингу',
                    ],
                    'sorterClassUl' => 'sort-box__list',
                    'sorterHeader' => '',
                    'itemsCssClass' => 'product__items',
                    'htmlOptions' => [],
                    'template' => '
                        {items}
                        <div class="product-nav">
                            {pager}
                        </div>
                    ',
                    'ajaxUpdate' => true,
                    'enableHistory' => true,
                    'pagerCssClass' => 'pagination-box',
                    'pager' => [
                        'header' => '',
                        'lastPageLabel' => '<i class="icon-double_arrow-right" aria-hidden="true"></i>',
                        'firstPageLabel' => '<i class="icon-double_arrow-left" aria-hidden="true"></i>',
                        'prevPageLabel' => '<i class="icon-arrow-left" aria-hidden="true"></i>',
                        'nextPageLabel' => '<i class="icon-arrow-right" aria-hidden="true"></i>',
                        'maxButtonCount' => 5,
                        'htmlOptions' => [
                            'class' => 'pagination'
                        ],
                    ]
                ]
            ); ?>

          <?php if(!empty($category->children)):?>    
          <div class="tags">
                <h4>Теги</h4>
                 <?php foreach($category->children as $item):?>
                <div class="tags__list">
                    <div class="tags__item">
                        <a href="/store/<?= $item->slug;?>"><?= $item->name;?></a>
                    </div>                  
                </div>
                <?php endforeach;?>
            </div>            
            <?php endif;?>

            <div class="seo-text">
                <div class="seo-text_body">
                    <h2>
                        Амулеты, украшения и сувениры
                    </h2>
                    <p>
                        Эзотерические товары и вера в силу различных даров природы пришли к нам из далекой древности и по-прежнему актуальны для людей во всем мире. В каталоге нашего сайта широко представлены различные талисманы и амулеты, красивые браслеты, стильные медальоны, изящные кулоны, восковые свечи, гадальные карты и руны, и многое другое. Узнайте больше о товарах и их свойствах на страницах нашего сайта.
                    </p>
                    <h3>
                        Регулярное обновление ассортимента
                    </h3>
                    <p>
                        Мы постоянно следим за модными тенденциями и пополняем каталог новыми товарами. Устраиваем распродажи, в рамках которых покупатели могут приобрести товары с дисконтом. Скидки в нашем магазине позволяют сделать выгодные покупки. Информация об акциях публикуется в специальном разделе.
                    </p>
                    <h3>
                        Гарантия качества
                    </h3>
                    <p>
                        Мы сотрудничаем только с проверенными деловыми партнерами, отдавая предпочтение надежным производителями и поставщиками для того, чтобы наша репутация и ваши покупки оставались безупречными.
                    </p>
                </div>
            </div>

            <?php if(!empty($category->children)):?>           
            <div class="tags">
                <h4>Теги</h4>
                 <?php foreach($category->children as $item):?>
                <div class="tags__list">
                    <div class="tags__item">
                        <a href="/store/<?= $item->slug;?>"><?= $item->name;?></a>
                    </div>                  
                </div>
                <?php endforeach;?>
            </div>            
            <?php endif;?>

            <div class="category-view__desc">
                <?php if ($category->description) : ?>
                    <?= $category->description ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>