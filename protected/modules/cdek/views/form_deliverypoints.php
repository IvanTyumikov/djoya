<div class="pickup-wrap <?= $select ? '' : 'hide' ?> js-sub-delivery" data-sub_delivery="<?= $id; ?>">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active"  id="text-list">
            <div class="pickup-tab-content">
                <?php foreach ($data as $deliverypoints) : ?>
                    <?php $inputId = sprintf('pickup-%d', $deliverypoints['code']) ?>
                    <?php $checked = false ?>
                    <div class="pickup-item fl fl-wr-w fl-ju-co-sp-b js-pickup-item"
                        data-id="<?= $deliverypoints['code'] ?>"
                        data-name="<?= $deliverypoints['name'] ?>"
                        data-address="<?= $deliverypoints['location']['address_full'] ?>"
                        data-description="<?= $deliverypoints['address_comment'] ?>"
                        data-mode="<?= $deliverypoints['work_time'] ?>"
                        data-phone="<?= $deliverypoints['phones'][0]['number'] ?? null ?>"
                        data-email="<?= $deliverypoints['email'] ?>"
                        data-latitude="<?= $deliverypoints['location']['latitude'] ?>"
                        data-longitude="<?= $deliverypoints['location']['longitude'] ?>"
                    >
                        <div class="pickup-item__content">
                            <div class="pickup-item__name"><span><?= $deliverypoints['name'] ?></span></div>
                            <div class="pickup-item__mode"><?= $deliverypoints['work_time'] ?></div>
                            <div class="pickup-item__phone"><?= $deliverypoints['phones'][0]['number'] ?? null ?></div>
                        </div>
                        <div class="pickup-item__buttons fl fl-wr-w fl-ju-co-fl-e">
                            <a href="#pickup-modal" class="bt-cart bt-cart-border-green">Подробнее</a>
                            <label for="<?= $inputId ?>" class="bt-cart bt-cart-red pickup-checkbox">
                                <input
                                    id="<?= $inputId ?>"
                                    type="checkbox"
                                    name="Order[pickup][]"
                                    value="<?= $deliverypoints['code'] ?>"
                                    class="js-checkbox"
                                    <?= $checked===false ? '' : 'checked' ?>
                                    >
                                <span><?= $checked===false ? 'Забрать отсюда' : 'Выбрать другой' ?></span>
                            </label>
                        </div>
                        <div class="pickup-item__map js-pickup-item__map"></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>