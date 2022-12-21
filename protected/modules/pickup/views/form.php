<?php $pickupCheckbox = isset($_POST['Order']['pickup']) ? $_POST['Order']['pickup'] : []?>
<h4>Найдите магазин выдачи или выберите из списка</h4>

<div class="delivery-nav fl fl-wr-w fl-ju-co-sp-b">
    <div class="delivery-nav__item input-group delivery-search-input">
        <div class="js-search-jconpagefilter">
            <?= CHtml::textField('pickup', '', [
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
    <div class="delivery-nav__item delivery-nav__template">
        <ul class="delivery-nav-template fl" role="tablist">
            <li role="presentation" class="delivery-nav-template__item active">
                <a class="fl fl-al-it-c fl-ju-co-c js-delivery-template" href="#text-list" aria-controls="text-list" role="tab" data-toggle="tab">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/location-list.svg'); ?>
                </a>
            </li>
            <li class="delivery-nav-template__item" role="presentation">
                <a class="fl fl-al-it-c fl-ju-co-c js-delivery-template" href="#map-list" aria-controls="map-list" role="tab" data-toggle="tab">
                    <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/cart/location-map.svg'); ?>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="pickup-wrap">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active"  id="text-list">
            <div class="pickup-tab-content">
                <div class="js-search-jconpagefilter-noSearch hidden">
                    Совпадений не найдено!
                </div>
                <?php foreach ($pickups as $pickup) : ?>
                    <?php $inputId = sprintf('pickup-%d', $pickup->id) ?>
                    <?php $checked = array_search($pickup->id, $pickupCheckbox) ?>

                    <div class="pickup-item fl fl-wr-w fl-ju-co-sp-b js-pickup-item js-search-jconpagefilter-item"
                        data-id="<?= $pickup->id ?>"
                        data-name="<?= $pickup->name ?>"
                        data-address="<?= $pickup->address ?>"
                        data-description="<?= $pickup->description ?>"
                        data-mode="<?= $pickup->mode ?>"
                        data-phone="<?= $pickup->phone ?>"
                        data-email="<?= $pickup->email ?>"
                        data-latitude="<?= $pickup->latitude ?>"
                        data-longitude="<?= $pickup->longitude ?>"
                        data-status="<?= $pickup->status ?>"
                        style="display: <?= (!empty($pickupCheckbox) and $checked===false) ? 'none' : '' ?>"
                    >
                        <div class="pickup-item__content">
                            <div class="pickup-item__name"><span class="searchable"><?= $pickup->name ?></span></div>
                            <div class="pickup-item__mode"><?= $pickup->mode ?></div>
                            <div class="pickup-item__phone"><?= $pickup->phone ?></div>
                        </div>
                        <div class="pickup-item__buttons fl fl-wr-w fl-ju-co-fl-e">
                            <a href="#pickup-modal" class="bt-cart bt-cart-border-green">Подробнее</a>
                            <label for="<?= $inputId ?>" class="bt-cart bt-cart-red pickup-checkbox">
                                <input
                                    type="checkbox"
                                    id="<?= $inputId ?>"
                                    name="Order[pickup][]"
                                    value="<?= $pickup->id ?>"
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

<?php Yii::app()->getClientScript()->registerScript("js-delivery-method", "
    $('.js-delivery-template[data-toggle=\"tab\"]').on('show.bs.tab', function (e) {
        var activeTab = $(e.target), // активная вкладка
            previousTab = $(e.relatedTarget); // предыдущая вкладка, которая до этого была активной

        $('.js-search-jconpagefilter').removeClass('hidden');
        if(activeTab.attr('href') == '#map-list'){
            $('.js-search-jconpagefilter').addClass('hidden');
        }
    });
    $('.js-search-jconpagefilter input').on('keyup', function (event) {
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
    $('.js-search-jconpagefilter input').jcOnPageFilter({
        parentLookupClass:'js-search-jconpagefilter-item',
        childBlockClass:'searchable',
    });

    $(document).delegate('.js-search-jconpagefilter__close', 'click', function(){
        var parent = $('.js-search-jconpagefilter').find('input');
        parent.val('').keyup();
        return false;
    });

    var json = {$json};
    var myMap;
    //Дождёмся загрузки API и готовности DOM.
    if(!$('.js-map-box-ya').hasClass('active')){
        ymaps.ready(init);
    }

    function init() {
        var myPoint = json;
        // Создание экземпляра карты и его привязка к контейнеру с заданным id
        myMap = new ymaps.Map('mapDelivery', {
            center: eval(myPoint[1]['coords']),
            zoom: 17
        });

        // Шаблон balloon
        var layoutName = '<div class=\"delivery-map-item__name\"><span class=\"delivery-map-item__link delivery-map-item__link_adress js-link-delivery-map \" data-id=\"{{ properties.id }}\">{{ properties.name }}</span></div>';
        var layoutMode = '<div class=\"delivery-map-item__mode\">{{ properties.mode }}</div>';
        var layoutPhone = '<div class=\"delivery-map-item__phone\">{{ properties.phone }}</div>';
        BalloonLayout = ymaps.templateLayoutFactory.createClass('<div class=\"delivery-map-item\">'+ layoutName + layoutMode + layoutPhone + '</div>');
        HintLayout = ymaps.templateLayoutFactory.createClass('<div class=\"delivery-map-item delivery-map-item-hover\">'+ layoutName + layoutMode + layoutPhone + '</div>');

        var placemark = [];
        // Метки
        $.each(myPoint, function (i, v) {
            placemark[i] = new ymaps.Placemark(eval(v.coords), {
                id: v.id,
                name: v.name,
                mode: $('<div/>').html(v.mode).text(),
                phone: $('<div/>').html(v.phone).text(),
                address: v.address,
            }, {
                hintLayout: HintLayout,
                balloonContentLayout: BalloonLayout,
                balloonPanelMaxMapArea: 0,
                preset: 'islands#blackDotIconWithCaption',
                iconColor: '#00A44B'
            });
            placemark[i].events.add('click', function(e){
                var placemark = e.get('target');
                var id = placemark.properties.get('id');
                
                var parent = $('.js-search-jconpagefilter').find('input');
                parent.val('').keyup();

                $(\".js-pickup-item__map\").html('');
                $('.js-pickup-item input[type=\"checkbox\"]:checked').parent().click();
                $('.js-pickup-item[data-id=\"'+id+'\"]').find('input[type=\"checkbox\"]').prop(\"checked\",true).trigger('change');
            });
            myMap.geoObjects.add(placemark[i]);

        });

        myMap.setBounds(myMap.geoObjects.getBounds(), {checkZoomRange:true}).then(function(){
            if(myMap.getZoom() > 15) {
                myMap.setZoom(15);
            }
            if(myMap.getZoom() < 5) {
                myMap.setZoom(5);
            }
        });

        $('.js-map-box-ya').addClass('active');
    }

    $('.js-link-delivery-map').on('click', function(event) {
        event.preventDefault();

        console.log($(this).data('id'));

        return false;
    });
"); ?>