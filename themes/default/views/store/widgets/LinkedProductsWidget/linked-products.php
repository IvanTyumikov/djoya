<?php if ($dataProvider->getTotalItemCount()): ?>
<div class="product">
    <div class="container">
        <div class="product__top top">
            <div class="top__title">Похожие товары</div>
        </div>
        <div class="product__main product__items product-slider linked-product-slider js-product-slider">
            <?php foreach ($dataProvider->getData() as $key => $data) : ?>
                <div class="product__item product-item">
                    <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post" data-max-value='<?= (int)$data->quantity ?>'>
                        <input type="hidden" name="Product[id]" value="<?= $data->id; ?>"/>
                        <?= CHtml::hiddenField(
                            Yii::app()->getRequest()->csrfTokenName,
                            Yii::app()->getRequest()->csrfToken
                        ); ?>
                        <a href="<?= ProductHelper::getUrl($data); ?>" class="product-item__image product-item-image">
                            <span class="product-item-image__slider"> 
                                <img src="<?= StoreImage::product($data, 300, 300, false); ?>"
                                     alt="<?= CHtml::encode($data->getImageAlt()); ?>"
                                     title="<?= CHtml::encode($data->getImageTitle()); ?>">
                            </span>
                            <span class="product-item-image__discount">
                                <span class="value">-15%</span>
                            </span>
                        </a>
                        <div class="product-item__price product-item-price">
                            <div class="product-item-price__actual">
                                <span class="value"><?= str_replace('.00', '', number_format($data->getResultPrice(), 0, '.', ' ')); ?></span>
                                <span class="current">₽</span>
                            </div>
                            <?php if ($data->hasDiscount()) : ?>
                                <div class="product-item-price__old">
                                    <span class="value"><?= str_replace('.00', '', number_format($data->getBasePrice(), 2, '.', ' ')); ?></span>
                                    <span class="current">₽</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <a href="<?= ProductHelper::getUrl($data); ?>" class="product-item__name"><?= $data->getName() ?></a>
                        <div class="product-item__buts">
                            <a href="<?= ProductHelper::getUrl($data); ?>" class="product-item__link product-item__link-more">
                                <span class="value" data-text-animate="Подробнее">Подробнее</span>
                                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/product_arrow.svg'); ?>
                            </a>
                            <?php if(Yii::app()->hasModule('favorite')):?>
                                <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                                    'product' => $data,
                                    'view' => "favorite-item"
                                ]);?>
                            <?php endif;?>
                            <?php if (Yii::app()->hasModule('cart')) : ?>
                                <!-- <button class="product-item__cart but-add-cart" id="add-product-to-cart" onclick="yaCounter<?= Yii::app()->params['metrika'] ?>.reachGoal('add-to-cart');">
                                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/product_cart.svg'); ?>
                                </button> -->
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>


