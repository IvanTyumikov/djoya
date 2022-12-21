<?php
/* @var $model Order */
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

$this->title = Yii::t('OrderModule.order', 'Order #{n}', [$model->id]);
$this->breadcrumbs = [Yii::t('OrderModule.order', 'Order #{n}', [$model->id])];

$array = Yii::app()->user->getFlashes();


?>
<?php if (Yii::app()->hasModule('coupon')) : ?>
    <?php foreach ($coupons as $coupon) : ?>
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
    <?php endforeach; ?>
<?php endif; ?>

<div class="page-content pay">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <h1 class="title">
            Предпросмотр заказа
        </h1>
        <p class="subtitle">Информация о заказе</p>
        <div class="pay-details_list">
            <div class="pay-details_item">
                <div class="item-caption">
                    Способ доставки:
                </div>
                <div class="item-values">
                    <div class="item-value">
                        <?php if (!empty($model->delivery)) : ?>
                            <?= CHtml::encode($model->delivery->name); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="pay-details_item">
                <div class="item-caption">
                    Контактные данные:
                </div>
                <div class="item-values">
                    <div class="item-value">
                        <?= CHtml::encode($model->name); ?>
                    </div>
                    <div class="item-value">
                        <?= CHtml::encode($model->country); ?>
                    </div>
                    <div class="item-value">
                        <?= CHtml::encode($model->phone); ?>
                    </div>
                    <div class="item-value">
                        <?= CHtml::encode($model->email); ?>
                    </div>
                    <div class="item-value">
                        <?= (CHtml::encode($model->comment)) ?: 'Нет комментария'; ?>
                    </div>
                </div>
            </div>
            <div class="pay-details_item">
                <div class="item-caption">
                    Способ оплаты:
                </div>
                <div class="item-values">
                    <div class="item-value">
                        Ю-Касса
                    </div>
                </div>
            </div>
            <div class="pay-details_item">
                <div class="item-caption">
                    Стоимость товаров:
                </div>
                <div class="item-values">
                    <div class="item-value">
                        <?= $model->getTotalPriceWithDelivery(); ?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span>
                    </div>
                </div>
            </div>
            <div class="pay-details_item">
                <div class="item-caption">
                    Стоимость доставки:
                </div>
                <div class="item-values">
                    <div class="item-value">
                        Бесплатно
                    </div>
                </div>
            </div>
        </div>
        <div class="pay-box">
            <div class="pay-box__header">
                Товары
            </div>
            <div class="pay-box__list_wrapper">
                <div class="pay-box__list">
                    <div class="pay-box__titles">
                        <div class="pay-box__titles_name">
                            Наименование
                        </div>
                        <div class="pay-box__titles_count">
                            Количество
                        </div>
                        <div class="pay-box__titles_price">
                            Цена
                        </div>
                    </div>
                    <div class="pay-box__body">
                        <?php foreach ((array)$model->products as $key => $position) : ?>
                            <div class="pay-box__items">
                                <div class="pay-box__items_name">
                                    <a href="<?= $productUrl; ?>"><?= CHtml::encode($position->product->name); ?></a>
                                </div>
                                <div class="pay-box__items_count">
                                    <?= $position->quantity; ?> <?= Yii::t("OrderModule.order", "PCs"); ?>
                                </div>
                                <div class="pay-box__items_price">
                                    <span class=""><?= $position->price; ?></span>
                                    <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="pay-box__delivery">
                            <span class="pay-box__delivery_caption">Доставка</span>
                            <span class="pay-box__delivery_value">Бесплатно</span>
                        </div>
                    </div>
                    <div class="pay-box__total">
                        <span class="pay-box__total_caption">Итого:</span>
                        <span class="pay-box__total_value"><?= $model->getTotalPriceWithDelivery(); ?> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="pay-payments">
            <a class="pay-payments_btn" href="#">Оплатить</a>
        </div>
    </div>
</div>

<?php
Yii::app()->getClientScript()->registerScript(
    'js-coupons',
    "

    function getCoupons() {
        var coupons = [];
        $.each($('.coupon-input'), function (index, elem) {
            var elm = $(elem);
            coupons.push({
                code: elm.data('code'),
                name: elm.data('name'),
                value: elm.data('value'),
                type: elm.data('type'),
                min_order_price: elm.data('min-order-price'),
                free_shipping: elm.data('free-shipping')
            })
        });

        return coupons;
    }

    let coupons = getCoupons();
    let delta = 0;
    var coupon_prices = 0;

    let prices_product = $('.pay-box__items ');
    var categoryIdCoupons = categoryIdCoupon.split(',');
    $.each(prices_product, function (index, e) {
        var elem = $(this).find('.pay-box__totalPrice');
        let price_product = parseFloat(elem.text());
        let category_id = elem.data('cat_id');
        $.each(coupons, function (index, el) {
            if (price_product >= el.min_order_price) {
                switch (el.type) {
                    case 0: // руб
                    delta = parseFloat(el.value).toFixed(0);
                    break;
                    case 1: // %
                    delta = (parseInt(el.value) / 100).toFixed(2) * price_product.toFixed(2);
                    break;
                }
            }
        });

        let products_coup = [];
        let j = 0;
        $.each(categoryIdCoupons, function (index, el) {
            if(category_id == el){
                coupon_prices += delta;
                products_coup[j] = delta;
                j++;
            }
        });

        var elem_old = $(this).find('.pay-box__price');

        for (var i = 0; i < products_coup.length; i++) {
           let price_coupon = parseFloat(elem.text()) - parseFloat(products_coup[i]);
           if (products_coup[i] != 0) {
               elem.find('strong span').text(price_coupon);
               elem_old.find('strong span').css({'text-decoration': 'line-through'});
           }
        }
    });
",
    CClientScript::POS_END
);
?>