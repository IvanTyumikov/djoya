<?php
/** @var $order Order */
/** @var $deliveryTypes[] Delivery */
?>

<?php if (!empty($deliveryTypes)) :?>
    <h4>Выберите способ получения товара</h4>
    <div class="delivery-list fl fl-wr-w">
        <?php foreach ($deliveryTypes as $key => $delivery) : ?>
            <?php
            $price = $delivery->price;
            if ($price==0) {
                $price = $delivery->getMinCostSystem($order);
                if ($price===false) {
                    continue;
                }
            }
            ?>
            <div class="delivery-list__item js-items-delivery_id fl fl-di-c fl-ju-co-sp-b">
                <input type="radio" name="Order[delivery_id]" id="delivery-<?= $delivery->id; ?>"
                    value="<?= $delivery->id; ?>"
                    data-price="<?= $price; ?>"
                    data-free-from="<?= $delivery->free_from; ?>"
                    data-available-from="<?= $delivery->available_from; ?>"
                    data-separate-payment="<?= $delivery->separate_payment; ?>"
                    <?= (isset($_POST['Order']['delivery_id']) && $delivery->id === $_POST['Order']['delivery_id'])  ? 'checked' : ''?>
                    >
                <label class="radio cart-text-bold" for="delivery-<?= $delivery->id; ?>">
                    <?= $delivery->name; ?>
                </label>
                <div>
                    <div class="delivery-list__desc">
                        <?= $delivery->description; ?>
                    </div>
                    <div class="delivery-list__price">
                        <?php if ($price===0) : ?>
                            Бесплатно
                        <?php else : ?>
                            <?= $price; ?> <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if ($order) : ?>
            <?= CHtml::error($order, 'delivery_id') ?>
        <?php endif ?>
    </div>

    <div class="js-delivery-method">
        <?php
        if (isset($_POST['Order']['delivery_id'])) {
            $this->widget('application.modules.delivery.widgets.DeliveryMethodWidget', [
                'deliveryId' => $_POST['Order']['delivery_id'],
            ]);
        }
        ?>
    </div>
<?php else :?>
    <div class="alert alert-danger">
        <?= Yii::t("DeliveryModule.delivery", "Delivery method aren't selected! The ordering is impossible!") ?>
    </div>
<?php endif;?>

