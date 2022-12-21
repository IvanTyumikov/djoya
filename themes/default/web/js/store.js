function showNotify(element, result, message) {
    $('#notifications')
        .html('<div class="notifications-' + result + '">' + message + '</div>')
        .fadeIn()
        .delay(1000)
        .fadeOut();
}

$(document).ready(function () {
    var cartWidgetSelector = '#shopping-cart-widget';
    var cartWidgetSelector2 = '#shopping-cart-widget2';

    /*страница продукта*/
    var priceElement = $('#result-price'); //итоговая цена на странице продукта
    var basePrice = parseFloat($('#base-price').val()); //базовая цена на странице продукта
    var quantityElement = $('#product-quantity');
    var quantityInputElement = $('#product-quantity-input');

    /*корзина*/

    var shippingCostElement = $('#cart-shipping-cost');
    var cartFullCostElement = $('#cart-full-cost');
    var cartFullCostWithShippingElement = $('#cart-full-cost-with-shipping');

    // Смена изображений при наведении
    var jsImageHover = function () {
        var parent = $(this).parents('.js-product-item');
        var src = $(this).data('src');
        var srcset = $(this).data('srcset');
        var key = $(this).data('key');

        parent.find('.js-product-image img').attr('src', src);
        parent.find('.js-product-image source').attr('srcset', srcset);
        parent.find('.js-item-image-dots').removeClass('active');
        parent
            .find('.js-item-image-dots[data-key=' + key + ']')
            .addClass('active');
    };

    $('.js-image-lists').hover(jsImageHover);

    /*******************************************/
    /* Фильтры                                 */
    /*******************************************/
    // Сортировка товаров
    $(document).delegate('.js-sort-box', 'click', function (e) {
        $(this).addClass('active');
    });

    $(document).delegate('body', 'click', function (e) {
        if ($(e.target).parents('.js-sort-box').length < 1) {
            $('.js-sort-box').removeClass('active');
        }
    });

    $(document).delegate('.sort-box__list', 'click', function () {
        var elem = $(this),
            elemValue = elem.html();
        $('.product__items').addClass('list-view-loading');
        $.ajax({
            type: 'GET',
            url: elem.attr('data-href'),
            success: function (data) {
                $('.product__items').html(
                    $(data).find('.product__items').html()
                );
                $('.sort-box__lists').html(
                    $(data).find('.sort-box__lists').html()
                );
                $('.product__items').removeClass('list-view-loading');

                elem.addClass('active');

                $('.js-sort-box').find('#sort-box-value').html(elemValue);
                $('.js-sort-box').removeClass('active');
                $('.js-image-lists').hover(jsImageHover);
            },
        });
        return false;
    });

    // product variant
    $(document).delegate(
        '.js-product-variant .product-variant__value',
        'click',
        function (e) {
            $(this).parent().addClass('active');
        }
    );

    $(document).delegate('body', 'click', function (e) {
        if ($(e.target).parents('.js-product-variant').length < 1) {
            $('.js-product-variant').removeClass('active');
        }
    });

    $(document).delegate('.js-variant-price', 'click', function () {
        var elem = $(this),
            elemValue = elem.find('.value').html();

        $('.js-product-variant')
            .find('.product-variant__value > .value')
            .html(elemValue);
        $('.js-product-variant').removeClass('active');
    });

    //Показать еще атрибуты
    $(document).delegate('.js-load-attribute', 'click', function () {
        var elem = $(this),
            link = elem.attr('data-action-attribute'),
            data = {
                productView: 'attribute',
                YUPE_TOKEN: yupeToken,
            };

        elem.addClass('loading');

        $.ajax({
            type: 'post',
            url: link,
            data: data,
            success: function (data) {
                elem.parents('.wg-product-attr').html($(data).html());
                elem.removeClass('loading');
            },
        });
        return false;
    });

    // $('.js-product-item-image').slick({
    //   fade: false,
    //   infinite: true,
    //   slidesToShow: 1,
    //   slidesToScroll: 1,
    //   autoplay: false,
    //   speed: 200,
    //   dots: true,
    //   arrows: false,
    //   responsive: [
    //     {
    //       breakpoint: 1200,
    //       settings: {
    //         slidesToShow: 1,
    //       },
    //     },
    //   ],
    // });

    // Выбор количества товаров на странице
    $(document).delegate('.js-items-count', 'click', function () {
        $(this).toggleClass('active');
    });

    $(document).delegate('body', 'click', function (e) {
        if ($(e.target).parents('.js-items-count').length < 1) {
            $('.js-items-count').removeClass('active');
        }
    });

    // Клик, чтобы изменить шаблон вывода количества товаров
    $(document).delegate('.items-count__list', 'click', function () {
        var elem = $(this);
        setCookie('store_count', elem.data('count'), { path: '/' });
        $('.items-count__list').removeClass('active');
        elem.addClass('active');
        filterUpdate(elem);
        return false;
    });

    /*
     *  Рейтинг
     */
    $(document).delegate(
        '.raiting-list-form .raiting-list__item',
        'click',
        function () {
            var $this = $(this);
            var value = $this.data('text');
            var id = $this.data('id');
            $('.raiting-list-form .raiting-list__item').removeClass('active');
            $this
                .addClass('active')
                .prevAll('.raiting-list__item')
                .addClass('active');
            $('#js-raiting-val-text').text(value);
            $this.parent().addClass('no-hover');
            $('#Review_rating').val(id);
            return false;
        }
    );

    /*********************************************************************/
    /*                     RANGE SLIDER TO PRICE                         */
    /*********************************************************************/
    var $rangeprice = $('#js-range-price'),
        $fromprice = $('.js-from-price'),
        $toprice = $('.js-to-price'),
        my_range_price,
        minprice = $('#js-range-price').data('min'),
        maxprice = $('#js-range-price').data('max'),
        fromprice,
        toprice;

    var updateValuesprice = function () {
        $fromprice.prop('value', fromprice);
        $toprice.prop('value', toprice);
    };

    if ($rangeprice.length > 0) {
        $rangeprice.ionRangeSlider({
            onStart: function (data) {
                fromprice = data.from;
                toprice = data.to;

                // updateValuesprice();
            },
            onChange: function (data) {
                fromprice = data.from;
                toprice = data.to;

                updateValuesprice();
            },
            onFinish: function (data) {
                fromprice = data.from;
                toprice = data.to;

                updateValuesprice();
                filterUpdate();
            },
        });

        my_range_price = $rangeprice.data('ionRangeSlider');

        var updateRangeprice = function () {
            my_range_price.update({
                from: fromprice,
                to: toprice,
            });
        };

        $fromprice.focusout(function (event) {
            // $(document).delegate(\$fromprice, 'keyup', function(e){
            fromprice = +$(this).prop('value');
            if (fromprice < minprice) {
                fromprice = minprice;
            }
            if (fromprice > toprice) {
                fromprice = toprice;
            }

            updateValuesprice();
            updateRangeprice();
        });

        $toprice.focusout(function (event) {
            // $(document).delegate(\$toprice, 'keyup', function(e){
            toprice = +$(this).prop('value');
            if (toprice > maxprice) {
                toprice = maxprice;
            }
            if (toprice < fromprice) {
                toprice = fromprice;
            }

            updateValuesprice();
            updateRangeprice();
        });
    }

    $('.filter-price').keypress(function (e) {
        console.log(e);
        if (e.which == 13) {
            filterUpdate();
        }
    });

    /*********************************************************************/
    /*                         RANGE SLIDR END                           */
    /*********************************************************************/

    /*********************************************************************/
    /*                         Карточка товара                           */
    /*********************************************************************/
    //Загружаю изображения по выбранному цвету в карточке товара
    $(document).delegate('.js-product-info-color', 'click', function () {
        var elem = $(this),
            url = elem
                .parents('.product-info-color')
                .data('action-images-color'),
            productId = elem.data('product-id'),
            optionValue = elem.data('option-value'),
            view = 'images-product',
            optionName = elem.data('option-name');

        elem.parents('.product-info-color')
            .find('.js-product-info-color')
            .removeClass('active');

        $('#thumbnails').addClass('loading');

        $.ajax({
            type: 'post',
            url,
            data: { view, productId, optionValue, YUPE_TOKEN: yupeToken },
            success: function (data) {
                elem.addClass('active');
                elem.parents('.product-info-color')
                    .find('.product-info-color__value')
                    .html(optionName);
                elem.parents('.product-view').find('.thumbnails').html(data);
                elem.parents('.product-view')
                    .find('.product-info__variants-hidden-filds input')
                    .prop('checked', false);
                elem.parents('.product-view')
                    .find(
                        '.product-info__variants-hidden-filds input[data-atribute-id=' +
                            optionValue +
                            ']'
                    )
                    .prop('checked', true);
                slickImagesProductInit();

                setTimeout(function () {
                    slickImagesThumbProductInit();
                    $('#thumbnails').removeClass('loading');
                }, 100);
            },
        });
    });

    //Смена изображений в карточке товара по цвету
    slickImagesProductInit();
    slickImagesThumbProductInit();

    // Связать миниатюры и главные изображения slick-ом
    function slickImagesProductInit() {
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
            prevArrow:
                '<span class="icon-prev slick-arrow"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.917 19.6803L15.5767 19.0252C15.7827 18.819 15.8962 18.5447 15.8962 18.2515C15.8962 17.9585 15.7827 17.6839 15.5767 17.4777L8.10309 10.0045L15.5849 2.52262C15.791 2.31677 15.9043 2.04213 15.9043 1.74912C15.9043 1.45611 15.791 1.18131 15.5849 0.975293L14.9293 0.320003C14.503 -0.106668 13.8085 -0.106668 13.3822 0.320003L4.44209 9.22804C4.23623 9.4339 4.09119 9.70821 4.09119 10.0038V10.0072C4.09119 10.3004 4.2364 10.5747 4.44209 10.7806L13.3579 19.6803C13.5638 19.8865 13.8464 19.9997 14.1394 20C14.4326 20 14.7113 19.8865 14.917 19.6803Z" fill="#757575"/></svg></span>',
            nextArrow:
                '<span class="icon-next slick-arrow"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.08303 0.319677L4.42335 0.974806C4.21733 1.18099 4.10383 1.4553 4.10383 1.74847C4.10383 2.04148 4.21733 2.31612 4.42335 2.5223L11.8969 9.99553L4.41506 17.4774C4.20904 17.6832 4.0957 17.9579 4.0957 18.2509C4.0957 18.5439 4.20904 18.8187 4.41506 19.0247L5.07067 19.68C5.49702 20.1067 6.19149 20.1067 6.61784 19.68L15.5579 10.772C15.7638 10.5661 15.9088 10.2918 15.9088 9.99618V9.99276C15.9088 9.69959 15.7636 9.42528 15.5579 9.21942L6.64207 0.319677C6.43621 0.113497 6.15361 0.000326157 5.8606 0C5.56742 0 5.28872 0.113497 5.08303 0.319677Z" fill="#757575"/></svg></span>',
        });
    }

    function slickImagesThumbProductInit() {
        $('.thumbnails-small')
            .not('.slick-initialized')
            .slick({
                infinite: false,
                autoplay: false,
                dots: false,
                arrows: false,
                speed: 100,
                slidesToShow: 3,
                asNavFor: '.js-thumbnails-preview-slider',
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 577,
                        settings: {
                            slidesToShow: 3,
                            arrows: false,
                            vertical: false,
                        },
                    },
                ],
            });
    }

    // zoom товара в карточке товара
    // function zoomProductView(){
    //     if(window.innerWidth > 991){
    //         $('.js-product-zoom').zoom({ on:'mouseover' });
    //     }
    // }

    // zoomProductView();
    // $('.product-list-big-preview__img').zoom({ on:'grab' });

    //Поделиться в социальных сетях
    $(document).delegate('.js-sharing-show', 'click', function () {
        $(this).parent().toggleClass('active');
    });

    $(document).mouseup(function (e) {
        var container = $('.sharing');
        if (container.has(e.target).length === 0) {
            container.removeClass('active');
        }
    });

    /*********************************************************************/
    /*                         Карточка товара END                       */
    /*********************************************************************/

    // кнопка (Показать весь заказ) в корзине
    $(document).delegate('.js-cart-sidebar-more', 'click', function (e) {
        var dataText = $(this).find('span').attr('data-text');

        if ($(this).parent().find('.cart-sidebar-info').hasClass('show')) {
            $(this)
                .parent()
                .find('.cart-sidebar-info.show')
                .addClass('hidden')
                .removeClass('show');
        } else {
            $(this)
                .parent()
                .find('.cart-sidebar-info.hidden')
                .addClass('show')
                .removeClass('hidden');
        }

        $(this).find('span').attr('data-text', $(this).find('span').text());
        $(this).find('span').text(dataText);

        return false;
    });

    /*
     * фильтры при адаптации
     */
    $(document).delegate('.button-mobile-filter', 'click', function () {
        $('.catalog-content__sidebar').addClass('active');
        return false;
    });

    $(document).delegate('.sidebar-box__close', 'click', function () {
        $('.catalog-content__sidebar').removeClass('active');
        return false;
    });

    // $(document).delegate('.sidebar-box', 'click', function(e) {
    $('.catalog-content__sidebar').on('click', function (e) {
        if ($(e.target).hasClass('active')) {
            $('.catalog-content__sidebar').removeClass('active');
            $('.button-mobile-filter').removeClass('active');
            return false;
        }
    });

    /*
     * Действия при изменении окна
     */
    $(window).resize(function () {
        var innerWidth = window.innerWidth;
        if (innerWidth > 1240) {
            $('.menu-fix__icon-close').removeClass('active');
            $('.menu-fix__icon-menu').removeClass('no-active');
            $('body').removeClass('bodymenu');
            // $('html').removeClass('htmlmenu');
            $('.menu-fix').removeClass('active');
            $('.menu-fix__box')
                .css({
                    display: '',
                    left: '',
                })
                .removeClass('active');
            $('.sidebar-box').removeClass('active');
            $('#store-filter').removeClass('active');
        }

        if (innerWidth < 991) {
            getTemplateProduct();
        }

        if ($('div').hasClass('lazySlideImg')) {
            $('.lazySlideImg').each(function () {
                lazySlideImg($(this));
            });
        }
    });

    /* Вызываем функцию при загрузке сайта  */
    var innerWidth = window.innerWidth;

    if (innerWidth < 991) {
        getTemplateProduct();
    }

    /* Функция определения шаблона на вывод товаров */
    function getTemplateProduct() {
        var box = $('.template-product__item.active');
        if (
            box.data('view') == '_item-list' ||
            box.data('view') == '_item-list-big'
        ) {
            $('.template-product__item').addClass('active');
            box.removeClass('active');
            setCookie('store_item', '_item', { path: '/' });
            setTimeout(filterUpdate(), 3000);
        }
    }

    /* Клик, чтобы изменить шаблон вывода товаров */
    $(document).delegate('.template-product__item', 'click', function () {
        setCookie('store_item', $(this).data('view'), { path: '/' });
        $('.template-product__item').removeClass('active');
        $(this).addClass('active');
        filterUpdate();
        return false;
    });

    /* Функция для обновления списка - примененных фильтров */
    function filterUpdate(elem = null) {
        var form = $('#store-filter'),
            top = $('.filter').offset().top - 50,
            data = form.serialize();

        history.pushState(null, location.title, location.pathname + '?' + data);

        if (data == '') {
            data = {};
        }
        $('.product__items').addClass('ajax-load');

        $.fn.yiiListView.update('product-box', {
            data: data,
            url: '',
            enableHistory: true,
            complete: function (data) {
                var filter_search = $(data.responseText)
                    .find('.filter__search')
                    .html();
                var sort_box = $(data.responseText)
                    .find('.sort-box__lists')
                    .html();
                $('.filter__search').html(filter_search);
                $('.sort-box__lists').html(sort_box);

                $('.ajax-loading').delay(100).fadeOut(500);

                $('body,html').animate(
                    {
                        scrollTop: top + 'px',
                    },
                    400
                );

                $('.catalog-content__sidebar').removeClass('active');

                // Обновляем zoom у изображений продуктов
                $('.js-product-zoom').zoom({ on: 'mouseover' });
                $('.product-list-big-preview__img').zoom({ on: 'grab' });
                $('.js-image-lists').hover(jsImageHover);
            },
        });
        return false;
    }

    /*****************************/
    /*  Рейтинг                  */
    /*****************************/

    /*************************************/
    /*  Фильтры у товаров                */
    /*************************************/
    /* Скрыть/показать блок фильтры */
    $(document).delegate('.filter-block__header', 'click', function (e) {
        var parent = $(this).parents('.filter-block');
        $(this).toggleClass('no-active');

        if (
            parent.find('.filter-block__body').attr('class') ==
            'filter-block__body filter-block__attribute'
        ) {
            setTimeout(function () {
                parent.find('.filter-block__body').toggle();
            }, 300);
        } else {
            parent.find('.filter-block__body').toggle();
        }

        setTimeout(function () {
            parent.find('.filter-block__body').toggleClass('no-active');
        }, 100);

        return false;
    });

    $(document).delegate(
        '#store-filter input[type=checkbox]',
        'change',
        function (e) {
            filterUpdate();
            return false;
        }
    );

    $(document).delegate(
        '#store-filter input[type=radio]',
        'change',
        function (e) {
            filterUpdate();
            return false;
        }
    );

    /* Клик по постраничной навигации */
    $(document).delegate('#product-box .pagination li a', 'click', function () {
        // $('.ajax-loading').fadeIn(500);
        var top = $('.filter').offset().top - 50;
        $('body,html').animate(
            {
                scrollTop: top + 'px',
            },
            400
        );
        // $('.ajax-loading').delay(100).fadeOut(500);

        setTimeout(function () {
            $('.js-image-lists').hover(jsImageHover);
        }, 1000);
    });

    /* Функция для обновления sliderRange */
    function rangeInputUpdate() {
        $('.js-range').each(function () {
            var slider = $('#' + $(this).attr('id')).data('ionRangeSlider');
            slider.update({
                from: 0,
                to: $(this).data('max'),
            });
        });
    }

    // Клик по плюсу
    $(document).delegate('.product-quantity-increase', 'click', function () {
        var elem = $(this);
        var parent = elem.parent();
        var input = parent.find('.product-quantity-input');
        input.val(parseInt(input.val()) + 1).trigger('change');
        updateSummPrice(elem);
    });

    // Клик по минусу
    $(document).delegate('.product-quantity-decrease', 'click', function () {
        var elem = $(this);
        var parent = elem.parent();
        var input = parent.find('.product-quantity-input');
        if (parseInt(input.val()) > 1) {
            input.val(parseInt(input.val()) - 1).trigger('change');
            updateSummPrice(elem);
        }
    });

    //Изменение суммарной цены в зависимости от выбранного кол-ва элементов и варианта веса
    function updateSummPrice(elem) {
        var parents = elem.parents('form');
        var input = parents.find('.product-quantity-input');
        var productTotal = parents.find('#result-price .value');
        var priceTotal = parents.find('#result-price').data('price');
        var priceTotalWithSpaces = numberWithSpaces(
            parseFloat((input.val() * priceTotal).toFixed(0))
        );

        productTotal.html(priceTotalWithSpaces);
    }

    $('.product-variant input[type="radio"]').click(function () {
        updatePrice();
    });

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
    });

    var flag = false;

    $('body').on('click', '#add-product-to-cart', function (e) {
        e.preventDefault();
        var button = $(this);
        var form = $(this).parents('form');
        console.log(flag);
        if (!flag) {
            flag = true;
            console.log(flag);
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: form.serialize(),
                url: form.attr('action'),
                success: function (data) {
                    if (data.result) {
                        updateCartWidget();
                    }
                    showNotify(
                        button,
                        data.result ? 'success' : 'danger',
                        data.data
                    );
                    setTimeout(() => {
                        flag = false;
                        console.log(flag);
                    }, 1000);
                },
            });
        }
    });

    $('body').on('click', '.quick-add-product-to-cart', function (e) {
        e.preventDefault();
        var el = $(this);
        var data = { 'Product[id]': el.data('product-id') };
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
            },
        });
    });

    //Плюс - МИнус в корзине
    $('.cart-quantity-increase').click(function () {
        var target = $($(this).data('target'));
        target.val(parseInt(target.val()) + 1).trigger('change');
    });

    $('.cart-quantity-decrease').click(function () {
        var target = $($(this).data('target'));
        if (parseInt(target.val()) > 1) {
            target.val(parseInt(target.val()) - 1).trigger('change');
        }
    });

    /* Функционал магазина */
    function updatePrice() {
        var _basePrice = basePrice;
        var variants = [];
        var varElements = $('.product-variant input[type="radio"]:checked');

        /* выбираем вариант, меняющий базовую цену максимально*/
        var hasBasePriceVariant = false;
        $.each(varElements, function (index, elem) {
            var varId = elem.value;

            if (varId) {
                var variant = {
                    amount: $(elem).data('amount'),
                    type: $(elem).data('type'),
                };
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
                var variant = {
                    amount: $(elem).data('amount'),
                    type: $(elem).data('type'),
                };
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

        var quantityInput = $('#product-quantity-input').val();
        var priceWithSpaces = numberWithSpaces(
            parseFloat(newPrice.toFixed(2)) * quantityInput
        );

        // numberAnimate($('#result-price .value'), priceFrom, priceWithSpaces, 500);

        priceElement.find('.value').html(priceWithSpaces);
        priceElement.attr('data-price', parseFloat(newPrice.toFixed(2)));
    }

    quantityElement.change(function (event) {
        var el = $(this);
        quantity = parseInt(el.val());

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        el.val(quantity);
    });

    function updateCartWidget() {
        $(cartWidgetSelector).load($('#cart-widget').data('cart-widget-url'));
        // $(cartWidgetSelector2).load($('#cart-widget').data('cart-widget-url'));
    }

    /*cart*/
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
                free_shipping: $elem.data('free-shipping'),
            });
        });

        return coupons;
    }

    function updatePositionSumPrice(tr) {
        var count = parseInt(tr.find('.position-count').val());
        var price = parseFloat(tr.find('.position-price').text());
        tr.find('.js-position-sum-price').html(
            Math.round(price * count).toFixed(0)
        );
        updateCartTotalCost();
    }

    function changePositionQuantity(productId, quantity) {
        var data = { quantity: quantity, id: productId };
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: yupeCartUpdateUrl,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                }
            },
        });
    }

    //удаление товара из корзины
    $('.cart-delete-product').click(function (e) {
        e.preventDefault();
        let el = $(this);
        let data = { id: el.data('position-id') };
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: yupeCartDeleteProductUrl,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    el.parents('.cart-info__row').remove();
                    updateCartTotalCost();
                    if ($('.cart-info__row').length > 0) {
                        updateCartWidget();
                    } else {
                        updateCartWidget();
                        $('.cart-index__main').html(yupeCartEmptyMessage);
                    }
                }
            },
        });
    });

    $('.position-count').change(function () {
        var el = $(this).parents('.cart-info__row'),
            positionCountEl = el.find('.position-count');
        positionCountEl2 = el.find('.position-count2');

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
        positionCountEl2.html(quantity);

        var priceOneProduct = el.find('.js-position-price').html();
        var elTotalPrice = el.find('.js-position-sum-price');

        elTotalPrice.html(Math.round(quantity * priceOneProduct).toFixed(1));

        updatePositionSumPrice(el);
        changePositionQuantity(productId, quantity);
    });

    $(document).delegate(
        'input[name="Order[delivery_id]"]',
        'change',
        function () {
            console.log(updateShippingCost());
            updateShippingCost();
        }
    );

    function getCartTotalCost() {
        var cost = 0;
        $.each($('.position-sum-price'), function (index, elem) {
            cost += parseFloat($(elem).text());
        });
        let delta = 0;
        let coupons = getCoupons();

        $.each(coupons, function (index, el) {
            if (cost >= el.min_order_price) {
                switch (el.type) {
                    case 0: // руб
                        delta += parseFloat(el.value).toFixed(0);
                        break;
                    case 1: // %
                        delta +=
                            (parseInt(el.value) / 100).toFixed(2) *
                            cost.toFixed(2);
                        break;
                }
            }
        });

        return delta > cost ? 0 : cost - delta;
    }

    function updateCartTotalCost() {
        cartFullCostElement.html(getCartTotalCost());
        refreshDeliveryTypes();
        updateShippingCost();
        updateFullCostWithShipping();
    }

    function refreshDeliveryTypes() {
        var cartTotalCost = getCartTotalCost();
        $.each($('input[name="Order[delivery_id]"]'), function (index, el) {
            var elem = $(el);
            var availableFrom = elem.data('available-from');
            if (
                availableFrom.length &&
                parseFloat(availableFrom) >= cartTotalCost
            ) {
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
        $('input[name="Order[delivery_id]"]:not(:disabled):first').prop(
            'checked',
            true
        );
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
        var selectedDeliveryType = $(
            'input[name="Order[delivery_id]"]:checked'
        );
        if (!selectedDeliveryType[0]) {
            return 0;
        }
        if (
            parseInt(selectedDeliveryType.data('separate-payment')) ||
            parseFloat(selectedDeliveryType.data('free-from')) <= cartTotalCost
        ) {
            return 0;
        } else {
            return parseFloat(selectedDeliveryType.data('price'));
        }
    }

    function updateShippingCost() {
        shippingCostElement.html(getShippingCost());
        updateFullCostWithShipping();
    }

    function updateFullCostWithShipping() {
        cartFullCostWithShippingElement.html(
            getShippingCost() + getCartTotalCost()
        );
    }

    refreshDeliveryTypes();
    //checkFirstAvailableDeliveryType();
    //updateFullCostWithShipping();
    //updateCartTotalCost();

    function updateAllCosts() {
        updateCartTotalCost();
    }

    checkFirstAvailableDeliveryType();
    updateAllCosts();

    $('#start-payment').on('click', function () {
        $('.payment-method-radio:checked')
            .parents('.payment-method')
            .find('form')
            .submit();
    });

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
            },
        });
    });

    /*Оборачиваем таблицы в статьях*/
    $('#post table').each(function () {
        $(this).wrap('<div class="blog-table">');
    });
    /*Оборачиваем таблицы в статьях*/

    if ($('.coupons-list__item').html() != undefined) {
        var couponAdded = true;
    } else {
        var couponAdded = false;
    }

    $('#add-coupon-code').click(function (e) {
        e.preventDefault();
        var code = $('#coupon-code').val();
        var button = $(this);
        if (couponAdded && $('#coupon-code').val() != '') {
            showNotify(button, 'not-add', 'Вы уже добавили купон к заказу');
            return false;
        }
        if (code) {
            var data = { code: code };
            data[yupeTokenName] = yupeToken;
            $.ajax({
                url: '/coupon/add',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.result) {
                        window.location.reload();
                        couponAdded = true;
                    }
                    showNotify(
                        button,
                        data.result ? 'success' : 'danger',
                        data.data
                    );
                },
            });
            $('#coupon-code').val('');
        }
    });

    $('.coupon .close').click(function (e) {
        e.preventDefault();
        var code = $(this).siblings('input[type="hidden"]').data('code');
        var data = { code: code };
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: '/coupon/remove',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                showNotify(this, data.result ? 'success' : 'danger', data.data);
                if (data.result) {
                    updateAllCosts();
                    couponAdded = false;
                }
            },
        });
    });

    $('#coupon-code').keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#add-coupon-code').click();
        }
    });

    $('.order-form').submit(function () {
        $(this).find("button[type='submit']").prop('disabled', true);
    });
});

// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
    var matches = document.cookie.match(
        new RegExp(
            '(?:^|; )' +
                name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') +
                '=([^;]*)'
        )
    );
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == 'number' && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + '=' + value;

    for (var propName in options) {
        updatedCookie += '; ' + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += '=' + propValue;
        }
    }

    document.cookie = updatedCookie;
}

/***************************************************************************/
/*                         Вспомогательные функции                         */
/***************************************************************************/
//Анимация числа при его изменении
function numberAnimate(elem, from, to, duration) {
    var start = new Date().getTime();

    setTimeout(function () {
        var now = new Date().getTime() - start,
            progress = now / duration,
            result = Math.floor((to - from) * progress + from);

        elem.html(progress < 1 ? result : to);
        if (progress < 1) setTimeout(arguments.callee, 10);
    }, 5);
}

// функция разделения числа на разряды
function numberWithSpaces(x) {
    var parts = x.toString().split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    return parts.join('.');
}

//Функция изменения url адреса
function ChangeUrl(page, url) {
    var obj = { Page: page, Url: url };
    history.pushState(obj, obj.Page, obj.Url);
}
