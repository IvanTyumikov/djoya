<?php
/* @var $this CartController */
/* @var $positions Product[] */
/* @var $order Order */
/* @var $coupons Coupon[] */

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
$this->viewRender = 'product-view';

$this->title = Yii::t('CartModule.cart', 'Cart');
$this->breadcrumbs = [
    Yii::t("CartModule.cart", 'Catalog') => ['/store/product/index'],
    Yii::t("CartModule.cart", 'Cart')
];
?>

<div class="cart-index">
    <div class="container">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
        
        <div class="cart-index__label cart-label">
            <?php if (Yii::app()->cart->isEmpty()): ?>
                <div class="cart-label__txt">
                    <h1 class="cart-index__title">Корзина</h1>
                    <i class="icon-arrow-next-small"></i>
                    <span>Информация</span>
                </div>
            <?php else: ?>
                <div class="cart-label__txt">
                    <h1 class="cart-index__title">Корзина</h1>
                    <i class="icon-arrow-next-small"></i>
                    <span>Мой заказ</span>
                </div>
            <?php endif; ?>
            <a href="<?= Yii::app()->createUrl('store/product/index'); ?>" class="cart-label__prev">Вернуться к покупкам</a>
        </div>

        <div class="cart-index__main">
            <?php if (Yii::app()->cart->isEmpty()): ?>
                <div class="cart-index__empty"><?= Yii::t("CartModule.cart", "В корзине нет товаров"); ?></div>
            <?php else: ?>
            <div class="cart-index__info cart-info">
                <!--<div class="cart-order__warning">
                    Доставка осуществляется путем ежедневной отправки (за исключением выходных и праздничных дней) транспортными компаниями. Оплата возможна как наличным, так и безналичным способом оплаты с выставлением счета и договора на вашу организацию.
                </div>-->
                <?php foreach ($positions as $position):
                    $productModel = $position->getProductModel();
                    if (is_null($productModel)) continue; ?>
                    <div class=" cart-info__lists cart-info__row">
                        <?php $productUrl = ProductHelper::getUrl($position); ?>
                        <?php $positionId = $position->getId(); ?>
                        <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][product_id]', $position->id); ?>
                        <input type="hidden" class="position-id" value="<?= $positionId; ?>"/>
                        <div class="cart-info__list cart-info-box">
                            <div class="cart-info-box__img">
                                <img class="cart__media-object" src="<?= StoreImage::product($productModel, 100, 100); ?>">
                            </div>
                            <div class="cart-info-box__name-cat">
                                <a href="<?= $productUrl ?>" class="cart-list__info-name">
                                    <?= $position->name; ?>
                                </a>
                                <?php if (isset($productModel->category)): ?>
                                    <span class="cart-list__info-cat">Категория:
                                        <?= CHtml::link(
                                            CHtml::encode($productModel->category->name),
                                            ['/store/category/view', 'path' => $productModel->category->getPath()]
                                        ) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="cart-info-box__spinput">
                                <span data-min-value='1' data-max-value='99' class="spinput js-spinput">
                                    <span class="spinput__minus js-spinput__minus cart-quantity-decrease"
                                          data-target="#cart_<?= $positionId; ?>"></span>
                                    <?= CHtml::textField(
                                        'OrderProduct['.$positionId.'][quantity]',
                                        $position->getQuantity(),
                                        ['id' => 'cart_'.$positionId, 'class' => 'spinput__value position-count']
                                    ); ?>
                                    <span class="spinput__plus js-spinput__plus cart-quantity-increase"
                                          data-target="#cart_<?= $positionId; ?>"></span>
                                </span>
                            </div>
                            <div class="cart-info-box__price">
                                <span class="position-sum-price">
                                    <span class="js-position-sum-price"><?= $position->getSumPrice(); ?></span> &#x20bd;
                                </span><br>
                                <span class="cart-list__price-vel">
                                    <span id="cart_<?= $positionId; ?>" class="position-count2"><?= $position->getQuantity() ?></span> шт. x 
                                    <span class="position-price js-position-price"><?= $position->getPrice(); ?></span> = 
                                    <span class="position-sum-price2 js-position-sum-price"><?= $position->getSumPrice(); ?></span> &#x20bd;
                                </span>
                            </div>
                            <div class="cart-info-box__deleted">
                                <button type="button" class="cart-list__delete-btn cart-delete-product" data-position-id="<?= $positionId; ?>">
                                    <span class="cart-list__delete-icon">
                                        <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/deleted.svg'); ?>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="cart-index-sidebar cart-sidebar">
                 <div class="cart-sidebar__main">
                     <div class="cart-sidebar__label">Сумма заказа:</div>
                     <div class="cart-sidebar__price" ><span id="cart-full-cost"><?= Yii::app()->cart->getCost(); ?></span> руб.</div>
                     <strong id="cart-full-cost-with-shipping" class="hidden">0</strong>
                </div>
                <a href="<?= Yii::app()->createUrl('/cart/cart/order/'); ?>" class="cart-sidebar__btn btn btn-green js-cart-order" data-url="<?= Yii::app()->createUrl('/cart/cart/order/'); ?>">
                    <span>Продолжить оформление</span>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>