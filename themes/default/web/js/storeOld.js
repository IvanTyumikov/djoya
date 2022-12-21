function showNotify(element, result, message) {
    $('#notifications').html('<div class="notifications-' + result + '">' + message + '</div>').fadeIn().delay(2000).fadeOut();
}

// $(document).ajaxError(function () {
//     $('#notifications').html('<div class="alert alert-danger">Произошла ошибка =(</div>').fadeIn().delay(3000).fadeOut();
// });

/* Функция для обновления списка */
function filterUpdate() {
    let form = $('#store-filter'),
        top = $('.filter').offset().top - 50,
        data = form.serialize();

    history.pushState(null, location.title, location.pathname+'?'+data);

    if (data === '') {
        data={};
    }

    $('.product__items').addClass('ajax-load');

    $.fn.yiiListView.update('product-box', {
        'data': data,
        'url': '',
        'enableHistory': true,
        complete:function(data) {
            var filter_search = $(data.responseText).find('.filter__search').html();
            var sort_box = $(data.responseText).find('.sort-box__lists').html();
            $('.filter__search').html(filter_search);
            $('.sort-box__lists').html(sort_box);

            $('.ajax-loading').delay(100).fadeOut(500);

            $('body,html').animate({
                scrollTop: top + 'px'
            }, 400);

            $(".catalog-content__sidebar").removeClass('active');

            // Обновляем zoom у изображений продуктов
            $('.js-product-zoom').zoom({ on:'mouseover' });
            $('.product-list-big-preview__img').zoom({ on:'grab' });
            $(".js-image-lists").hover(jsImageHover);
        }
    });
    return false;
};

/* Вывод выбранных фильтров*/
function filterListSelected() {
    var selectedFilters = $('.selected-filters');
    var storeFilter = $('#store-filter');
    var elem = storeFilter.find('input:checked, option:selected, .range-input');
    var elems = [];
    selectedFilters.html('');
    $.each(elem, function (i, e) {
        var el = $(e);
        var type = null;
        var label = null;

        if (e.tagName === 'INPUT') {
            type = el.attr('type');
            if (type == 'radio') {
                var par = el.parents('.filter-block').find('.filter-block__header span');
                label = '<strong>' + par.data('title') + ': </strong>';
                label += ' ' + el.next('label').text();
            } else if (type == 'checkbox') {
                var par = el.parents('.filter-block').find('.filter-block__header span');
                label = '<strong>' + par.data('title') + ': </strong>';
                label += ' ' + el.next().text();
            } else if (type == 'text') {
                var value = el.val();
                if (value) {
                    // label = el.prev('label').text();
                    label = '<strong>' + el.parents('.filter-block').find('.filter-block__header span').text() + ': </strong>';
                    label += ' ' + el.val();
                }
            }
        } else if (el.hasClass('range-input')) {
            var par = el.parents('.filter-block').find('.filter-block__header span');
            type = 'number';
            var value = '';
            var count = 0;
            el.find('input').each(function () {
                if ($(this).val()) {
                    if (count != 0) {
                        value += ' - ';
                    }
                    value += $(this).val();
                    count++;
                }
            });
            if (value) {
                label = '<strong>' + par.data('title') + ': </strong>';
                label += value + ' ' + par.data('unit');
            }
        } else {
            type = 'select';
            label = el.text();
        }
        if (label && type) {
            elems.push({
                el: el,
                type: type,
                label: label,
            });
        }
    });
    if (elems.length > 0) {
        selectedFilters.append("<strong>Ваш выбор: </strong>");
    }

    $.each(elems, function (i, e) {
        var span = $('<span data-id=#' + e.el.attr("id") + ' class="label label-default"></span>');
        span
            .html(e.label);

        selectedFilters.append(span);
    });
    if (elems.length > 0) {
        selectedFilters.append('<span class="reset-filter">Очистить все</span>').addClass('active');
    } else {
        selectedFilters.removeClass('active');
    }
}

