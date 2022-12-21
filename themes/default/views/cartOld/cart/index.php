<?php
/* @var $this CartController */
/* @var $positions Product[] */
/* @var $order Order */
/* @var $coupons Coupon[] */

/*Настройки*/
$mainAssets       = Yii::app()->getTheme()->getAssetsUrl();
$orderModule      = Yii::app()->getModule('order');
$minAmount        = $orderModule->minAmount;
$minAmountMessage = $orderModule->getMinAmountMessage();
$cartCost         = Yii::app()->cart->getCost();
$checkMinAmount   = $minAmount > $cartCost;

/*Регистрация скриптов*/
$assets = Yii::app()->getAssetManager()->publish(
    Yii::getPathOfAlias('order.views.assets'),
    true,
    -1,
    YII_DEBUG
);
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerScriptFile($assets.'/js/cart.js', CClientScript::POS_END);

$this->title = Yii::t('CartModule.cart', 'Cart');
$this->breadcrumbs = [
    Yii::t("CartModule.cart", 'Cart')
];
?>

<script type="text/javascript">
    var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
    var yupeCartUpdateUrl        = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
    var yupeCartWidgetUrl        = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    var yupeCartEmptyMessage     = '<h1><?= Yii::t("CartModule.cart", "Cart is empty"); ?></h1><?= Yii::t("CartModule.cart", "There are no products in cart"); ?>';
    var minAmount                = <?= CJavaScript::encode($minAmount) ?>;
</script>

<div class="page-content cart-page-content">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1><?= Yii::t("CartModule.cart", "Cart"); ?></h1>
        <?php if (Yii::app()->cart->isEmpty()) : ?>
            <div class="empty-cart">
                <?= Yii::t("CartModule.cart", "There are no products in cart"); ?>
            </div>
        <?php else : ?>
            <div class="empty-cart">
                <?= Yii::t("CartModule.cart", "There are no products in cart"); ?>
            </div>
            <div class="cart-section fl fl-wr-w fl-ju-co-sp-b">
                <div class="cart-section__content">
                    <div class="alert alert-danger hide js-check-min-amount"><?= $minAmountMessage ?></div>

                    <?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                        [
                            'action' => ['/order/order/create'],
                            'id' => 'order-form',
                            'htmlOptions' => [
                                'hideErrorMessage' => false,
                                'class' => 'order-form',
                            ]
                        ]
                    );
                    ?>

                    <?php if (Yii::app()->hasModule('coupon')) : ?>
                        <div class="cart-coupon">
                            <div class="cart-coupon__header">
                                <h4><?= Yii::t("CartModule.cart", "Добавить промокод"); ?></h4>
                            </div>
                            <div class="cart-coupon__body fl fl-al-it-c">
                                <div class="cart-coupon__box coupon-box fl fl-al-it-c">
                                    <div class="cart-coupon__input-group">
                                        <input id="coupon-code" class="input coupon-box__input form-control" placeholder="Введите промо-код">
                                    </div>
                                    <button class="btn btn-green coupon-box__button coupon-box__button_apply" type="button" id="add-coupon-code"><?= Yii::t("CartModule.cart", "Применить"); ?></button>
                                    <button class="bt-cart bt-cart-animate-3d coupon-box__button coupon-box__button_cancel hidden" type="button"><?= Yii::t("CartModule.cart", "Отменить"); ?></button>
                                </div>
                                <?php foreach ($coupons as $coupon) : ?>
                                    <div class="cart-coupon__desc">
                                        <button type="button" class="btn btn-green close" data-dismiss="alert">&times;</button>
                                        <span><?= $coupon->name ?> скидка <?= round($coupon->value) ?> руб.</span>
                                    </div>
                                    <?= CHtml::hiddenField(
                                        "Order[couponCodes][{$coupon->code}]",
                                        $coupon->code,
                                        [
                                            'class'                => 'coupon-input',
                                            'data-code'            => $coupon->code,
                                            'data-name'            => $coupon->name,
                                            'data-value'           => $coupon->value,
                                            'data-type'            => $coupon->type,
                                            'data-min-order-price' => $coupon->min_order_price,
                                            'data-free-shipping'   => $coupon->free_shipping,
                                        ]
                                    ); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="cart-list js-cart">
                        <?php foreach ($positions as $position) : ?>
                            <?php Yii::app()->controller->renderPartial('_item', [
                                'isButton' => true,
                                'position' => $position
                            ]); ?>
                        <?php endforeach; ?>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
                <div class="cart-section__result">
                    <?php $this->widget('application.modules.cart.widgets.PriceOverview', [
                        'isButton' => true,
                    ]) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="crtAuthorization-modal modal fade" tabindex="-1" role="dialog" id="modal-login-registration">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header fl fl-ju-co-c">
                <?= CHtml::image($this->mainAssets . '/images/logo.svg', '', [
                    'class' => 'crtAuthorization-logo'
                ]); ?>
                <div data-dismiss="modal" class="modal-close"><div></div></div>
            </div>
            <div class="modal-body">
                <ul class="crtAuthorization-navs fl fl-al-it-c fl-ju-co-c" role="tablist">
                    <li class="crtAuthorization-navs__item active" role="presentation">
                        <a class="crtAuthorization-navs__link fl fl-al-it-c fl-ju-co-c" href="#modal-login" aria-controls="modal-login" role="tab" data-toggle="tab">Вход</a>
                    </li>
                    <li class="crtAuthorization-navs__item" role="presentation">
                        <a class="crtAuthorization-navs__link fl fl-al-it-c fl-ju-co-c" href="#modal-registration" aria-controls="modal-registration" role="tab" data-toggle="tab">Регистрация</a>
                    </li>
                </ul>

                <div class="tab-content crtAuthorization-form">
                    <div role="tabpanel" class="tab-pane active" id="modal-login">
                        <?php $this->widget('application.modules.cart.widgets.AjaxLoginWidget', [
                            'redirect' => Yii::app()->createUrl('/cart/cart/order')
                        ]) ?>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="modal-registration">
                        <?php $this->widget('application.modules.cart.widgets.AjaxRegistrationWidget', [
                            'redirect' => Yii::app()->createUrl('/cart/cart/order')
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= CHtml::link('Продолжить без авторизации', ['/cart/cart/order'], [
                    'class' => 'link'
                ]) ?>
            </div>
        </div>
    </div>
</div>