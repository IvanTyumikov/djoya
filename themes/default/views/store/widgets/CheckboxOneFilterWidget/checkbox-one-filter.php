<div class="filter-checkbox">
    <?= CHtml::checkBoxList('discounts_product[]', !empty($_GET['discounts_product']) ? $_GET['discounts_product'] : [], Product::model()->getInDiscountsList(),
        array('template'=>'{input}{label}')
    ); ?>
</div>

<div class="filter-checkbox">
    <?= CHtml::checkBoxList('hits_product[]', !empty($_GET['hits_product']) ? $_GET['hits_product'] : [], Product::model()->getInHitsList(),
        array('template'=>'{input}{label}')
    ); ?>
</div>

<div class="filter-checkbox">
    <?= CHtml::checkBoxList('news_product[]', !empty($_GET['news_product']) ? $_GET['news_product'] : [], Product::model()->getInNewsList(),
        array('template'=>'{input}{label}')
    ); ?>
</div>