$(document).ready(function () {

    // Смена изображений при наведении
    let jsImageHover = function() {
        let parent = $(this).parents('.js-product-item');
        let src =  $(this).data("src");
        let key =  $(this).data("key");

        parent.find('.js-product-image img').attr('src', src);
        parent.find('.js-item-image-dots').removeClass('active');
        parent.find('.js-item-image-dots[data-key='+key+']').addClass('active');
    };

    $(".js-image-lists").hover(jsImageHover);

    // Сортировка товаров на листинге
    $(document).delegate('.js-sort-box', 'click', function(e){
        $(this).addClass('active');
    });

    $(document).delegate('body', 'click', function(e){
        if($(e.target).parents('.js-sort-box').length < 1){
            $('.js-sort-box').removeClass('active');
        }
    });

    $(document).delegate('.sort-box__list', 'click', function(){
        var elem = $(this),
            elemValue = elem.html();
        $('.product__items').addClass('list-view-loading');
        $.ajax({
            type: 'GET',
            url: elem.attr('data-href'),
            success:function(data) {
                $('.product__items').html($(data).find('.product__items').html());
                $('.sort-box__lists').html($(data).find('.sort-box__lists').html());
                $('.product__items').removeClass('list-view-loading');

                elem.addClass('active');

                $('.js-sort-box').find('#sort-box-value').html(elemValue);
                $('.js-sort-box').removeClass('active');
                $(".js-image-lists").hover(jsImageHover);
            },
        });
        return false;
    });

    // Варианты товара в карточке товара
    $(document).delegate('.js-product-variant .product-variant__value', 'click', function(e){
        $(this).parent().addClass('active');
    });

    $(document).delegate('body', 'click', function(e){
        if($(e.target).parents('.js-product-variant').length < 1){
            $('.js-product-variant').removeClass('active');
        }
    });

    $(document).delegate('.js-variant-price', 'click', function(){
        var elem = $(this),
            elemValue = elem.find('.value').html();

        $('.js-product-variant').find('.product-variant__value > .value').html(elemValue);
        $('.js-product-variant').removeClass('active');

    });

    //Загружаю изображения по выбранному цвету в карточке товара
    $(document).delegate('.js-product-info-color', 'click', function(){
        var elem = $(this),
            url = elem.parents('.product-info-color').data('action-images-color'),
            productId = elem.data('product-id'),
            variantId = elem.data('variant-id'),
            attributeValue = elem.data('attribute-value'),
            view = 'images-product';

        elem.parents('.product-info-color').find('.js-product-info-color').removeClass('active');

        $('#thumbnails').addClass('loading');

        $.ajax({
            type: 'post',
                url,
            data: {view, productId, variantId, YUPE_TOKEN: yupeToken},
            success: function(data) {
                elem.addClass('active');
                elem.parents('.product-info-color').find('.product-info-color__value').html(attributeValue);
                elem.parents('.product-view').find('.thumbnails').html(data);
                elem.parents('.product-view')
                    .find('.product-info__variants-hidden-filds input')
                    .prop('checked', false);
                elem.parents('.product-view')
                    .find('.product-info__variants-hidden-filds input[data-atribute-id=' + variantId + ']')
                    .prop('checked', true);
                slickImagesProductInit();

                $('.js-product-variant-color')
                    .find('input[variant-id="'+variantId+'"]')
                    .prop('checked', true);

                setTimeout(function(){
                    slickImagesThumbProductInit();
                    $('#thumbnails').removeClass('loading');
                }, 100);
            }
        });
    });

    // Связать миниатюры и главные изображения slick-ом
    slickImagesProductInit();
    slickImagesThumbProductInit();
    function slickImagesProductInit(){
        $('.js-thumbnails-preview-slider').not('.slick-initialized').slick({
            fade: false,
            infinite: false,
            dots: false,
            arrows: true,
            speed: 100,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            asNavFor: '.thumbnails-small',
            prevArrow: '<span class="icon-prev slick-arrow"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.917 19.6803L15.5767 19.0252C15.7827 18.819 15.8962 18.5447 15.8962 18.2515C15.8962 17.9585 15.7827 17.6839 15.5767 17.4777L8.10309 10.0045L15.5849 2.52262C15.791 2.31677 15.9043 2.04213 15.9043 1.74912C15.9043 1.45611 15.791 1.18131 15.5849 0.975293L14.9293 0.320003C14.503 -0.106668 13.8085 -0.106668 13.3822 0.320003L4.44209 9.22804C4.23623 9.4339 4.09119 9.70821 4.09119 10.0038V10.0072C4.09119 10.3004 4.2364 10.5747 4.44209 10.7806L13.3579 19.6803C13.5638 19.8865 13.8464 19.9997 14.1394 20C14.4326 20 14.7113 19.8865 14.917 19.6803Z" fill="#757575"/></svg></span>',
            nextArrow: '<span class="icon-next slick-arrow"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.08303 0.319677L4.42335 0.974806C4.21733 1.18099 4.10383 1.4553 4.10383 1.74847C4.10383 2.04148 4.21733 2.31612 4.42335 2.5223L11.8969 9.99553L4.41506 17.4774C4.20904 17.6832 4.0957 17.9579 4.0957 18.2509C4.0957 18.5439 4.20904 18.8187 4.41506 19.0247L5.07067 19.68C5.49702 20.1067 6.19149 20.1067 6.61784 19.68L15.5579 10.772C15.7638 10.5661 15.9088 10.2918 15.9088 9.99618V9.99276C15.9088 9.69959 15.7636 9.42528 15.5579 9.21942L6.64207 0.319677C6.43621 0.113497 6.15361 0.000326157 5.8606 0C5.56742 0 5.28872 0.113497 5.08303 0.319677Z" fill="#757575"/></svg></span>',
        });
    };

    function slickImagesThumbProductInit(){
        $('.thumbnails-small').not('.slick-initialized').slick({
            infinite: false,
            autoplay: false,
            dots: false,
            arrows: false,
            speed: 100,
            slidesToShow: 4,
            vertical: true,
            asNavFor: '.js-thumbnails-preview-slider',
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 577,
                    settings: {
                        slidesToShow: 4,
                        arrows: false,
                        vertical: false,
                    }
                },
            ]
        });
    }

    /*
     * фильтры при адаптации
    */
    $(document).delegate('.but-menu-filter', 'click', function () {
        $('body').addClass('bodymenu');
        // $('html').addClass('htmlmenu');
        $("#store-filter").addClass('active');
        $(".sidebar-box").addClass('active');
        return false;
    });
    // $(document).delegate('.sidebar-box', 'click', function(e) {
    $('.sidebar-box').on('click', function (e) {
        if ($(e.target).hasClass('sidebar-box')) {
            $('body').removeClass('bodymenu');
            // $('html').removeClass('htmlmenu');
            $(".sidebar-box").removeClass('active');
            $("#store-filter").removeClass('active');
            return false;
        }
    });

    /*
     * Действия при изменении окна
    */
    $(window).resize(function () {
        var innerWidth = window.innerWidth;
        if ($('.sidebar-box').hasClass('active')) {
            if (innerWidth > 1240) {
                $('body').removeClass('bodymenu');
                $(".sidebar-box").removeClass('active');
                $("#store-filter").removeClass('active');
            }
        }

        if (innerWidth < 769) {
            getTemplateProduct();
        }

        if ($('div').hasClass('lazySlideImg')) {
            $('.lazySlideImg').each(function () {
                lazySlideImg($(this));
            });
        }
    });

    /*
    * Товары
   */

    /* Функция определения шаблона на вывода товаров */
    function getTemplateProduct() {
        var box = $('.template-product__item.active');
        if (box.data('view') == "_item-list") {
            $('.template-product__item').addClass('active');
            box.removeClass('active');
            setCookie("store_item", "_item", {'path': '/'});
            setTimeout(filterUpdate(), 3000);
        }
    }

    /* Вызываем функцию при загрузке сайта  */
    let innerWidth = window.innerWidth;

    if (innerWidth < 769) {
        getTemplateProduct();
    }

    /* Клик, чтобы изменить шаблон вывода товаров */
    $(document).delegate(".template-product__item", "click", function () {
        setCookie("store_item", $(this).data("view"), {'path': '/'});
        $('.template-product__item').removeClass('active');
        $(this).addClass('active');
        filterUpdate();
        return false;
    });
    /*
     *  Фильтры у товаров
    */
    /* Скрыть/показать блок фильтры */
    $(document).delegate('.filter-block__header', 'click', function (e) {
        var parent = $(this).parents('.filter-block');
        $(this).toggleClass('no-active');
        parent.find('.filter-block__body').toggle().toggleClass('no-active');

        return false;
    });

    /* Автоматическое обновление списка при изменении */
    /*
    $(document).delegate('#store-filter', 'change', function(e){
        filterUpdate();
        return false;
    });*/

    $(document).delegate('.js-filter-update-auto', 'change', function (e) {
        butApply();
        return false;
    });

    /* Клик по постраничной навигации */
    $(document).delegate('#product-box .pagination li a', 'click', function () {
        $('.ajax-loading').fadeIn(500);
        var top = $('#product-box').offset().top - 50;
        $('body,html').animate({
            scrollTop: top + 'px'
        }, 400);
        $('.ajax-loading').delay(100).fadeOut(500);
    });

    /* Клик по кнопке применить фильтры */
    $(document).delegate('#store-filter .but-filter', 'click', function (e) {
        clearTimeout(timnotification);
        $('.js-notification').fadeOut();
        $('.box-wrapper').removeClass('active');
        filterUpdate();
        return false;
    });
    /*$(document).delegate('.but-filter', 'click', function(e){
        filterUpdate();
        var innerWidth = window.innerWidth;
        if(innerWidth <= 1240){
            $('body').removeClass('bodymenu');
            // $('html').removeClass('htmlmenu');
            $(".sidebar-box").removeClass('active');
            $("#store-filter").removeClass('active');
        }
        return false;
    })*/

    /* Кнопка сбросить убираем выделенные фильтры */
    $(document).delegate('.reset-filter, #reset-filter, button[type=reset]', 'click', function (e) {
        $('#store-filter').get(0).reset();
        // Saving it's instance to var
        rangeInputUpdate();
        filterUpdate();

        var innerWidth = window.innerWidth;
        if (innerWidth <= 1240) {
            $('body').removeClass('bodymenu');
            // $('html').removeClass('htmlmenu');
            $(".sidebar-box").removeClass('active');
            $("#store-filter").removeClass('active');
        }
        return false;
    });

    /* Кнопка сбросить убираем выделенные фильтры */
    $(document).delegate('.filter-block-reset', 'click', function (e) {
        var parent = $(this).parents('.filter-block');
        var elem = parent.find('input:checked, option:selected, .range-input');
        var type;
        $.each(elem, function (i, e) {
            type = $(this).attr('type')
            if (type == 'radio') {
                $(this).prop('checked', false);
            } else if (type == 'checkbox') {
                $(this).prop('checked', false);
            } else if (type == 'range-input') {
                $(this).find('input').val('');
                rangeInputUpdate();
            } else {
                $(this).prop("selected", false)
            }
        });

        parent.removeClass('selected');

        filterUpdate();

        var innerWidth = window.innerWidth;
        if (innerWidth <= 1240) {
            $('body').removeClass('bodymenu');
            // $('html').removeClass('htmlmenu');
            $(".sidebar-box").removeClass('active');
            $("#store-filter").removeClass('active');
        }

        return false;
    });

    /* Удаление фильтров из списка примененных */
    $(document).delegate('.selected-filters .label', 'click', function (e) {
        var id = $(this).attr('data-id');
        var type = $(id).attr('type');

        if (type == 'radio') {
            $(id).prop('checked', false);
        } else if (type == 'checkbox') {
            $(id).click();
        } else if (type == 'range-input') {
            $(id).find('input').val('');
            var update = $(id).data('update');
            var slider = $(update).data("ionRangeSlider");
            slider.update({
                from: 0,
                to: $(update).data('max')
            });
            // rangeInputUpdate();
        } else {
            $(id).prop("selected", false)
        }

        filterUpdate();

        return false;
    });

    /* Кнопка (Показать еще) в фильтрах*/
    $(document).delegate('.filter-block__more', 'click', function (e) {
        var parent = $(this).parents(".filter-block");
        var span = $(this).find("span");
        var text = span.data('text');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
            parent.find(".filter-list.hidden-2").removeClass("hidden-2").addClass("hidden");
            parent.find('.filter-block__list').removeClass("active").mCustomScrollbar('destroy');
            span.data('text', span.text());
            span.text(text);

        } else {
            $(this).addClass('active')
            parent.find(".filter-list.hidden").removeClass("hidden").addClass("hidden-2");
            parent.find('.filter-block__list').addClass("active").mCustomScrollbar();
            span.data('text', span.text());
            span.text(text);
        }
        return false;
    });

    /* Функция для обновления slider */
    function rangeInputUpdate() {
        $(".js-range").each(function () {
            var slider = $('#' + $(this).attr('id')).data("ionRangeSlider");
            slider.update({
                from: 0,
                to: $(this).data('max')
            });
        });
    }


    /*
     * Сортировка
    */
    /* Открыть список сортировок */
    $(document).delegate('.box-wrapper__header', 'click', function () {
        $(this).parent().toggleClass('active');
    });

    /* Клик по любому месту, чтобы закрыть все выпадающие списки */
    $(document).delegate('body', 'click', function (e) {
        if ($(e.target).parents('.box-wrapper').length < 1) {
            $('.box-wrapper').removeClass('active');
            // return false;
        }
    });

    /* клик по сортировке */
    $(document).delegate('.sort-box-wrapper__link', 'click', function () {
        var elem = $(this);
        $('.sort-box-wrapper__link').removeClass('active');

        // $('.ajax-loading').fadeIn(500);

        var top = $('#product-box').offset().top - 50;

        $('body,html').animate({
            scrollTop: top + 'px'
        }, 400);

        $.fn.yiiListView.update('product-box', {
            data: 'ajax=product-box&sort=' + elem.attr('data-href'),
            complete: function () {
                elem.addClass('active');
                elem.parents('.sort-box-wrapper').removeClass('active');
                $('.sort-box-wrapper__header').html(elem.html());
                // $('.ajax-loading').delay(100).fadeOut(500);
            }
        });


        return false;
    });

    /* Клик, чтобы изменить шаблон вывода товаров */
    $(document).delegate(".countItem-wrapper__link", "click", function () {
        setCookie("store_count", $(this).data("count"), {'path': '/'});
        $('.countItem-wrapper__link').removeClass('active');
        $(this).addClass('active');
        filterUpdate();
        return false;
    });

    $(document).delegate('.producer-filter', 'change', function (e) {
        var elem = $(this).find('input:checked');
        var ind = 0;
        var label = '';
        $.each(elem, function (i, e) {
            var el = $(e);
            if(ind > 0){
                label += ', ';
            }
            label += el.next().text();
            ind++;
        });
        if(ind > 0){
            $(this).find('.producer-filter-header').text(label);
        } else{
            $(this).find('.producer-filter-header').text('Не выбрано');
        }
    });

    /*$(document).delegate('.js-search-filter', 'click', function () {
        return false;
    });*/
    
    /*
     *  Рейтинг
    */
    // Клик по кнопке, чтобы показать всю таблицу
    $(document).delegate('.raiting-list-form .raiting-list__item', 'click', function () {
        var $this = $(this);
        var id = $this.data('id');
        $('.raiting-list-form .raiting-list__item').removeClass('active');
        $this.addClass('active').prevAll(".raiting-list__item").addClass('active');
        $this.parent().addClass('no-hover');
        $('#Review_rating').val(id);
        return false;
    });

    /*
     * Функционал для магазина
    */
    var cartWidgetSelector = '#shopping-cart-widget';

    /*страница продукта*/
    var priceElement = $('#result-price'); //итоговая цена на странице продукта
    var basePrice = parseFloat($('#base-price').val()); //базовая цена на странице продукта
    var quantityElement = $('#product-quantity');
    var quantityInputElement = $('#product-quantity-input');

    /*корзина*/

    var shippingCostElement = $('#cart-shipping-cost'); // Сумма доставки
    var cartFullCostElement = $('.js-cart-full-cost');  // сумма заказа без доставки со скидкой
    var cartFullCostWithShippingElement = $('.js-cart-full-cost-with-shipping'); //Итого сумма с доставкой

    /* Сумма заказа без доставки без скидки */
    var cartFullCostElement2 = $('#cart-full-cost2');
    var cartDiscountCost = $('.js-cart-discount-cost');


    miniCartListeners();
    refreshDeliveryTypes();
    // checkFirstAvailableDeliveryType();
    updatePositionListDiscount();
    updateAllCosts();

    // Галерея дополнительных изображений в карточке товара
    // $('.js-product-gallery').productGallery();

    // Табы в карточке товара
    // $('.js-tabs').tabs();

    // $(".js-select2").select2();

    $('#start-payment').on('click', function () {
        $('.payment-method-radio:checked').parents('.payment-method').find('form').submit();
    });

    /**
     * Очистить корзину
     */
    $('body').on('click', '.clear-cart', function (e) {
        e.preventDefault();
        var data = {};
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: '/coupon/clear',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                }
            }
        });
    });

    /**
     * Добавить купон
     */
    $(document).delegate('#add-coupon-code', 'click', function (e) {
        e.preventDefault();
        var code = $('#coupon-code').val();
        var button = $(this);
        if (code) {
            var data = {'code': code};
            data[yupeTokenName] = yupeToken;
            $.ajax({
                url: '/coupon/add',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.result) {
                        window.location.reload();
                    }
                    showNotify(button, data.result ? 'success' : 'danger', data.data.join('; '));
                }
            });
            $('#coupon-code').val('');
        }
    });

    /**
     * Удалить купон
     */
    $(document).delegate('.coupon .close', 'click', function (e) {
        e.preventDefault();
        var code = $(this).siblings('input[type="hidden"]').data('code');
        var data = {'code': code};
        var el = $(this).closest('.coupon');
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: '/coupon/remove',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                showNotify(this, data.result ? 'success' : 'danger', data.data);
                if (data.result) {
                    el.remove();
                    updateAllCosts();
                }
            }
        });
    });

    /*$('#coupon-code').keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#add-coupon-code').click();
        }
    });*/

    /**
     * Заблочить кнопку формы оформления в корзине
     */
    $('.order-form').submit(function () {
        $(this).find("button[type='submit']").prop('disabled', true);
    });

    /**
     * Обновить цену при изменении варианта
     */
    $('select[name="ProductVariant[]"]').change(function () {
        updatePrice();
    });

    /**
     * Кнопка плюс кол-во
     */
    $('.product-quantity-increase').on('click', function () {
        quantityInputElement.val(parseInt(quantityInputElement.val()) + 1).trigger('change');
    });

    /**
     * Кнопка минус кол-во
     */
    $('.product-quantity-decrease').on('click', function () {
        if (parseInt(quantityInputElement.val()) > 1) {
            quantityInputElement.val(parseInt(quantityInputElement.val()) - 1).trigger('change');
        }
    });

    /**
     * Изменить кол-во
     */
    $('#product-quantity-input').change(function (event) {
        var el = $(this);
        quantity = parseInt(el.val());

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        var quantityLimiterEl = el.parents('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (quantity < minQuantity) {
            quantity = minQuantity;
        } else if (quantity > maxQuantity) {
            quantity = maxQuantity;
        }

        el.val(quantity);
        quantityElement.text(quantity);
        $('#product-total-price').text(parseFloat($('#result-price').text()) * quantity);
    });

    /**
     * Добавить в корзину
     */
    $('body').on('click', '#add-product-to-cart', function (e) {
        e.preventDefault();
        var button = $(this);
        var form = $(this).parents('form');
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            url: form.attr('action'),
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                }
                showNotify(button, data.result ? 'success' : 'danger', data.data);
            }
        });
    });

    $('body').on('click', '.quick-add-product-to-cart', function (e) {
        e.preventDefault();
        var el = $(this);
        var data = {'Product[id]': el.data('product-id')};
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: el.data('cart-add-url'),
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                    el.off('click', '.quick-add-product-to-cart');
                    // el.removeClass('btn_cart')
                    //     .addClass('btn_success')
                    //     .html('Оформить заказ')
                    //     .attr('href', '/cart');
                }
                showNotify(el, data.result ? 'success' : 'danger', data.data);
            }
        });
    });

    $(document).delegate('.cart-quantity-increase', 'click', function () {
        var quantityLimiterEl = $(this).parents('.spinput'),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value')),
            target = $($(this).data('target')),
            targetText = $($(this).data('target-text'))
        thisVal = parseInt(target.val());

        if (thisVal < maxQuantity) {
            target
                .val(thisVal + 1).trigger('change');

            targetText
                .text(thisVal + 1);

        } else {
            showNotify(this, 'danger', "Максимальное кол-во на складе: " + maxQuantity + " шт.");
        }
    });

    $(document).delegate('.cart-quantity-decrease', 'click', function () {
        var target = $($(this).data('target')),
            targetText = $($(this).data('target-text')),
            thisVal = parseInt(target.val());

        if (parseInt(target.val()) > 1) {
            target.val(thisVal - 1).trigger('change');

            targetText
                .text(thisVal - 1);
        }
    });

    /* $('.cart-delete-product').click(function (e) {
        e.preventDefault();
        var el = $(this);
        var data = {'id': el.data('position-id')};
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: yupeCartDeleteProductUrl,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    el.closest('.js-cart-item').remove();

                    if ($('.cart-list .cart-item').length == 0) {
                        $('#order-form').remove();
                        $('.main__title h1').text('Корзина пуста');
                    }
                    $('#cart-total-product-count').text($('.cart-list .cart-item').length);
                    updateCartTotalCost();
                    updateCartWidget();
                }
            }
        });
    });

    $('.position-count').change(function () {
        var el = $(this).parents('.js-cart-item'),
            positionCountEl = el.find('.position-count');

        var quantity = parseInt(positionCountEl.val());
        var productId = el.find('.position-id').val();

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        var quantityLimiterEl = el.find('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (quantity < minQuantity) {
            quantity = minQuantity;
        }
        else if (quantity > maxQuantity) {
            quantity = maxQuantity;
        }

        positionCountEl.val(quantity);

        updatePositionSumPrice(el);
        changePositionQuantity(productId, quantity);
    });

    $('input[name="Order[delivery_id]"]').change(function () {
        updateShippingCost();
    });
    */
    /**
     * Удалить товар - в корзине
     */
    $(document).delegate('.cart-delete-product', 'click', function (e) {
        e.preventDefault();
        var el = $(this);
        var data = {'id': el.data('position-id')};
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: yupeCartDeleteProductUrl,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    el.closest('.js-cart-item').remove();

                    if ($('.cart-list .js-cart-item').length == 0) {
                        $('.cart-section').remove();
                        $('.empty-cart').css({'opacity': 1, 'display': 'block'});
                    }
                    // $('#cart-total-product-count').text($('.cart-list .cart-item').length);
                    positionCountPr();
                    updateCartTotalCost();
                    updateCartWidget();
                }
            }
        });
    });

    $(document).delegate('.position-count', 'change', function () {
        var el = $(this).parents('.js-cart-item'),
            positionCountEl = el.find('.position-count');

        var quantity = parseInt(positionCountEl.val());
        var productId = el.find('.position-id').val();

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        var quantityLimiterEl = el.find('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (quantity < minQuantity) {
            quantity = minQuantity;
        } else if (quantity > maxQuantity) {
            quantity = maxQuantity;
        }

        positionCountEl.val(quantity);

        updatePositionSumPrice(el);
        changePositionQuantity(productId, quantity);
        positionCountPr();
    });

    /**
     * Изменение способов доставки, обновление цены в корзине
     */
    $(document).on('change', 'input[name="Order[delivery_id]"], input[name="Order[sub_delivery_id]"]', function () {
        updateShippingCost();
    });

    function positionCountPr() {
        var quantityPr = 0;
        $(".cart-list .js-cart-item").each(function () {
            quantityPr = parseInt(quantityPr) + parseInt($(this).find('.position-count').val());
        });
        $('#cart-total-product-count').text(quantityPr);
    }

    function miniCartListeners() {
        $('.mini-cart-delete-product').click(function (e) {
            e.preventDefault();
            var el = $(this);
            var productid = el.data('product-id');
            $('.cart-mini').addClass('cart-ajax-loading');
            var data = {'id': el.data('position-id')};
            data[yupeTokenName] = yupeToken;
            $.ajax({
                url: yupeCartDeleteProductUrl,
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.result) {
                        updateCartWidget();
                        // el.parents('.cart-mini__item').remove();
                        $('.cart-mini').removeClass('cart-ajax-loading');
                        var button = $('.js-product-but[data-product-id=' + productid + ']');
                        // console.log(productid);
                        // console.log(button);
                        button.parents('.js-product-item').find('.spinput__value').removeClass('product-box-quantity-addcart').addClass('product-box-quantity-input');
                        button.removeClass('but-go-cart').addClass('but-animation but-svg but-svg-left add-one-product-to-cart').attr('href', '#');
                        button.find('span').html("Купить");
                    }
                }
            });
        });
    }

    /**
     * Получить стоимость всех товаров в корзине
     */
    function getPositionsCost() {
        var cost = 0;
        $.each($('.position-sum-price'), function (index, elem) {
            cost += parseFloat($(elem).text());
        });

        return cost;
    }

    /**
     * Общая сумма со скидкой
     */
    function getCartTotalCost() {
        var cost = getPositionsCost();
        var delta = 0;
        var coupons = getCoupons();
        $.each(coupons, function (index, el) {
            if (cost >= el.min_order_price) {
                switch (el.type) {
                    case 0: // руб
                        delta += parseFloat(el.value);
                        break;
                    case 1: // %
                        delta += (parseFloat(el.value) / 100) * cost;
                        break;
                }
            }
        });


        var totalCost = delta > cost ? 0 : cost - delta;
        return totalCost;
    }

    /**
     * Общая сумма без скидки у товаров
     */
    function getCartTotalNoDiscountCost() {
        var cost = 0;
        $.each($('.position-full-sum-price'), function (index, elem) {
            cost += parseFloat($(elem).text());
        });

        return cost;
    }

    /* Общая сумма скидки */
    function getCartDiscountCost() {
        var cost = 0;
        $.each($('.position-discount-sum-price'), function (index, elem) {
            cost += parseFloat($(elem).text());
        });

        return cost;
    }

    function updateCartTotalCost() {
        // cartFullCostElement.html(getCartTotalCost().toFixed(2));
        cartFullCostElement.html(number_format(getCartTotalNoDiscountCost(), 2, '.', ' '));
        refreshDeliveryTypes();
        updateShippingCost();
        updateFullCostWithShipping();
        checkMinAmountFunc();
        var discountTotal = getCartDiscountCost();
        if (discountTotal > 0) {
            cartDiscountCost.html('- ' + number_format(getCartDiscountCost(), 2, '.', ' '));
            cartDiscountCost.parents('.cart-total').removeClass('hidden');
        } else {
            cartDiscountCost.parents('.cart-total').addClass('hidden');
        }
    }

    function refreshDeliveryTypes() {
        var cartTotalCost = getCartTotalCost();
        $.each($('input[name="Order[delivery_id]"]'), function (index, el) {
            var elem = $(el);
            var availableFrom = elem.data('available-from');
            if (availableFrom.length && parseFloat(availableFrom) >= cartTotalCost) {
                if (elem.prop('checked')) {
                    checkFirstAvailableDeliveryType();
                }
                elem.prop('disabled', true);
            } else {
                elem.prop('disabled', false);
            }
        });
    }

    function checkFirstAvailableDeliveryType() {
        $('input[name="Order[delivery_id]"]:not(:disabled):first').prop('checked', true);
    }

    function getShippingCost() {
        var cartTotalCost = getCartTotalCost();
        var coupons = getCoupons();
        var freeShipping = false;
        $.each(coupons, function (index, el) {
            if (el.free_shipping && cartTotalCost >= el.min_order_price) {
                freeShipping = true;
            }
        });
        if (freeShipping) {
            return 0;
        }

        var selectedDeliveryType = $('input[name="Order[delivery_id]"]:checked');
        var selectedSubDeliveryType = $('input[name="Order[sub_delivery_id]"]:checked');
        // if (!selectedDeliveryType[0] || !selectedSubDeliveryType[0]) {
        //     return 0;
        // }

        if (selectedSubDeliveryType.length > 0) {
            if (parseInt(selectedSubDeliveryType.data('separate-payment')) || parseFloat(selectedSubDeliveryType.data('free-from')) <= cartTotalCost) {
                return 0;
            } else {
                return parseFloat(selectedSubDeliveryType.data('price'));
            }
        } else if (selectedDeliveryType.length > 0) {
            if (selectedDeliveryType.val() == 4) {
                return parseFloat(selectedDeliveryType.data('price'));
            } else if (parseInt(selectedDeliveryType.data('separate-payment')) || parseFloat(selectedDeliveryType.data('free-from')) <= cartTotalCost) {
                return 0;
            } else {
                return parseFloat(selectedDeliveryType.data('price'));
            }
        }
    }

    function updateShippingCost() {
        if (getShippingCost() > 0) {
            shippingCostElement
                .html(getShippingCost())
                .parents('.cart-total')
                .removeClass('hidden');
        } else {
            shippingCostElement.parents('.cart-total').addClass('hidden');
        }
        updateFullCostWithShipping();
    }

    function updateFullCostWithShipping() {
        var costRes = getShippingCost() + getCartTotalCost();
        if (costRes > 0) {
            cartFullCostWithShippingElement.html(number_format(costRes, 2, '.', ' '));
        }
    }

    function updateAllCosts() {
        updateCartTotalCost();
    }

    function updatePrice() {
        var _basePrice = basePrice;
        var variants = [];
        var varElements = $('select[name="ProductVariant[]"]');
        /* выбираем вариант, меняющий базовую цену максимально*/
        var hasBasePriceVariant = false;
        $.each(varElements, function (index, elem) {
            var varId = elem.value;
            if (varId) {
                var option = $(elem).find('option[value="' + varId + '"]');
                var variant = {amount: option.data('amount'), type: option.data('type')};
                switch (variant.type) {
                    case 2: // base price
                        // еще не было варианта
                        if (!hasBasePriceVariant) {
                            _basePrice = variant.amount;
                            hasBasePriceVariant = true;
                        } else {
                            if (_basePrice < variant.amount) {
                                _basePrice = variant.amount;
                            }
                        }
                        break;
                }
            }
        });
        var newPrice = _basePrice;
        $.each(varElements, function (index, elem) {
            var varId = elem.value;
            if (varId) {
                var option = $(elem).find('option[value="' + varId + '"]');
                var variant = {amount: option.data('amount'), type: option.data('type')};
                variants.push(variant);
                switch (variant.type) {
                    case 0: // sum
                        newPrice += variant.amount;
                        break;
                    case 1: // percent
                        newPrice += _basePrice * (variant.amount / 100);
                        break;
                }
            }
        });

        var price = parseFloat(newPrice.toFixed(2));
        priceElement.html(price);
        $('#product-result-price').text(price);
        $('#product-total-price').text(price * parseInt($('#product-quantity').text()));
    }

    function updateCartWidget() {
        $(cartWidgetSelector).load($('#cart-widget').data('cart-widget-url'));
    }

    function getCoupons() {
        var coupons = [];
        $.each($('.coupon-input'), function (index, elem) {
            var $elem = $(elem);
            coupons.push({
                code: $elem.data('code'),
                name: $elem.data('name'),
                value: $elem.data('value'),
                type: $elem.data('type'),
                min_order_price: $elem.data('min-order-price'),
                free_shipping: $elem.data('free-shipping')
            })
        });
        return coupons;
    }

    function updatePositionSumPrice(tr) {
        /*var count = parseInt(tr.find('.position-count').val());
        var price = parseFloat(tr.data('price'));
        var possum = (price * count).toFixed(2);
        tr.find('.position-sum-price').html(possum);*/

        updatePositionDiscount(tr);

        updateCartTotalCost();
    }

    function updatePositionListDiscount() {
        $(".cart-list .js-cart-item").each(function () {
            updatePositionDiscount($(this));
        });
        updateCartTotalCost();
    }

    function updatePositionDiscount(elem) {
        var count = parseInt(elem.find('.position-count').val());
        var price = parseFloat(elem.data('price'));
        var baseprice = parseFloat(elem.data('base-price'));
        var discount = parseFloat(elem.data('discount-price'));

        price = (price * count).toFixed(2);
        baseprice = (baseprice * count).toFixed(2);
        discount = (discount * count).toFixed(2);

        elem.find('.position-sum-price').html(price);
        elem.find('.position-full-sum-price').html(baseprice);
        elem.find('.position-discount-sum-price').html(discount);

        elem.find('.js-cartPrice-with-discount').html(number_format(price, 2, '.', ' '));
        elem.find('.js-cartPrice-without-discount').html(number_format(baseprice, 2, '.', ' '));
        elem.find('.js-cartPrice-benefit').html(number_format(discount, 2, '.', ' '));
    }

    function changePositionQuantity(productId, quantity) {
        var data = {'quantity': quantity, 'id': productId};
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: yupeCartUpdateUrl,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                } else {
                    showNotify(this, 'danger', data.data);
                }
            }
        });
    }

    /*
     * количество у продукта
    */
    // $('.product-box-quantity-increase').on('click', function () {
    $(document).delegate('.product-box-quantity-increase', 'click', function () {
        var quantityLimiterEl = $(this).parents('.spinput'),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'))
        var input = quantityLimiterEl.find('input');
        if (parseInt(input.val()) < maxQuantity) {
            input.val(parseInt(input.val()) + 1).trigger('change');
        }
        // showNotify(input, 'success', "Успешно добавлено");
    });

    // $('.product-box-quantity-decrease').on('click', function () {
    $(document).delegate('.product-box-quantity-decrease', 'click', function () {
        var quantityLimiterEl = $(this).parents('.spinput');
        var input = quantityLimiterEl.find('input');
        if (parseInt(input.val()) > 1) {
            input.val(parseInt(input.val()) - 1).trigger('change');
            // showNotify(input, 'success', "Успешно удален");
        }
    });

    $('.product-box-quantity-input').bind("keyup", function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }

        if (this.value <= 0 || isNaN(this.value)) {
            this.value = 1;
        }

        var quantityLimiterEl = $(this).parents('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (this.value < minQuantity) {
            this.value = minQuantity;
        } else if (this.value > maxQuantity) {
            this.value = maxQuantity;
        }
    });

    $(document).delegate('.product-box-quantity-addcart', 'change', function (event) {
        var el = $(this);
        quantity = parseInt(el.val());

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        var quantityLimiterEl = el.parents('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (quantity < minQuantity) {
            quantity = minQuantity;
        } else if (quantity > maxQuantity) {
            quantity = maxQuantity;
        }

        el.val(quantity);
        el.parents('.js-product-item').addClass('active').find('.js-product-but').addClass('active');

        changePositionQuantity('product_' + el.data('product-id') + '_', quantity);

        setTimeout(function () {
            el.parents('.js-product-item').removeClass('active').find('.js-product-but').removeClass('active');
        }, 600);
    });

    $('body').on('click', '.add-one-product-to-cart', function (e) {
        e.preventDefault();
        var button = $(this);
        var form = $(this).parents('form');
        button.addClass('active');
        button.parents('.js-product-item').addClass('active');
        $.ajax({
            type: 'post',
            dataType: 'html',
            data: form.serialize(),
            url: form.attr('action'),
            success: function (html) {
                $('.js-addCartModal-body').html(html);
                $('#addCartModal').modal('show');
                // if (data.result) {
                updateCartWidget();
                // moveCartProduct(button);
                // button.parent().addClass('active');
                setTimeout(function () {
                    button.removeClass('active');
                    button.parents('.js-product-item').removeClass('active');
                    button.parents('.js-product-item').find('.spinput__value').removeClass('product-box-quantity-input').addClass('product-box-quantity-addcart');
                    button.removeClass('but-animation but-svg but-svg-left add-one-product-to-cart').addClass('but-go-cart').attr('href', '/cart').find('span').html("В корзине");
                }, 600);
                // }
                // showNotify(button, data.result ? 'success' : 'danger', data.data);
            },
            // complete: function(html){
            //     console.log(html);
            // }
        });
    });

    function moveCartProduct(elem) {
        var product = elem.parents('.js-product-box-item').find("img.js-product-img");
        var leftCart = $(".header .js-shopping-cart-widget").offset().left;
        var topCart = $(".header .js-shopping-cart-widget").offset().top;

        if ($(".header-fix-content").hasClass('active')) {
            leftCart = $(".header-fix .js-shopping-cart-widget").offset().left;
            topCart = $(".header-fix .js-shopping-cart-widget").offset().top;
        }

        $(product).clone().css({
            'position': 'absolute',
            'z-index': '9999',
            'opacity': '0.5',
            top: $(product).offset().top,
            left: $(product).offset().left
        }).appendTo("body").animate({
            opacity: 0.1,
            left: leftCart,
            top: topCart,
            width: 20
        }, 1000, function () {
            $(this).remove();
        });
    }

    // $('.product-box-quantity-input').change(function (event) {
    /*$(document).delegate('.product-box-quantity-input', 'change', function(event){
        var el = $(this);
        quantity = parseInt(el.val());

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        var quantityLimiterEl = el.parents('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (quantity < minQuantity) {
            quantity = minQuantity;
        }
        else if (quantity > maxQuantity) {
            quantity = maxQuantity;
        }

        el.val(quantity);
        changePositionQuantity('product_' + el.data('product-id') + '_', quantity);
        // quantityElement.text(quantity);
        // var price = el.parents('.product-box__bottom').find('.price-result');
        // price.text(parseFloat(price.text()) * quantity)
    });*/

    // Ограничения на покупку
    function checkMinAmountFunc() {
        if (typeof minAmount === 'undefined') {
            return;
        }

        if (minAmount > getPositionsCost()) {
            $('.js-check-min-amount').removeClass('hide');
            $('.js-next-button').addClass('hide');
            $('.js-return-url').removeClass('hide');
        } else {
            $('.js-check-min-amount').addClass('hide');
            $('.js-next-button').removeClass('hide');
            $('.js-return-url').addClass('hide');
        }
    }

    /*Пказать/скрыть статичную таблицу с товарами в корзине*/
    $('.js-static-table-toggle').on('click', function () {
        var link = $(this),
            toggle = link.data('target'),
            table = $(toggle);

        link.toggleClass('active');

        table.toggle();

        return false;
    });

    /**
     * Авторизация, регистрация, модальное окно
     */
    $(document).on('submit', '#ajax-login, #ajax-registration', function (e) {
        var form = $(this),
            id = form.attr('id'),
            action = form.attr('action'),
            method = form.attr('method'),
            data = form.serialize();

        $.ajax({
            url: action,
            type: method,
            data: data,
            dataType: 'html',
            success: function (data) {
                $('#' + id).html(data);
            },
        })
        return false;
    });

    /**
     * Модуль доставка - новыый
     */

    // Вывод тарифов и способов оплаты
    $(document).on('change', 'input[name=\'Order[delivery_id]\']', function () {
        var input = $(this);
        $('.js-items-delivery_id').removeClass('active');
        input.parents('.js-items-delivery_id').addClass('active');
        $(".preloader").addClass("active");

        $.ajax({
            url: deliveryMethodUrl,
            type: 'post',
            data: input.parents('form').serialize(),
            success: function (data) {
                $('.js-delivery-method')
                    .fadeOut({
                        done: function () {
                            $(this)
                                .html(data)
                                .fadeIn();
                        }
                    });
                setTimeout(function () {
                    updateShippingCost();
                }, 500);
            },
            complete: function () {
                $(".preloader").removeClass("active");
            }
        });

        return false;
    });

    /**
     * Самовывоз
     */
    var modalMap = null;
    /*$('a[href="#pickup-modal"]')
        .fancybox({
            'animationEffect': 'fade',
            'buttons': ['zoom','close'],
            'beforeClose': function() {
                if (modalMap) {
                    modalMap.destroy();
                }
            }
        });*/
    $(document).on('click', 'a[href="#pickup-modal"]', function (e) {
        var elem = $(this);
        var modal = elem.attr('href');
        var item = elem.parents('.js-pickup-item');
        var data = item.data();
        $.each(data, function (key, value) {
            var selector = '.js-pickup-modal-' + key;
            if ($(selector).length > 0) {
                $(selector).html(value);
            }
        });

        if (data.latitude && data.longitude) {
            ymaps.ready(function () {
                modalMap = new ymaps.Map("map", {
                    center: [data.latitude, data.longitude],
                    controls: [],
                    zoom: 17
                });
                var point = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: [data.latitude, data.longitude],
                    },
                }, {
                    preset: "islands#blackDotIconWithCaption",
                    iconColor: "#00A44B",
                });
                modalMap.geoObjects.add(point);
            });
            $(modal).modal('show');
        }
        return false
    });

    var pickupItemMap;
    $(document).on('change', 'input[name="Order[pickup][]"], input[name="Order[cdek_pvz][]"]', function () {
        var elem = $(this);
        var itemContainer = elem.parents('.js-pickup-item');
        var mapContainer = itemContainer.find('.js-pickup-item__map');
        var buttonSpan = itemContainer.find('.pickup-checkbox span');
        var data = itemContainer.data();

        if (elem.prop('checked')) {
            $('input[name="Order[pickup][]"]').each(function (i, e) {
                if (elem.val() != $(e).val()) {
                    $(e)
                        .parents('.js-pickup-item')
                        .hide()
                        .find('.pickup-checkbox span')
                        .text('Забрать отсюда');
                }
            });

            buttonSpan.text('Выбрать другой');

            if (data.latitude && data.longitude) {
                mapContainer.css({'height': '150px', 'width': '100%'}).show();
                ymaps.ready(function () {
                    pickupItemMap = new ymaps.Map(mapContainer.get(0), {
                        center: [data.latitude, data.longitude],
                        controls: ['geolocationControl'],

                        zoom: 17
                    });
                    var point = new ymaps.GeoObject({
                        geometry: {
                            type: "Point",
                            coordinates: [data.latitude, data.longitude],
                        },
                    }, {
                        preset: "islands#blackDotIconWithCaption",
                        iconColor: "#00A44B",
                    });
                    pickupItemMap.geoObjects.add(point);
                });
            }

        } else {
            pickupItemMap.destroy();
            $('.js-pickup-item').each(function (i, e) {
                $(e).show();
            });
            buttonSpan.text('Забрать отсюда');
            mapContainer.css({'height': '0px', 'width': '0'}).hide();
        }
    });
    $(document).on('click', '.js-pickupModal-checkbox', function (e) {
        var elem = $(this);
        var itemContainer = elem.parents('.js-pickupModal-item');
        var id = parseInt(itemContainer.find('.js-pickup-modal-id').text());
        $('.js-pickup-item input[type="checkbox"]').prop('checked', false);
        $('.js-pickup-item[data-id="' + id + '"]').find('input[type="checkbox"]').prop("checked", true).trigger('change');
        elem.parents('.modal').modal('hide');
        return false;
    });

    $(document).on('hidden.bs.modal', '#pickup-modal', function () {
        $(".js-pickupModal-map").html('');
    });
    /**
     * Самовывоз end
     */


    /**
     * модуль СДЭК
     */
    $(document).on('change', 'input[name="Order[sub_delivery_id]"]', function () {
        var item = $(this);
        var action = item.data('action');
        var container = $('.js-sub-delivery');

        $('.js-items-sub_delivery_id').removeClass('active');
        item.parents('.js-items-sub_delivery_id').addClass('active');
        $(".preloader").addClass("active");

        // код написан только для садовода, его необходимо вынести в модуль
        var value = item.val();
        var payNal = $('input.payment-method-radio[value=2]');
        var payOnline = $('input.payment-method-radio[value=3]');
        if (value == 27040 || value == 7040) {
            payNal.attr('disabled', false);
            payOnline.attr('disabled', true);
            payNal.click();
        } else {
            payNal.attr('disabled', true);
            payOnline.attr('disabled', false);
            payOnline.click();
        }

        $.ajax({
            url: action,
            type: 'post',
            // dataType: 'json',
            data: item.parents('form').serialize(),
            success: function (data) {
                container.html(data);
            },
            complete: function () {
                $(".preloader").removeClass("active");
            }
        });
    });

    /**
     * Модуль доставка - новыый end
     */


    function number_format(number, decimals, dec_point, separator) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof separator === 'undefined') ? ',' : separator,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k).toFixed(prec);
            };
        // Фиксим баг в IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
});
