<div class="delivery-list fl fl-wr-w">
    <?php foreach ($data as $delivery) : ?>
        <div class="delivery-list__item js-items-sub_delivery_id fl fl-di-c fl-ju-co-sp-b <?= (isset($_POST['Order']['sub_delivery_id']) and $_POST['Order']['sub_delivery_id']==$delivery['id']) ? 'active' : '';?>">
            <input type="radio" name="Order[sub_delivery_id]" id="sub_delivery-<?= $delivery['id']; ?>"
                value="<?= $delivery['id']; ?>"
                data-price="<?= $delivery['price']; ?>"
                data-free-from="<?= $delivery['free_from']; ?>"
                data-available-from="<?= $delivery['available_from']; ?>"
                data-separate-payment="<?= $delivery['separate_payment']; ?>"
                data-action="<?= Yii::app()->createUrl('/cdek/cdek/widget') ?>"
                <?= (isset($_POST['Order']['sub_delivery_id']) and $_POST['Order']['sub_delivery_id']==$delivery['id']) ? 'checked' : '' ?>
                >
            <label class="radio cart-text-bold" for="sub_delivery-<?= $delivery['id']; ?>">
                <?= CHtml::image($delivery['image']) ?>
                <?= $delivery['name']; ?>
            </label>
            <div>
                <div class="delivery-list__desc">
                    <?= $delivery['description']; ?>
                </div>
                <div class="delivery-list__price">
                    <?= $delivery['price']; ?> <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/ruble.svg'); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="js-sub-delivery">
    <?= $widget ?>
</div>

<?php Yii::app()->getClientScript()->registerScript("js-delivery-method", "
    
"); ?>