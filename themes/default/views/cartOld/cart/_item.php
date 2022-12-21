<?php $product = (get_class($position)==='OrderProduct') ? $position->product : $position->getProductModel(); ?>
<?php $positionId = (get_class($position)==='OrderProduct') ? $product->id : $position->getId(); ?>
<?php $productUrl = ProductHelper::getUrl($product); ?>
<?php $quantity = (get_class($position)==='OrderProduct') ? $position->quantity : $position->getQuantity(); ?>
<?php $price = (get_class($position)==='OrderProduct') ? $position->product->getPrice() : $position->getPrice(); ?>
<?php $basePrice = (get_class($position)==='OrderProduct') ? $position->product->getBasePrice() : $position->getBasePrice(); ?>
<?php $benefitPrice = (get_class($position)==='OrderProduct') ? $position->product->getBenefitPrice() : $position->getBenefitPrice(); ?>

<div class="cart-list__item cart-item fl fl-al-it-c fl-ju-co-sp-b js-cart-item"
    data-base-price="<?= $basePrice; ?>"
    data-price="<?= $price; ?>"
    data-discount-price="<?= $benefitPrice; ?>"
    >

    <?= CHtml::hiddenField('OrderProduct['.$positionId.'][product_id]', $position->id); ?>
    <input type="hidden" class="position-id" value="<?= $positionId; ?>"/>
    <span class="position-sum-price hidden">0</span>
    <span class="position-full-sum-price hidden">0</span>
    <span class="position-discount-sum-price hidden">0</span>

    <div class="cart-item__col cart-item__media fl fl-al-it-c fl-ju-co-c">
        <img src="<?= $product->getImageUrl(92, 82, false); ?>" class="cart-item__img"/>
    </div>
    <div class="cart-item__col cart-item__content cart-item-content fl fl-al-it-c fl-ju-co-sp-b" data-text='Товар'>
        <div class="cart-item-content__item cart-item-content__info">
            <div class="cart-item-content__attr fl fl-wr-w fl-ju-co-sp-b">
                <?php if ($product->sku) : ?>

                <?php endif ?>
            </div>

            <a href="<?= $productUrl; ?>" class="cart-item-content__link">
                <div class="cart-item-content__title cart-item-title">
                    <?= CHtml::encode($product->name); ?>
                </div>
            </a>

            <?php if (isset($position->selectedVariants)) : ?>
                <div class="cart-item-content__variants">
                    <?php foreach ($position->selectedVariants as $variant) : ?>
                        <div class="cart-item-content__variants-item">
                            <span class="cart-item-content__variants-name"><?= $variant->attribute->title; ?>: </span>
                            <span class="cart-item-content__variants-value"><?= $variant->getOptionValue(); ?></span>
                        </div>
                        <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][variant_ids][]', $variant->id); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>

            <?php if ($isButton) : ?>
                <a class="cart-item-content__link_delete js-cart__delete cart-delete-product" data-position-id="<?= $positionId; ?>" href="#">Удалить</a>
            <?php endif; ?>
        </div>
        <div class="cart-item-content__item cart-item-content__quantity" data-text='Кол-во'>
            <?php if ($isButton) : ?>
                <div class="cart-item-content__spinput">
                    <span data-min-value='1' data-max-value='99' class="spinput js-spinput">
                        <span
                            class="spinput__minus js-spinput__minus cart-quantity-decrease"
                            data-target="#cart_<?= $positionId; ?>"
                            data-target-text="#js-quantity-position_<?= $positionId; ?>"
                            ></span>
                        <?= CHtml::textField(
                            'OrderProduct['.$positionId.'][quantity]',
                            $quantity,
                            ['id' => 'cart_'.$positionId, 'class' => 'spinput__value position-count']
                        ); ?>
                        <span
                            class="spinput__plus js-spinput__plus cart-quantity-increase"
                            data-target="#cart_<?= $positionId; ?>"
                            data-target-text="#js-quantity-position_<?= $positionId; ?>"
                            ></span>
                    </span>
                </div>
            <?php else : ?>
                <div class="cart-item-data">
                    <span><?= $quantity; ?> шт.</span>
                    <?= CHtml::hiddenField('OrderProduct['.$positionId.'][quantity]', $quantity, ['id' => 'cart_'.$positionId, 'class' => 'spinput__value position-count']); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="cart-item-content__item cart-item-content__amount cart-item-amount" data-text='Сумма'>
            <div class="cart-item-amount__final">
                <span class="js-cartPrice-with-discount"></span>
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
            </div>
            <?php if ($product->hasDiscount()) : ?>
                <div class="cart-item-amount__without-discount">
                    <span class="cart-item-amount__old js-cartPrice-without-discount">0</span>
                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
                </div>
                <div class="cart-item-amount__benefit">
                    Выгода <span class="js-cartPrice-benefit">0</span> руб (<span class=""><?= str_replace('.00', '', number_format($product->discount, 2, '.', ' ')); ?></span>%)
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>