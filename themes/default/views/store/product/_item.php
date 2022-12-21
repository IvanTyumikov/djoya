<div class="product__item product-item js-product-item">
    <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post" data-max-value='<?= (int)$data->quantity ?>'>
        <input type="hidden" name="Product[id]" value="<?= $data->id; ?>" />
        <?= CHtml::hiddenField(
            Yii::app()->getRequest()->csrfTokenName,
            Yii::app()->getRequest()->csrfToken
        ); ?>
        <div>
            <div class="product-item__image product-item-image">

                <a href="<?= ProductHelper::getUrl($data); ?>" class="product-item-image__img js-product-image">
                    <picture>
                        <?php $img = StoreImage::product($data, 345, 456, true); ?>
                        <source srcset="<?= $data->getImageUrlWebp(345, 456, true, null, null, null, $img) ?>">
                        <img src="<?= $img ?>" alt="<?= CHtml::encode($data->getImageAlt()); ?>" title="<?= CHtml::encode($data->getImageTitle()); ?>" width="345" height="456">
                    </picture>
                </a>

                <div class="js-product-item-image">
                    <a href="<?= ProductHelper::getUrl($data); ?>" class="product-item-image__img-slide">
                        <picture>
                            <source srcset="<?= $data->getImageUrlWebp(345, 456, true, null, null, null, $img) ?>">
                            <img src="<?= $img ?>" alt="<?= CHtml::encode($data->getImageAlt()); ?>" title="<?= CHtml::encode($data->getImageTitle()); ?>" width="345" height="456">
                        </picture>
                    </a>
                    <?php if (count($data->getImages()) > 0) : ?>
                        <?php foreach ($data->getImages() as $key => $image) : { ?>
                                <a href="<?= ProductHelper::getUrl($data); ?>" class="product-item-image__img-slide">
                                    <picture>
                                        <source srcset="<?= $image->getImageUrlWebp(345, 456); ?>">
                                        <img src="<?= $image->getImageUrl(345, 456); ?>" alt="">
                                    </picture>
                                </a>
                                <?php if ($key > 5) break; ?>
                        <?php }
                        endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php if (Yii::app()->hasModule('favorite')) : ?>
                    <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                        'product' => $data,
                        'view' => "favorite-item"
                    ]); ?>
                <?php endif; ?>

                <div class="markers">
                    <?php if ($data->is_delivery) : ?>
                        <div class="badge badge-yellow">Бесплатная доставка</div>
                    <?php endif; ?>
                </div>

            </div>

            <a href="<?= ProductHelper::getUrl($data); ?>" class="product-item__name"><?= $data->getName() ?></a>
        </div>

        <div>
            <div class="product-item__price product-item-price">
                <div class="product-item-price__total">
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
            </div>

            <div class="product-item__buts">
                <?php if (Yii::app()->hasModule('cart')) : ?>
                    <button class="btn btn-yellow but-add-cart btn-svg   " id="add-product-to-cart">
                        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/cart-product.svg'); ?>
                        В корзину
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>