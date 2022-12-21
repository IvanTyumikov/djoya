<?php
/* @var $this CartController */
/* @var $positions Product[] */
/* @var $order Order */
/* @var $coupons Coupon[] */

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');
Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/cart-frontend.css');

$this->title = Yii::t('CartModule.cart', 'Cart');
$this->breadcrumbs = [
    Yii::t("CartModule.cart", 'Catalog') => ['/store/product/index'],
    Yii::t("CartModule.cart", 'Cart')
];
?>

<script type="text/javascript">
    var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
    var yupeCartUpdateUrl = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
    var yupeCartWidgetUrl = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    var yupeCartEmptyMessage = '<h1><?= Yii::t("CartModule.cart", "Cart is empty"); ?></h1><?= Yii::t("CartModule.cart", "There are no products in cart"); ?>';
</script>

<div class="cart-order">
    <div class="container">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
        <div class="cart-order__label cart-index__label cart-label">
            <div class="cart-label__txt">
                <h1 class="cart-index__title">Корзина</h1>
                <i class="icon-arrow-next-small"></i>
                <span>Оформление заказа</span>
            </div>
            <a href="<?= Yii::app()->createUrl('/cart/cart/index/'); ?>" class="cart-label__prev">Назад в корзину</a>
        </div>
        <div class="cart-order__main">
            <?php if (Yii::app()->cart->isEmpty()): ?>
                <h1><?= Yii::t("CartModule.cart", "Cart is empty"); ?></h1>
                <?= Yii::t("CartModule.cart", "There are no products in cart"); ?>
            <?php else: ?>
        </div>
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
            <div class="cart-order__main">
                <div class="cart-order__form cart-form">
                    <div class="cart-order__warning">
                        Доставка осуществляется путем ежедневной отправки (за исключением выходных и праздничных дней) транспортными компаниями. Оплата возможна как наличным, так и безналичным способом оплаты с выставлением счета и договора на вашу организацию.
                    </div>
                    <label class="cart-form__label">Личные данные</label>
                    <div class="cart-form__row">
                        <div class="cart-form__group">
                            <?= $form->textField($order, 'name', [
                                'class' => 'form-control',
                                'placeholder' => 'Ф.И.О.*',
                            ]); ?>
                            <?= $form->error($order, 'name'); ?>
                        </div>
                        <div class="cart-form__group">
                            <?= $form->textField($order, 'email', [
                                'class' => 'form-control',
                                'placeholder' => 'Email*',
                            ]); ?>
                            <?= $form->error($order, 'email'); ?>
                        </div>
                        <div class="cart-form__group">
                            <?php $this->widget('CMaskedTextFieldPhone', [
                                    'model' => $order,
                                    'attribute' => 'phone',
                                    'mask' => '+7(999)999-99-99',
                                    'htmlOptions'=>[
                                        'class' => 'data-mask form-control',
                                        'data-mask' => 'phone',
                                        'placeholder' => 'Телефон*',
                                        'autocomplete' => 'off'
                                    ]
                                ]) ?>
                            <?php echo $form->error($order, 'phone'); ?>
                        </div>
                    </div>
                    
                    <div class="cart-form__delivery">
                        <?php if(!empty($deliveryTypes)):?>
                            <div class="cart-form__group">
                                <label class="cart-form__label"><?= Yii::t("CartModule.cart", "Информация о доставке"); ?></label>
                                <div class="cart-form__delivery-controls">
                                    <?php foreach ($deliveryTypes as $key => $delivery): ?>
                                        <div class="cart-form__delivery-control">
                                            <input type="radio" name="Order[delivery_id]" id="delivery-<?= $delivery->id; ?>"
                                                   value="<?= $delivery->id; ?>"
                                                   data-price="<?= $delivery->price; ?>"
                                                   data-free-from="<?= $delivery->free_from; ?>"
                                                   data-available-from="<?= $delivery->available_from; ?>"
                                                   data-separate-payment="<?= $delivery->separate_payment; ?>">
                                            <label for="delivery-<?= $delivery->id; ?>">
                                                <span class="cart-form_delivery__icon"></span>
                                                <span class="cart-form_delivery-name"><?= $delivery->name; ?></span>
                                            </label>
                                            <!-- <div class="cart-form_delivery-name"><?= $delivery->name; ?></div> -->
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif;?> 
                    </div>
                    <div class="cart-form__row">
                        <div class="cart-form__group">
                            <?= $form->textArea($order, 'comment', [
                                'class' => 'form-control',
                                'placeholder' => 'Комментарий к заказу',
                            ]); ?>
                        </div>
                    </div>
                    <div class="cart-form__total">
                        <span><?= Yii::t("CartModule.cart", "Сумма заказа"); ?></span>
                        <span>
                            <strong id="cart-full-cost-with-shipping">0</strong> 
                            <?= Yii::t("CartModule.cart", Yii::app()->getModule('store')->currency); ?>
                        </span>
                    </div>
                    <div class="cart-form__order-button">
                        <button type="submit" class="btn btn-green">
                            <?= Yii::t("CartModule.cart", "Оформить заказ"); ?>
                        </button>
                    </div> 
                </div>
                <div class="cart-order__sidebar cart-sidebar">
                    <div class="cart-sidebar__name">Мой заказ</div>
                    <?php   
                        $counts = 0;
                        foreach ($positions as $position):
                        $productModel = $position->getProductModel();
                        if (is_null($productModel)) continue; 
                        $counts++; ?>
                        <div class="cart-sidebar__info cart-sidebar-info <?= $counts > 3 ? 'hidden' : '' ?>">
                            <?php $positionId = $position->getId(); ?>
                            <?php $productUrl = ProductHelper::getUrl($position); ?>
                            <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][product_id]', $position->id); ?>
                            <input type="hidden" class="position-id" value="<?= $positionId; ?>"/>
                            <div class="cart-sidebar-info__col cart-sidebar-info__name">
                                <span><?= $position->name; ?></span>
                                <?php if (isset($productModel->category)): ?>
                                    <span class="cart-sidebar-info__cat-name">Категория: 
                                        <?= $productModel->category->name ?>
                                        <?= $counts ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="cart-sidebar-info__col cart-sidebar-info__price">
                                <strong>
                                    <span class="position-sum-price"><?= $position->getSumPrice(); ?></span> &#x20bd;
                                </strong><br>
                                <span>
                                    <span id="cart_" class="position-count">1 шт.</span>
                                    <input id="cart_<?= $positionId ?>" class="form-control text-center position-count" type="hidden" value="<?= $position->getQuantity() ?>" name="OrderProduct[<?= $positionId ?>][quantity]">
                                </span> = 
                                <span><?= $position->getPrice(); ?> &#x20bd;</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <a href="#" class="cart-sidebar__more js-cart-sidebar-more <?= $counts < 4 ? 'hidden' : '' ?>">
                        <span data-text="Скрыть">Показать весь заказ</span>
                    </a>
                </div>
            </div>
        <?php $this->endWidget(); ?>
        <?php endif; ?>
    </div>
</div>        
    

