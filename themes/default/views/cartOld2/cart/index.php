        <?php
    $mainAssets = Yii::app()->getTheme()->getAssetsUrl();

    $cartInfo = $order->getProductsInfo();

    $this->title = Yii::t('CartModule.cart', 'Cart');
    $this->breadcrumbs = [
        Yii::t("CartModule.cart", 'Catalog') => ['/store/product/index'],
        Yii::t("CartModule.cart", 'Cart')
    ];

    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jcfilter.min.js');
?>

<script type="text/javascript">
    var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
    var yupeCartUpdateUrl = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
    var yupeCartWidgetUrl = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    var yupeCartEmptyMessage = '<h1 class="title-store"><?= Yii::t("CartModule.cart", "Cart is empty"); ?></h1><?= Yii::t("CartModule.cart", "There are no products in cart"); ?>';
</script>

<div class="cart cart-index">

</div>
<div class="container">
    <?php $this->widget('application.components.MyTbBreadcrumbs', [
        'links' => $this->breadcrumbs,
    ]); ?>

    <h1>Корзина</h1>

    <?php if (Yii::app()->cart->isEmpty()): ?>
        <?= Yii::t("CartModule.cart", "There are no products in cart"); ?>
    <?php else: ?>
        <?php
        $form = $this->beginWidget(
            'application.components.MyTbActiveForm',
            [
                'type' => 'vertical',
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
                    'class' => 'order-form cart__form cart-form',
                    'data-url-delivery-types' => Yii::app()->createUrl('/order/order/deliveryTypes'),
                ]
            ]
        ); ?>
        <div class="cart__main">
            <div class="cart-info">
                <div class="cart-positions">
                    <?php foreach ($positions as $position): ?>
                        <?php
                            $productModel = $position->getProductModel();
                            if (is_null($productModel)) continue;
                        ?>
                    <?php $positionId = $position->getId(); ?>
                    <?php $productUrl = ProductHelper::getUrl($position); ?>
                    
                    <div class="cart-position cart-position-<?= $positionId; ?>">
                            
                        <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][product_id]', $position->id); ?>
                        <input type="hidden" class="position-id" value="<?= $positionId; ?>"/>
            
                        <div class="cart-position__image">
                            <?= CHtml::link(CHtml::image(StoreImage::product($productModel, 100, 120)), ProductHelper::getUrl($position)); ?>
                        </div>
            
                        <div class="cart-position__info">
                            <a href="/" class="cart-position__name"><?= $position->name ?></a>
                            <button type="button"
                                    class="cart-position__deleted js-cart-position-deleted"
                                    data-position-id="<?= $positionId; ?>"
                                    data-product-id="<?= $position->id; ?>">
                                Удалить
                            </button>
                        </div>

                        <div class="cart-position__spinput spinput">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button class="btn btn-default cart-quantity-decrease" type="button" data-target="#cart_<?= $positionId; ?>">-</button>
                                </div>
                                <?= CHtml::textField('OrderProduct[' . $positionId . '][quantity]',$position->getQuantity(),['id' => 'cart_' . $positionId, 'class' => 'form-control text-center position-count']); ?>
                                <div class="input-group-btn">
                                    <button class="btn btn-default cart-quantity-increase" type="button" data-target="#cart_<?= $positionId; ?>">+</button>
                                </div>
                            </div>
                        </div>

                        <div class="cart-position-price">
                            <div class="cart-position-price__result">
                                <span class="value"><?= $position->getSumPrice(); ?></span>
                                <span class="current"></span>
                            </div>
                            <div class="cart-position-price__old">
                                <span class="value"></span>
                                <span class="current"></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="panel-shopcart-delivery">
                    <?php $this->renderPartial('application.modules.order.views.order._delivery-types', [
                        'deliveryTypes' => $deliveryTypes,
                        'order' => $order
                    ], false, false); ?>
                </div>

                <div class="panel-shopcart-delivery-data"></div>

                <h3>Выберите способ оплаты:</h3>
                <?php $payment = Payment::model()->findAll(); ?>
                <?php if ($payment) : ?>
                    <div class="payment-method">
                        <ul class="payment-method__lists" id="payment-methods">
                            <?php foreach ($payment as $payment) : ?>
                                <li class="payment-method__list">
                                    <input class="payment-method-radio"
                                           type="radio"
                                           name="Order[payment_method_id]"
                                           value="<?= $payment->id; ?>"
                                        <?= $payment->id == 2 ? 'checked=""' : '' ?>
                                           id="payment-<?= $payment->id; ?>"
                                           data-discount="<?= $payment->discount / 100; ?>">
                                    <label for="payment-<?= $payment->id; ?>">
                                        <?= CHtml::encode($payment->name); ?>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <h3>Заполните поля ниже:</h3>
                <div class="cart-form__order">
                    <?= $form->hiddenField($order, 'sdek_id'); ?>
                    <?= $form->textFieldGroup($order, 'family'); ?>
                    <?= $form->textFieldGroup($order, 'name'); ?>
                    <?= $form->textFieldGroup($order, 'email'); ?>
                    <div class="form-group">
                        <?= $form->labelEx($order, 'phone', ['class' => 'control-label']) ?>
                        <?php $this->widget('CMaskedTextFieldPhone', [
                            'model' => $order,
                            'attribute' => 'phone',
                            'mask' => '+7(999)999-99-99',
                            'htmlOptions'=>[
                                'class' => 'data-mask form-control',
                                'data-mask' => 'phone',
                                'placeholder' => 'Телефон',
                                'autocomplete' => 'off'
                            ]
                        ]) ?>
                        <?php echo $form->error($order, 'phone'); ?>
                    </div>

                    <?= $form->textFieldGroup($order, 'city',
                        [
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'placeholder' => 'Введите город или населенный пункт',
                                ]
                            ]
                        ]);
                    ?>
                </div>

                <div class="panel-order-form">
                    <?= $form->hiddenField($order, 'zipcode'); ?>
                    <?= $form->hiddenField($order, 'longitude'); ?>
                    <?= $form->hiddenField($order, 'latitude'); ?>
                    <?= $form->hiddenField($order, 'pvz_address'); ?>
                    <?= $form->hiddenField($order, 'tariff_id'); ?>



                    <div class="field-address hidden" id="field-address">
                        <h3>Заполните адрес доставки:</h3>
                        <?= $form->textFieldGroup($order, 'street'); ?>
                        <?= $form->textFieldGroup($order, 'house'); ?>
                        <?= $form->textFieldGroup($order, 'apartment'); ?>
                    </div>

                    <div class="total-cost-block">
                        <label>
                            Полная стоимость с доставкой: <span id="total-cost-delivery"></span> руб.
                        </label>
                    </div>
                    <br>


                </div>
            </div>

            <div class="cart-side">
                <div class="cart-total">
                    <div class="cart-total__label">Итого:</div>
                    <div class="cart-total__value">
                        <span class="js-cart-total-val">485 050</span>
                        <span class="current">₽</span>
                    </div>
                </div>

                <div class="cart-total-product">
                    <div class="cart-total-product__label">Товары (20)</div>
                    <div class="cart-total-product__value">
                        <span class="value">500 000</span>
                        <span class="current">₽</span>
                    </div>
                </div>

                <div class="cart-total-discount">
                    <div class="cart-total-discount__label">Скидка</div>
                    <div class="cart-total-discount__value">
                        <span class="value">-</span>
                        <span class="value">14950</span>
                        <span class="current">₽</span>
                    </div>
                </div>

                <div class="cart-total-delivery">
                    <div class="cart-total-delivery__label">Доставка</div>
                    <div class="cart-total-delivery__value js-cart-total-delivery">
                        Выберите способ доставки
                    </div>
                </div>

                <div class="cart-side__buts">
                    <button type="submit" class="btn btn-green">Оформить заказ</button>
                </div>

                <div class="cart-side__terms">
                    <p>
                        Согласен с условиями
                        <a href="/">Правил пользования торговой площадкой и правилами возврата</a>
                    </p>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    <?php endif; ?>
</div>