<?php

/* @var $product Product */

$this->viewRender = 'product-view';
$this->title = $product->getMetaTitle();
$this->description = $product->getMetaDescription();
$this->keywords = $product->getMetaKeywords();
$this->canonical = $product->getMetaCanonical();

$mainAssets = Yii::app()->getModule('store')->getAssetsUrl();
// Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/jquery.simpleGal.js');
Yii::app()->getClientScript()->registerScriptFile('https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js');
Yii::app()->getClientScript()->registerScriptFile('https://yastatic.net/share2/share.js');

$this->breadcrumbs = array_merge(
    [Yii::t("StoreModule.store", 'Catalog') => ['/store/product/index']],
    $product->category ? $product->category->getBreadcrumbs(true) : [],
    [strip_tags($product->getTitle())]
);
?>

<div class="product-view">
    <div class="container">

        <div class="breadcrumbs__wrapper">
            <?php $this->widget('application.components.MyTbBreadcrumbs', [
                'links' => $this->breadcrumbs,
            ]); ?>
        </div>

        <div class="product-view__main">
            <div class="product-view__content">
                <div class="product-view__image">
                    <?= $this->renderPartial('include/_thumbnails', [
                        'product' => $product
                    ]); ?>
                </div>

                <div class="product-info">
                    <h1 class="product-view__name" itemprop="name">
                        <?= $product->getTitle(); ?>
                    </h1>

                    <div class="product-stock">
                        <?php if ($product->in_stock) : ?>
                            <p class="in-stock">
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/yes.svg'); ?>
                                Есть в наличии
                            </p>
                        <?php else : ?>
                            <p class="not-stock">
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/no.svg'); ?>
                                Нет в наличии
                            </p>
                        <?php endif; ?>
                        <p class="sku">Артикул: <span><?= $product->sku ?></span></p>
                    </div>

                    <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post">
                        <input type="hidden" name="Product[id]" value="<?= $product->id; ?>" />
                        <?= CHtml::hiddenField(
                            Yii::app()->getRequest()->csrfTokenName,
                            Yii::app()->getRequest()->csrfToken
                        ); ?>
                        <input type="hidden" id="base-price" value="<?= str_replace('.00', '', number_format($product->getResultPrice(), 0, '.', '')); ?>" />
                        <?= $this->renderPartial('include/_attribute-color', [
                            'product' => $product
                        ]); ?>

                        <?= $this->renderPartial('include/_attribute-variant', [
                            'product' => $product
                        ]); ?>

                        <div class="product-info__variants-hidden-filds">
                            <?php foreach ($product->getVariantsGroup() as $title => $variantsGroup) : ?>
                                <?php $count = 0 ?>
                                <?php foreach ($product->getOptionsListForImagesRelation($variantsGroup) as $key => $value) : ?>
                                    <?php $count++; ?>
                                    <input type="radio" value="<?= $value['variant_id'] ?>" data-atribute-id="<?= $value['attribute_value'] ?>" name="ProductVariant[]-1-<?= $product->id ?>" <?= $count == 1 ? 'checked' : ''; ?>>
                                <?php endforeach ?>
                            <?php endforeach; ?>
                        </div>

                        <div class="product-price">
                            <div class="product-price__total">
                                <div class="product-price__actual">
                                    <span class="value"><?= str_replace('.00', '', number_format($product->getResultPrice(), 0, '.', ' ')); ?></span>
                                    <span class="current">₽</span>
                                </div>
                            </div>
                            <!-- <div class="product-price__old">
                                <span class="value"><?/*= str_replace('.00', '', number_format($product->getBasePrice(), 0, '.', ' ')); */ ?></span>
                                <span class="current">руб.</span>
                            </div> -->
                        </div>
                        <?php if (Yii::app()->hasModule('order')) : ?>
                            <button class="btn btn-white no-r" id="add-product-to-cart" data-loading-text="<?= Yii::t("StoreModule.store", "Adding"); ?>">
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/basket-black.svg'); ?>
                                <?= Yii::t("StoreModule.store", "В корзину"); ?>
                            </button>
                        <?php endif; ?>
                        <div class="cart-info-box__spinput">
                            <span data-min-value='1' data-max-value='99' class="spinput js-spinput">
                                <span class="spinput__minus js-spinput__minus cart-quantity-decrease" data-target="#cart_<?= $positionId; ?>"></span>
                                <?= CHtml::textField(
                                    'Product[quantity]',
                                    1,
                                    ['id' => 'cart_' . $positionId, 'class' => 'spinput__value position-count']
                                ); ?>
                                <span class="spinput__plus js-spinput__plus cart-quantity-increase" data-target="#cart_<?= $positionId; ?>"></span>
                            </span>
                        </div>

                        <div class="product-side__label"></div>
                    </form>
                    <div class="product-info__label">Характеристики товара</div>
                    <?php $attributes = $product->getAttributeGroups(); ?>
                    <?php if ($attributes) : ?>
                        <?php foreach ($attributes as $groupName => $items) : { ?>
                                <?php foreach ($items as $attribute) : {
                                        $value = $product->attribute($attribute);
                                        if (empty($value)) continue;
                                ?>
                                        <div class="product-size">
                                            <span class="product-size__label">
                                                <span><?= CHtml::encode($attribute->title); ?>:</span>
                                            </span>
                                            <span class="product-size__val"><?= AttributeRender::renderValue($attribute, $product->attribute($attribute)); ?></span>
                                        </div>
                                <?php }
                                endforeach; ?>
                        <?php }
                        endforeach; ?>
                    <?php endif; ?>

                    <div class="product-info__label">Описание товара</div>
                    <div class="product-info__desc">
                        <!-- <?= mb_strimwidth($product->description, 0, 350, '...') ?> -->
                        <?= $product->description ?>
                    </div>

                    <a class="product-info__link">Развернуть</a>
                </div>
            </div>
            <div class="product-users_photos js-users-photos">
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/1.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/1.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/2.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/2.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/1.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/1.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/2.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/2.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/1.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/1.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/2.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/2.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" alt="">
                    </a>
                </div>
                <div class="product-users_photos__item">
                    <a href="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" data-fancybox="users-photos">
                        <img src="<?= $this->mainAssets . '/images/users-photos/3.png' ?>" alt="">
                    </a>
                </div>
            </div>

            <?php
            // echo ('<pre>');
            // print_r($product->getTitle());
            // exit;
            ?>

            <div class="product-tabs-new">
                <div class="tabs-header">
                    <div class="tab-review show" data-tab="reviews">
                        <?php if ($product->getTitle() == 'Денежный талисман "Деньговорот"') : ?>
                            Отзывы (2)
                        <?php else : ?>
                            Отзывы (0)
                        <?php endif; ?>
                    </div>
                    <div class="tab-review" data-tab="quests">
                        Ответы на вопросы (0)
                    </div>
                </div>
                <div class="tabs-body">
                    <?php if ($product->getTitle() == 'Денежный талисман "Деньговорот"') : ?>
                        <div class="body-item item-reviews show">
                            <div class="review-stars">
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-yellow.svg'); ?>
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-yellow.svg'); ?>
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-yellow.svg'); ?>
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-gray.svg'); ?>
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-gray.svg'); ?>
                            </div>
                            <div class="review-text-page">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni sequi sint ab doloribus labore nihil?
                            </div>
                            <div class="review-user">
                                - test, 01.11.2022
                            </div>
                        </div>
                        <div class="body-item item-reviews show">
                            <div class="review-stars">
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-yellow.svg'); ?>
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-yellow.svg'); ?>
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-yellow.svg'); ?>
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-yellow.svg'); ?>
                                <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/reviews/star-gray.svg'); ?>
                            </div>
                            <div class="review-text-page">
                                Тестовый отзыв
                            </div>
                            <div class="review-user">
                                - TEST, 03.11.2022
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="body-item item-reviews show">
                            <div class="review-text-page">
                                Отзывов нет
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="body-item item-quests">
                        <p>Вопросов нет</p>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>