<?php $this->breadcrumbs = [
    'Каталог' => '/store',
    'Сравнение'
];
$this->title = 'Сравнение товаров';
?>

<div class="page-content">
    <div class="container">
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <?php if (empty($products)) : ?>
            <h1>Вы не добавляли товары в сравнение</h1>
        <?php else : ?>
            <div class="stocks__top title_top">
                <h1 class="stocks__title title">Сравнение товаров</h1>
                <a class="stocks__cat-link link-arrow" href="<?= Yii::app()->createUrl('/store/offers/clear') ?>">
                    <span>Удалить список</span>
                    <i class="icon-close"></i>
                </a>
            </div>
            <div id="product-compare-carousel">
                <?php Yii::app()->controller->renderPartial('_item', [
                    'products' => $products,
                    'attr' => $attr,
                ]); ?>
            </div>
        <?php endif; ?>
   </div>
</div>