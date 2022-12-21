<?php
/* @var $this CartController */
/* @var $positions Product[] */
/* @var $order Order */
/* @var $coupons Coupon[] */

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

$this->title = Yii::t('CartModule.cart', 'Cart');
$this->breadcrumbs = [
    Yii::t("CartModule.cart", 'Catalog') => ['/store/product/index'],
    Yii::t("CartModule.cart", 'Cart')
];
?>

<div class="cart-order">
    <div class="container">
        <h1>Корзина</h1>
        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            [
                'action' => ['/order/order/create'],
                'id' => 'order-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => [
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'validateOnType' => false,
                    'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                    'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false); return !hasError;}',
                ],
                'htmlOptions' => [
                    'hideErrorMessage' => false,
                    'class' => 'order-form',
                ]
            ]
        ); ?>
        <div class="cart_wrapper">
            <?php if (Yii::app()->cart->isEmpty()) : ?>
                <?= Yii::t("CartModule.cart", "There are no products in cart"); ?>
            <?php else : ?>
                <div class="cart-order__main">
                    <?php foreach ($positions as $position) :
                        $productModel = $position->getProductModel();
                        if (is_null($productModel)) continue; ?>
                        <div class=" cart-info__lists cart-info__row">
                            <?php $productUrl = ProductHelper::getUrl($position); ?>
                            <?php $positionId = $position->getId(); ?>
                            <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][product_id]', $position->id); ?>
                            <input type="hidden" class="position-id" value="<?= $positionId; ?>" />
                            <div class="cart-info__list cart-info-box">
                                <div class="cart-info-box__img">
                                    <img class="cart__media-object" src="<?= StoreImage::product($productModel, 100, 100); ?>">
                                </div>
                                <div class="cart-info-box__name-cat">
                                    <a href="<?= $productUrl ?>" class="cart-list__info-name">
                                        <?= $position->name; ?>
                                    </a>
                                </div>                                
                                <div class="cart-info-box__price" style="display: none;">
                                    <span class="position-price">
                                        <?= $position->getPrice(); ?> &#x20bd;</span>
                                    </span>
                                </div>
                                <div class="cart-info-box__spinput">
                                    <span data-min-value='1' data-max-value='99' class="spinput-new js-spinput">
                                        <span class="spinput__minus js-spinput__minus cart-quantity-decrease" data-target="#cart_<?= $positionId; ?>"></span>
                                        <?= CHtml::textField(
                                            'OrderProduct[' . $positionId . '][quantity]',
                                            $position->getQuantity(),
                                            ['id' => 'cart_' . $positionId, 'class' => 'spinput__value position-count']
                                        ); ?>
                                        <span class="spinput__plus js-spinput__plus cart-quantity-increase" data-target="#cart_<?= $positionId; ?>"></span>
                                    </span>
                                </div>
                                 <div class="cart-info-box__price">
                                    <span class="position-sum-price">
                                        <span class="js-position-sum-price"><?= $position->getSumPrice(); ?></span> &#x20bd;
                                    </span>
                                </div>
                                <div class="cart-info-box__deleted">
                                    <button type="button" class="cart-list__delete-btn cart-delete-product" data-position-id="<?= $positionId; ?>">
                                        <span class="cart-list__delete-icon">
                                            <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/deleted.svg'); ?>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="cart-order__sidebar cart-sidebar">
                    <div class="cart-sidebar__name">Ваш заказ</div>
                    <?php
                    $counts = 0;
                    foreach ($positions as $position) :
                        $productModel = $position->getProductModel();
                        if (is_null($productModel)) continue;
                        $counts++; ?>
                        <div class="cart-sidebar__info cart-sidebar-info <?= $counts > 3 ? 'hidden' : '' ?>">
                            <?php $positionId = $position->getId(); ?>
                            <?php $positionCategory = $productModel->category; ?>
                            <?php $productUrl = ProductHelper::getUrl($position); ?>
                            <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][product_id]', $position->id); ?>
                            <input type="hidden" class="position-id" value="<?= $positionId; ?>" />
                            <div class="cart-sidebar-info__col cart-sidebar-info__name">
                                <span><?= $position->name; ?></span>
                            </div>
                            <div class="cart-sidebar-info__col cart-sidebar-info__price">
                                <span>
                                    <span id="cart_" class="position-count">1 шт.</span>
                                    <input id="cart_<?= $positionId ?>" class="form-control text-center position-count" type="hidden" value="<?= $position->getQuantity() ?>" name="OrderProduct[<?= $positionId ?>][quantity]">
                                </span>
                                <span><?= $position->getPrice(); ?> &#x20bd;</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <a href="#" class="cart-sidebar__more js-cart-sidebar-more <?= $counts < 4 ? 'hidden' : '' ?>">
                        <span data-text="Скрыть">Показать весь заказ</span>
                    </a>
                </div>
        </div>
        <div class="cart-order__info">
            <div class="gift__wrapper">
                <div class="gift">
                    <input type="checkbox" name="" id="gift" class="tab-radio-input input-check" value="" data-price="">
                    <label class="tab-radio js-add-gift-items js-tab-radio gift-label" for="gift" data-tab="">Покупаю этот товар в подарок <span>+500 ₽</span></label>
                </div>
                <span class="gift-subinfo">
                    Подарочное оформление и отправка получателю подарка
                </span>
                <div class="gift-items js-gift-slider">
                    <div class="gift-item">
                        <img src="<?= $this->mainAssets . '/images/gift.png' ?>" alt="">
                        <p>
                            Синяя
                            подарочная упаковка
                        </p>
                    </div>
                    <div class="gift-item">
                        <img src="<?= $this->mainAssets . '/images/gift.png' ?>" alt="">
                        <p>
                            Синяя
                            подарочная упаковка
                        </p>
                    </div>
                    <div class="gift-item">
                        <img src="<?= $this->mainAssets . '/images/gift.png' ?>" alt="">
                        <p>
                            Синяя
                            подарочная упаковка
                        </p>
                    </div>
                    <div class="gift-item">
                        <img src="<?= $this->mainAssets . '/images/gift.png' ?>" alt="">
                        <p>
                            Синяя
                            подарочная упаковка
                        </p>
                    </div>
                    <div class="gift-item">
                        <img src="<?= $this->mainAssets . '/images/gift.png' ?>" alt="">
                        <p>
                            Синяя
                            подарочная упаковка
                        </p>
                    </div>
                </div>
                <!-- <div class="gift-message">
                    <input type="checkbox" name="" id="gift-message" class="tab-radio-input input-check" value="" data-price="">
                    <label class="tab-radio js-add-gift-message" for="gift-message" data-tab="">Добавить сообщение и пожелание для получателя подарка</label>
                </div> -->
                <div class="gift-message-text">
                    <?= $form->textArea($order, 'gift_message', [
                        'class' => 'form-control',
                        'placeholder' => 'Введите сообщение для получателя и не забудьте указать имена получателя и отправителя',
                    ]); ?>
                    <?= $form->error($order, 'gift_message'); ?>
                </div>
            </div>
            <div class="types-delivery cart-group">
                <label class="cart-form__label">Способ доставки</label>
                <div class="delivery-list">
                    <?php foreach ($deliveryTypes as $key => $delivery) : ?>
                        <div class="delivery-item">
                            <input type="radio" name="Order[delivery_id]" id="delivery-<?= $delivery->id; ?>" class="tab-radio-input input-check" value="<?= $delivery->id; ?>" data-price="<?= $delivery->price; ?>" data-free-from="<?= $delivery->free_from; ?>" data-available-from="<?= $delivery->available_from; ?>" data-separate-payment="<?= $delivery->separate_payment; ?>" <?= $active_delivery === $delivery->id ? 'checked' : '' ?>>
                            <label class="tab-radio js-tab-radio <?= $active_delivery === $delivery->id ? 'active' : '' ?>" for="delivery-<?= $delivery->id; ?>" data-tab="#delivery-content-<?= $delivery->id; ?>"><?= $delivery->name; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="cart-order__form cart-form cart-group">
                <label class="cart-form__label">Контактные данные</label>
                <div class="cart-form__row">
                    <?= $form->textFieldGroup($order, 'name', [
                        'class' => 'form-control',
                    ]); ?>
                    <?= $form->error($order, 'name'); ?>
                </div>

                <!-- <div class="cart-form__row">
                    <div class="cart-form__group">
                        <div class="cart-form__item">
                            <?= $form->textFieldGroup($order, 'city', [
                                'class' => 'form-control',
                            ]); ?>
                            <?= $form->error($order, 'city'); ?>
                        </div>
                        <div class="cart-form__item">
                            <?= $form->textFieldGroup($order, 'zipcode', [
                                'class' => 'form-control',
                            ]); ?>
                            <?= $form->error($order, 'zipcode'); ?>
                        </div>
                    </div>
                </div> -->

                <div class="cart-form__row">
                    <div class="form-group">
                        <?= $form->textFieldGroup($order, 'country', [
                            'class' => 'form-control',
                            'id' => 'address',
                        ]); ?>
                        <?= $form->error($order, 'country'); ?>
                    </div>
                </div>

                <div class="cart-form__row">
                    <div class="cart-form__group">
                        <div class="cart-form__item flag-phone">
                            <?= $form->labelEx($order, 'phone', ['class' => 'control-label']) ?>
                            <?php $this->widget('CMaskedTextFieldPhone', [
                                'model' => $order,
                                'attribute' => 'phone',
                                'mask' => '+7(999)999-99-99',
                                'htmlOptions' => [
                                    'class' => 'data-mask form-control',
                                    'data-mask' => 'phone',
                                    'autocomplete' => 'off',
                                    'placeholder' => '+7'
                                ]
                            ]) ?>
                            <?php echo $form->error($order, 'phone'); ?>
                        </div>
                        <div class="cart-form__item">
                            <?= $form->textFieldGroup($order, 'email', [
                                'class' => 'form-control',
                            ]); ?>
                            <?= $form->error($order, 'email'); ?>
                        </div>
                    </div>
                </div>

                <div class="cart-form__delivery hidden">
                    <?php if (!empty($deliveryTypes)) : ?>
                        <div class="cart-form__group">
                            <label class="cart-form__label"><?= Yii::t("CartModule.cart", "Информация о доставке"); ?></label>
                            <div class="cart-form__delivery-controls">
                                <?php foreach ($deliveryTypes as $key => $delivery) : ?>
                                    <div class="cart-form__delivery-control">
                                        <input type="radio" name="Order[delivery_id]" id="delivery-<?= $delivery->id; ?>" value="<?= $delivery->id; ?>" data-price="<?= $delivery->price; ?>" data-free-from="<?= $delivery->free_from; ?>" data-available-from="<?= $delivery->available_from; ?>" data-separate-payment="<?= $delivery->separate_payment; ?>">
                                        <label for="delivery-<?= $delivery->id; ?>">
                                            <span class="cart-form_delivery__icon"></span>
                                            <span class="cart-form_delivery-name"><?= $delivery->name; ?></span>
                                        </label>
                                        <!-- <div class="cart-form_delivery-name"><?= $delivery->name; ?></div> -->
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (true) : ?>
                    <div class="cart-form__row">
                        <div class="cart-form__group">
                            <?= $form->textFieldGroup($order, 'comment', [
                                'class' => 'form-control',
                            ]); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="cart-group">
                <label class="cart-form__label">Способ оплаты</label>
                <div class="payment-info">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/attention.svg'); ?>
                    <p>Все онлайн-оплаты на сайте производятся через <span>Ю-Кассу</span></p>
                </div>
            </div>

            <div class="cart-form__row cart-form__coupon cart-group">
                <div class="cart-form__coupon">
                    <?php if (Yii::app()->hasModule('coupon')) : ?>
                        <label class="cart-form__label"><?= Yii::t("CartModule.cart", "Есть промокод?"); ?></label><br>
                        <div class="coupons__group">
                            <div class="coupons__input">
                                <input id="coupon-code" type="text" class="form-control" placeholder="Промокод">
                            </div>
                            <button class="coupons__button btn btn-white no-r" type="button" id="add-coupon-code"><?= Yii::t("CartModule.cart", "Применить"); ?></button>
                        </div>
                        <div class="coupons">
                            <div class="coupons-list">
                                <?php foreach ($coupons as $coupon) : ?>
                                    <div class="coupons-list__item">
                                        <span class="label alert alert-success coupon" title="<?= $coupon->name; ?>">
                                            <span class="coupon__code"><?= $coupon->code; ?></span>
                                            <button type="button" class="coupon__close close" data-dismiss="alert"><i class="icon-close"></i></button>
                                            <?= CHtml::hiddenField(
                                                "Order[couponCodes][{$coupon->code}]",
                                                $coupon->code,
                                                [
                                                    'class' => 'coupon-input',
                                                    'data-code' => $coupon->code,
                                                    'data-name' => $coupon->name,
                                                    'data-value' => $coupon->value,
                                                    'data-type' => $coupon->type,
                                                    'data-min-order-price' => $coupon->min_order_price,
                                                    'data-free-shipping' => $coupon->free_shipping,
                                                ]
                                            ); ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="cart-total-info">
                <label class="cart-form__label">Стоимость заказа</label>
            </div>
            <div class="cart-form__total">
                <div class="total-item">
                    <span><?= Yii::t("CartModule.cart", "Стоимость товаров:"); ?></span>
                    <span class="sp-b">
                        <span id="cart-full-cost-with-shipping">0</span>
                        <?= Yii::t("CartModule.cart", '₽'); ?>
                    </span>
                </div>
                <div class="total-item">
                    <span><?= Yii::t("CartModule.cart", "Стоимость доставки:"); ?></span>
                    <span class="sp-b">
                        бесплатно
                    </span>
                </div>
            </div>
            <div class="cart-form__order-button">
                <button type="submit" class="btn btn-white btn-white-l no-r">
                    <?= Yii::t("CartModule.cart", "Подтвердить заказ"); ?>
                </button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    <?php endif; ?>
    </div>
</div>