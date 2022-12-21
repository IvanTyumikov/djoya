<?php
/** @var $system CdekSystem */
?>


<h4>Найдите магазин выдачи или выберите из списка</h4>
<?php $cdekCheckbox = isset($_POST['Order']['cdek_pvz']) ? $_POST['Order']['cdek_pvz'] : []?>

<div class="delivery-nav delivery-nav-noTemplate fl fl-wr-w fl-ju-co-sp-b">
    <div class="delivery-nav__item input-group delivery-search-input">
        <div class="js-search-jconpagefilter">
            <?= CHtml::textField('sdek', '', [
                'class'        => 'form-control',
                'autocomplete' => 'off',
                'placeholder'  => 'Поиск'
            ]) ?>
            <div class="js-search-jconpagefilter__close">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/filter-close.svg'); ?>
            </div>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <?= file_get_contents(Yii::getPathOfAlias('application.modules.delivery.views.assets.img') . '/icon-search.svg'); ?>
                </button>
            </span>
        </div>
    </div>
</div>
<div class="pickup-wrap">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active"  id="text-list">
            <div class="pickup-tab-content">
                <div class="js-search-jconpagefilter-noSearch hidden">
                    Совпадений не найдено!
                </div>
                <?php foreach ($system->deliverypoints() as $cdek) : ?>
                    <?php $inputId = sprintf('pickup-%d', $cdek['code']) ?>
                    <?php $checked = array_search($cdek['code'], $cdekCheckbox) ?>

                    <div class="pickup-item fl fl-wr-w fl-ju-co-sp-b js-pickup-item js-search-jconpagefilter-item"
                        data-id="<?= $cdek['code'] ?>"
                        data-name="<?= $cdek['name'] ?>"
                        data-address="<?= $cdek['location']['address_full'] ?>"
                        data-description="<?= $cdek['address_comment'] ?>"
                        data-mode="<?= $cdek['work_time'] ?>"
                        data-phone="<?= $cdek['phones'][0]['number'] ?>"
                        data-email="<?= $cdek['email'] ?>"
                        data-latitude="<?= $cdek['location']['latitude'] ?>"
                        data-longitude="<?= $cdek['location']['longitude'] ?>"
                        style="display: <?= (!empty($cdekCheckbox) and $checked===false) ? 'none' : '' ?>"
                    >
                        <div class="pickup-item__content">
                            <div class="pickup-item__name"><span class="searchable"><?= $cdek['name'] ?></span></div>
                            <div class="pickup-item__mode"><?= $cdek['work_time'] ?></div>
                            <div class="pickup-item__phone"><?= $cdek['phones'][0]['number'] ?></div>
                        </div>
                        <div class="pickup-item__buttons fl fl-wr-w fl-ju-co-fl-e">
                            <a href="#pickup-modal" class="bt-cart bt-cart-border-green">Подробнее</a>
                            <label for="<?= $inputId ?>" class="bt-cart bt-cart-red pickup-checkbox">
                                <input
                                    type="checkbox"
                                    id="<?= $inputId ?>"
                                    name="Order[cdek_pvz][]"
                                    value="<?= $cdek['code'] ?>"
                                    class="js-checkbox"
                                    <?= $checked===false ? '' : 'checked' ?>
                                    >
                                <span><?= $checked===false ? 'Забрать отсюда' : 'Выбрать другой' ?></span>
                            </label>
                        </div>
                        <div class="pickup-item__map js-pickup-item__map"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane"  id="map-list">
            <div class="js-map-box-ya" id="mapDelivery" style="height: 400px;"></div>
        </div>
    </div>
</div>

<div class="pickup-modal modal fade" id="pickup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div data-dismiss="modal" class="modal-close"><div></div></div>
                <div class="modal-header__heading" id="myModalLabel">Пункт выдачи товара</div>
            </div>
            <div class="modal-body js-pickupModal-item">
                <div class="pickup-modal__map js-pickupModal-map" id="map" style="width: 100%; height: 232px;"></div>
                <div class="pickup-modal__info">
                    <div class="pickup-modal__item">
                        <div class="pickup-modal__name js-pickup-modal-name"></div>
                    </div>
                    <div class="pickup-modal__item">
                        <div class="pickup-modal__mark"><strong>Адрес</strong></div>
                        <div class="pickup-modal__address js-pickup-modal-address"></div>
                        <div class="pickup-modal__mode js-pickup-modal-mode"></div>
                    </div>
                    <div class="pickup-modal__item">
                        <div class="pickup-modal__mark"><strong>Контаты</strong></div>
                        <div class="pickup-modal__phone js-pickup-modal-phone"></div>
                        <div class="pickup-modal__email js-pickup-modal-email"></div>
                    </div>
                    <div class="pickup-modal__item">
                        <div class="pickup-modal__description js-pickup-modal-description"></div>
                    </div>
                    <div class="pickup-modal__item pickup-modal__item_but fl">
                        <a href="#" class="bt-cart bt-cart-red js-pickupModal-checkbox">Забрать отсюда</a>
                    </div>
                    <div class="hidden js-pickup-modal-id"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('keyup', '.js-search-jconpagefilter input', function (event) {
        var elem = $(this);
        var value = elem.val();
        var parent = elem.parents('.js-search-jconpagefilter').find('.js-search-jconpagefilter__close');

        if(value.length > 0){
            elem.addClass('active');
            parent.addClass('active');
            if($('.search-results').length == 0){
                $('.js-search-jconpagefilter-noSearch').removeClass('hidden');
            } else{
                $('.js-search-jconpagefilter-noSearch').addClass('hidden');
            }
        } else{
            elem.removeClass('active');
            parent.removeClass('active');
            $('.js-search-jconpagefilter-noSearch').addClass('hidden');
        }
    });
    // $('.js-search-jconpagefilter input').jcOnPageFilter({
    //     parentLookupClass:'js-search-jconpagefilter-item',
    //     childBlockClass:'searchable',
    // });

    $(document).delegate('.js-search-jconpagefilter__close', 'click', function(){
        var parent = $('.js-search-jconpagefilter').find('input');
        parent.val('').keyup();
        return false;
    });
</script>