<div class="product__list product-list js-product-item">
    <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post" data-max-value='<?= (int)$data->quantity ?>'>
        <input type="hidden" name="Product[id]" value="<?= $data->id; ?>"/>
        <?= CHtml::hiddenField(
            Yii::app()->getRequest()->csrfTokenName,
            Yii::app()->getRequest()->csrfToken
        ); ?>
        <div class="product-list__wrap">
            <a href="<?= ProductHelper::getUrl($data); ?>" class="product-list__image product-list-image">
                <span class="product-list-image__img js-product-image"> 
                    <img src="<?= StoreImage::product($data, 234, 210, false); ?>"
                         alt="<?= CHtml::encode($data->getImageAlt()); ?>"
                         title="<?= CHtml::encode($data->getImageTitle()); ?>">
                </span>
                <span class="item-image-lists"> 
                    <span 
                        class="item-image-list__list js-image-lists"
                        data-src="<?= StoreImage::product($data, 234, 210, false); ?>"
                        data-key="0">
                    </span>
                    <?php if (count($data->getImages()) > 0): ?>
                        <?php foreach ($data->getImages() as $key => $image): { ?>
                            <span 
                                class="item-image-list__list js-image-lists"
                                data-src="<?= $image->getImageUrl(234,210); ?>"
                                data-key="<?= ($key + 1); ?>">   
                            </span>
                            <?php if($key > 5) break; ?>
                        <?php } endforeach; ?>
                    <?php endif; ?>
                </span>
                <div class="item-image-dots">
                    <?php if($data->getImages()) : ?>
                        <div 
                            class="item-image-dots__list js-item-image-dots active" 
                            data-key="0">
                        </div>
                        <?php foreach ($data->getImages() as $key => $image) : ?>
                            <div 
                                class="item-image-dots__list js-item-image-dots" 
                                data-key="<?= ($key + 1); ?>">
                            </div>
                            <?php if($key > 5) break; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </a>
            <div class="product-list__info product-list-info">
                <?php if($data->is_new): ?>
                    <div class="product-list-info__badge badge_new">Новинка</div>
                <?php endif; ?>
                <?php if($data->is_hit): ?>
                    <div class="product-list-info__badge badge_hit">Хит продаж</div>
                <?php endif; ?>
                <?php if($data->hasDiscount()): ?>
                    <div class="product-list-info__badge badge_discount">Со скидкой</div>
                <?php endif; ?><br>
                <a href="<?= ProductHelper::getUrl($data); ?>" class="product-list-info__name"><?= $data->getName() ?></a>
                <?php $attributes = $data->getAttributeGroups(); ?>
                <?php if($attributes) : ?>
                    <div class="product-list-info__attr product-list-attr" id="product-list-attr">
                        <?php foreach ($attributes as $groupName => $items): { ?>
                            <?php foreach ($items as $key => $attribute): {
                                $value = $data->attribute($attribute);
                                if (empty($value)) continue;
                            ?>
                                <div class="product-list-attr__list">
                                    <span class="product-list-attr__label"><?= strip_tags(CHtml::encode($attribute->title)); ?>:</span>
                                    <span class="product-list-attr__value"><?= AttributeRender::renderValue($attribute, $data->attribute($attribute), '<span>{item}</span>'); ?></span>
                                </div>
                                <?php if($key > 3) break; ?>
                            <?php } endforeach; ?>
                        <?php } endforeach; ?>
                        <span class="product-list-attr__all js-load-attribute" data-action-attribute="<?= Yii::app()->createUrl('/store/product/product', ['id' => $data->id]); ?>"><span>Все параметры</span></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="product-list__control">
                <?php if ($data->hasDiscount()) : ?>
                    <span class="product-list__discount">
                        <span class="value">-15%</span>
                    </span>
                <?php endif; ?>
                <div class="product-list__price product-list-price">
                    <div class="product-list-price__actual <?= $data->hasDiscount() ? 'product-list-price__actual_discount' : '' ?>">
                        <span class="value"><?= str_replace('.00', '', number_format($data->getResultPrice(), 0, '.', ' ')); ?></span>
                        <span class="current">₽</span>
                    </div>
                    <?php if ($data->hasDiscount()) : ?>
                        <div class="product-list-price__old">
                            <span class="value"><?= str_replace('.00', '', number_format($data->getBasePrice(), 2, '.', ' ')); ?></span>
                            <span class="current">₽</span>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if(Yii::app()->hasModule('favorite')):?>
                    <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                        'product' => $data,
                        'view' => "favorite-item"
                    ]);?>
                <?php endif;?>
                <?php if (Yii::app()->hasModule('cart')) : ?>
                    <a class="product-item__link product-list__link-more" href="<?= ProductHelper::getUrl($data); ?>">
                        <?php /*file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/product_cart.svg');*/ ?>
                        <span>Подробнее</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>
