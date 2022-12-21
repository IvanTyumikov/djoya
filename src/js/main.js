$(document).ready(function () {
    /**********************************************/
    /* Ajax на формах                             */
    /**********************************************/
    $('form[data-type="ajax-form"]').on('click', function (event) {
        var elem = event.target;
        var dataSend = elem.getAttribute('data-send');
        if (dataSend == 'ajax') {
            var button = $(elem),
                form = button.parents('form'),
                type = form.attr('method'),
                formId = form.attr('id');

            if (form.hasClass('js-form-file')) {
                var data = new FormData(form.get(0));

                button.addClass('loader');

                $.ajax({
                    type: type,
                    data: data,
                    enctype: 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    async: false,
                    cache: false,
                    success: function (html) {
                        var newForm = $(html).find('#' + formId);

                        $('#' + formId).html(newForm.html());

                        button.removeClass('loader');

                        fileUploadDragOnDrop();

                        if (
                            $('#' + formId)
                                .find('input[data-mask=phone]')
                                .is('.data-mask')
                        ) {
                            $('#' + formId)
                                .find('input[data-mask=phone]')
                                .mask('+7(999)999-99-99', {
                                    placeholder: '_',
                                    completed: function () {},
                                });
                        }

                        if (
                            $('#' + formId)
                                .find('input[data-phoneMask="phone"]')
                                .is('.phone-mask')
                        ) {
                            $('.phone-mask').inputmask('+7(999)999-99-99', {
                                inputmode: 'numeric',
                            });
                        }

                        $.getScript(
                            'https://www.google.com/recaptcha/api.js',
                            function () {}
                        );
                    },
                });
            } else {
                form.addClass('loader');
                $.ajax({
                    type: type,
                    data: form.serialize(), //formData,
                    dataType: 'html',
                    success: function (html) {
                        var newForm = $(html).find('#' + formId);

                        form.removeClass('loader');

                        $('#' + formId).html(newForm.html());

                        if (
                            $('#' + formId)
                                .find('input[data-mask="phone"]')
                                .is('.data-mask')
                        ) {
                            $('#' + formId)
                                .find('input[data-mask="phone"]')
                                .mask('+7(999)999-99-99', {
                                    placeholder: '_',
                                    completed: function () {
                                        //console.log("ok");
                                    },
                                });
                        }
                        if (
                            $('#' + formId)
                                .find('input[data-phoneMask="phone"]')
                                .is('.phone-mask')
                        ) {
                            $('.phone-mask').inputmask('+7(999)999-99-99', {
                                inputmode: 'numeric',
                            });
                        }

                        $.getScript(
                            'https://www.google.com/recaptcha/api.js',
                            function () {}
                        );
                    },
                });
            }

            return false;
        }
    });

    $('.phone-mask').inputmask('+7(999)999-99-99', { inputmode: 'numeric' });

    // Читать весь текст - раскрытие текта
    $(document).delegate('.js-content-read-more', 'click', function (e) {
        e.preventDefault();
        var content = $(this).parent().find('.content-with-read-more-link');

        $(this).toggleClass('active');
        content.toggleClass('more-content');

        if ($(this).hasClass('active')) {
            $(this).find('span').html($(this).attr('data-hide'));
        } else {
            $(this).find('span').html($(this).attr('data-show'));
        }
    });

    // закрытие модального окна успешной отправки формы
    $('.message-modal__close').on('click', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation;

        var $this = $(this),
            modal = $($this).data('modal');

        $(modal).removeClass('open');
        setTimeout(function () {
            $('.message-modal').unwrap('.overlay');
            $(modal).parents('.overlay').removeClass('open');
        }, 350);
    });

    // загружать капчу при клике на кнопку открытия модального окна
    $('.repeat_captha').on('click', function () {
        var head = document.getElementsByTagName('head')[0];
        var script = document.createElement('script');

        $.getScript('https://www.google.com/recaptcha/api.js', function () {});
        head.appendChild(script);

        $('.repeat_captha').off('click');
    });

    // карусель block
    $('.js-block-slider').slick({
        fade: false,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 900,
        speed: 500,
        dots: false,
        arrows: true,
        prevArrow: prevArrow,
        nextArrow: nextArrow,
        responsive: [
            {
                breakpoint: 1530,
                settings: {
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                },
            },
        ],
    });

    // карусель prev
    $('.js-prev-slider').slick({
        fade: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 900,
        speed: 500,
        dots: false,
        arrows: true,
        prevArrow: prevArrow,
        nextArrow: nextArrow,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    dots: false,
                },
            },
        ],
    });

    // карусель сертификатов
    $('.js-sertificat-slider').slick({
        fade: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 900,
        speed: 500,
        dots: false,
        arrows: true,
        prevArrow: prevArrow,
        nextArrow: nextArrow,
        responsive: [
            {
                breakpoint: 1530,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                },
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                },
            },
        ],
    });

    // карусели
    $('.js-video-slider').slick({
        fade: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 900,
        speed: 500,
        dots: false,
        arrows: true,
        prevArrow: prevArrow,
        nextArrow: nextArrow,
    });

    $('.js-review-slider')
        .not('.slick-initialized')
        .slick({
            fade: false,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: false,
            speed: 800,
            dots: false,
            arrows: true,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });

    $('.js-review-slider-product')
        .not('.slick-initialized')
        .slick({
            fade: false,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: false,
            speed: 800,
            dots: false,
            arrows: true,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            responsive: [
                {
                    breakpoint: 1780,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    },
                },
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });

    $('.js-review-slider-stories-2')
        .not('.slick-initialized')
        .slick({
            fade: false,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            autoplay: false,
            speed: 800,
            dots: false,
            arrows: true,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            responsive: [
                {
                    breakpoint: 1550,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    },
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });

    $('.js-review-slider-stories')
        .not('.slick-initialized')
        .slick({
            fade: false,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: false,
            speed: 800,
            dots: false,
            arrows: true,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            responsive: [
                {
                    breakpoint: 1550,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });

    $('.js-category-view-slider')
        .not('.slick-initialized')
        .slick({
            fade: false,
            infinite: false,
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: false,
            speed: 800,
            dots: false,
            arrows: true,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            responsive: [
                {
                    breakpoint: 1780,
                    settings: {
                        slidesToShow: 5,
                    },
                },
                {
                    breakpoint: 1440,
                    settings: {
                        slidesToShow: 4,
                    },
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                    },
                },
            ],
        });

    // Обновление списка продуктов при выборе категории на главной
    $(document).delegate(
        '.pop-categories input[type=checkbox]',
        'change',
        function (e) {
            $('.pop-categories input[type=checkbox]').prop('checked', false);
            $(this).prop('checked', true);
            filterUpdate();
        }
    );

    // Обновить список товаров через ajax
    function filterUpdate() {
        var form = $('#pop-categories-filter'),
            data = form.serialize();
        if (data == '') {
            data = {};
        }

        $('.ajax-loading').fadeIn(500);

        $.ajax({
            type: 'get',
            data: data,
            success: function (data) {
                $('#project-list').html($(data).find('#project-list').html());
                $('.ajax-loading').delay(100).fadeOut(500);
                slickInit();
            },
        });
    }

    slickInit();

    // Переинициализация slick
    function slickInit() {
        $('.js-pr-slider')
            .not('.slick-initialized')
            .slick({
                fade: false,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                autoplay: false,
                speed: 800,
                dots: false,
                arrows: true,
                prevArrow: prevArrow,
                nextArrow: nextArrow,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        },
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
    }

    // мобильная менюшка
    $('.app').click(function () {
        event.stopPropagation();
        $('.mobile').toggleClass('active');
        $('.app').toggleClass('open');
        $('.wrapper').toggleClass('mobile-open');
        $('body').toggleClass('mobile-open-open');
    });

    $('.mobile__close').click(function () {
        event.stopPropagation();
        $('.mobile').removeClass('active');
        $('.app').removeClass('open');
        $('.wrapper').removeClass('mobile-open');
        $('body').removeClass('mobile-open-open');
    });

    $('.mobile').on('click', function (e) {
        if (
            $(e.target).hasClass('mobile') ||
            $(e.target).hasClass('mobile__close') ||
            $(e.target).parents('.mobile__close').length > 0
        ) {
            $('.mobile').removeClass('active');
            $('.app').removeClass('open');
            $('.wrapper').removeClass('mobile-open');
            $('body').removeClass('mobile-open-open');
        }
    });

    // ленивая загрузка изображений
    [].forEach.call(document.querySelectorAll('img[data-src]'), function (img) {
        img.setAttribute('src', img.getAttribute('data-src'));
        img.onload = function () {
            img.removeAttribute('data-src');
        };
    });

    [].forEach.call(
        document.querySelectorAll('source[data-webp]'),
        function (source) {
            source.setAttribute('srcset', source.getAttribute('data-webp'));
            source.removeAttribute('data-webp');
        }
    );

    // чтобы не прыгал скролл при открытии модалок
    $('.modal').on('show.bs.modal', function () {
        var $bodyWidth = $('body').width();
        $('body')
            .css({ 'overflow-y': 'hidden' })
            .css({ 'padding-right': $('body').width() - $bodyWidth });
    });

    $('.modal').on('hidden.bs.modal', function () {
        $('body').css({ 'padding-right': '0', 'overflow-y': 'auto' });
    });

    // Переключение изображений у товаров
    $('.js-wg-product-image').on(
        'click',
        '.wg-product-image__thumbnails-item',
        function () {
            var imageSrc = $(this).find('img').data('src-big'),
                parent = $(this).parents('.js-wg-product-image');

            parent
                .find('.wg-product-image__thumbnails-item')
                .removeClass('active');
            $(this).addClass('active');
            parent.find('.wg-product-image__image').addClass('loading');
            setTimeout(function () {
                parent.find('.wg-product-image__image').removeClass('loading');
            }, 400);

            parent.find('.wg-product-image__image img').attr('src', imageSrc);
        }
    );

    /*************************************************************************/
    /*                     Загрузка файлов в отзывах                         */
    /*************************************************************************/
    function fileUploadDragOnDrop() {
        $('#ReviewImage_image')
            .focus(function () {
                $('.file-upload').addClass('focus');
            })
            .focusout(function () {
                $('.file-upload').removeClass('focus');
            });

        var dropZone = $('#file-upload');

        dropZone.on(
            'drag dragstart dragend dragover dragenter dragleave drop',
            function () {
                return false;
            }
        );

        dropZone.on('dragover dragenter', function () {
            dropZone.addClass('dragover');
        });

        dropZone.on('dragleave', function (e) {
            dropZone.removeClass('dragover');
        });

        dropZone.on('dragleave', function (e) {
            let dx = e.pageX - dropZone.offset().left;
            let dy = e.pageY - dropZone.offset().top;
            if (
                dx < 0 ||
                dx > dropZone.width() ||
                dy < 0 ||
                dy > dropZone.height()
            ) {
                dropZone.removeClass('dragover');
            }
        });

        dropZone.on('drop', function (e) {
            dropZone.removeClass('dragover');
            dropZone.addClass('add');
            let files = e.originalEvent.dataTransfer.files;

            document.querySelector('#ReviewImage_image').files = files;
            let filesCount = files.length;
            let filesText = numCases(filesCount, ['файл', 'файла', 'файлов']);

            $('#file-upload-text').html(
                '<label for="ReviewImage_image">Выбрать другие?</label><span> Было выбрано ' +
                    filesCount +
                    ' ' +
                    filesText +
                    '</span>'
            );
        });

        $('#ReviewImage_image').on('change', function () {
            let filesCount =
                document.querySelector('#ReviewImage_image').files.length;
            let filesText = numCases(filesCount, ['файл', 'файла', 'файлов']);

            dropZone.addClass('add');
            $('#file-upload-text').html(
                '<label for="ReviewImage_image">Выбрать другие?</label><span> Было выбрано ' +
                    filesCount +
                    ' ' +
                    filesText +
                    '</span>'
            );
        });
    }

    fileUploadDragOnDrop();

    function numCases(n, words) {
        n = Math.abs(n) % 100;
        var n1 = n % 10;
        if (n > 10 && n < 20) {
            return words[2];
        }
        if (n1 > 1 && n1 < 5) {
            return words[1];
        }
        if (n1 == 1) {
            return words[0];
        }
        return words[2];
    }

    // Показывать отзывы только с фото
    $(document).delegate(
        '.js-review-control-filter-photo',
        'change',
        function () {
            var data = {
                filterPhoto: $(this).is(':not(:checked)') ? 0 : 1,
                YUPE_TOKEN: yupeToken,
            };

            $('.review-control__filter').addClass('loader');

            $.ajax({
                data: data,
                type: 'post',
                success: function (data) {
                    $('#review-box').html($(data).find('#review-box').html());
                    $('.review-control__filter').removeClass('loader');
                },
            });
        }
    );

    $('.show-phone').on('click', function (e) {
        e.preventDefault();
        $(this).addClass('hidden');
        $(this).next().removeClass('hidden');
    });

    // js-structure-menu
    $('.js-structure-menu li').click(function () {
        let el = $(this),
            elId = el.attr('data-id');
        elBlock = $('.js-structure-block > div[data-id="' + elId + '"]');

        $('.js-structure-menu li').removeClass('active');
        $('.js-structure-block > div').removeClass('active');

        el.addClass('active');

        let innerWidth = window.innerWidth;

        if (innerWidth > 767) {
            elBlock.addClass('active').scrollTop;

            // $('body,html').animate({scrollTop: elBlock.offset().top - 50}, 1000);
        } else {
            let elBlockText = elBlock.find('.structure-block__desc').text();

            $('.structure-block__mobile-desc').remove();
            el.append(
                '<span class="structure-block__mobile-desc">' +
                    elBlockText +
                    '</span>'
            );
        }
    });

    $('.structure-block__item').click(function () {
        let elId = $(this).attr('data-id'),
            elBlock = $('.js-structure-menu > li[data-id="' + elId + '"]');
        $('.js-structure-block > div').removeClass('active');
        $('.js-structure-menu li').removeClass('active');
        elBlock.addClass('active');
        $(this).toggleClass('active');
    });

    // Плавный скролл для следующих элементов
    let linkAnimate = [
        'a[href="#characteristics"]',
        'a[href="#description"]',
        'a[href="#comments"]',
    ];
    $(linkAnimate.toString()).click(function (event) {
        event.preventDefault();
        let top = $($(this).attr('href')).offset().top;
        $('body,html').animate({ scrollTop: top - 20 }, 1000);
    });

    // Подгоняю сайдбар в карточке товара под его содержимое
    let sideHeight = $('.product-side').innerHeight();
    let innerWidth = window.innerWidth;

    if (innerWidth < 576) {
        $('.product-view__image').css({
            'margin-bottom': sideHeight + 46 + 'px',
        });
    }

    // Блок - Способ оплаты
    let classPayment = '.js-ways-payment';

    $(classPayment + ' .ways-payment__title').click(function () {
        let elId = $(this).attr('data-id');

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
            $(this)
                .parents(classPayment)
                .find('[data-child-id="' + elId + '"]')
                .animate({ height: 'show' }, 300);
        } else {
            $(this)
                .parents(classPayment)
                .find('[data-child-id="' + elId + '"]')
                .animate({ height: 'hide' }, 300);

            $(this).removeClass('active');
            $(this)
                .parents(classPayment)
                .find('[data-child-id="' + elId + '"]')
                .removeClass('active');
        }
    });

    $('.but-add-cart').on('click', function () {});
    $('.product-side #add-product-to-cart').on('click', function () {});
});

// Учет времени посещения сайта
//User Behaviour Tracking
let UBT_Logic = function () {
    this.ActiveTimeout = 30; //1min
    this.IdleTimeout = 30; //1min
    this.IntervalId = 0;
    this.TimeFlag = 'UBT_TimeFlag';
    this.TimeMsgFlag = 'UBT_TimeMsgFlag';
    this.LastActiveTimeFlag = 'UBT_LastActiveTimeFlag';
    this.LastUserActivityTimeFlag = 'UBT_LastUserActivityTimeFlag';
};

UBT_Logic.prototype.StartFunc = function () {
    //here can be some additional logic
    ubtLogic.InitTimeFlag();
};

UBT_Logic.prototype.InitTimeFlag = function () {
    let now = Math.floor(new Date().getTime() / 1000);
    if (typeof localStorage[ubtLogic.LastActiveTimeFlag] == 'undefined') {
        localStorage[ubtLogic.LastActiveTimeFlag] = now;
        localStorage[ubtLogic.TimeFlag] = 0;
        localStorage[ubtLogic.TimeMsgFlag] = 0;
    } else {
        let t = parseInt(localStorage[ubtLogic.LastActiveTimeFlag]);
        if (t <= 0 || t + 300 < now || t > now) {
            localStorage[ubtLogic.LastActiveTimeFlag] = now;
            localStorage[ubtLogic.TimeFlag] = 0;
            localStorage[ubtLogic.TimeMsgFlag] = 0;
        }
    }
    if (typeof localStorage[ubtLogic.TimeFlag] == 'undefined') {
        localStorage[ubtLogic.TimeFlag] = 0;
        localStorage[ubtLogic.TimeMsgFlag] = 0;
    } else {
        let t = parseInt(localStorage[ubtLogic.TimeFlag]);
        if (t < 0 || t > now) {
            localStorage[ubtLogic.TimeFlag] = 0;
            localStorage[ubtLogic.TimeMsgFlag] = 0;
        }
    }
    if (typeof localStorage[ubtLogic.TimeMsgFlag] == 'undefined')
        localStorage[ubtLogic.TimeMsgFlag] = 0;
    else {
        let t = parseInt(localStorage[ubtLogic.TimeMsgFlag]);
        if (t != 0 && t != 1) localStorage[ubtLogic.TimeMsgFlag] = 0;
    }
    localStorage[ubtLogic.LastUserActivityTimeFlag] = now;
    document.onmousemove = function (event) {
        localStorage[ubtLogic.LastUserActivityTimeFlag] = Math.floor(
            new Date().getTime() / 1000
        );
    };
    document.onkeydown = function (event) {
        localStorage[ubtLogic.LastUserActivityTimeFlag] = Math.floor(
            new Date().getTime() / 1000
        );
    };
    IntervalId = setInterval(ubtLogic.TimeFunc, 300);
};

UBT_Logic.prototype.TimeFunc = function () {
    let now = Math.floor(new Date().getTime() / 1000);
    //]]console.log(now);
    let lastActiveTimeFlag = parseInt(
        localStorage[ubtLogic.LastActiveTimeFlag]
    );
    if (lastActiveTimeFlag < now) {
        localStorage[ubtLogic.LastActiveTimeFlag] = now;
        let timeFlag = parseInt(localStorage[ubtLogic.TimeFlag]);
        timeFlag++;
        localStorage[ubtLogic.TimeFlag] = timeFlag;
        let timeMsgFlag = parseInt(localStorage[ubtLogic.TimeMsgFlag]);
        let lastUserActivityTimeFlag = parseInt(
            localStorage[ubtLogic.LastUserActivityTimeFlag]
        );
        if (timeMsgFlag == 0) {
            if (timeFlag >= ubtLogic.ActiveTimeout) {
                localStorage[ubtLogic.TimeMsgFlag] = 1;
                ubtLogic.ActiveTimeoutFunc();
            } else if (lastUserActivityTimeFlag + ubtLogic.IdleTimeout <= now) {
                localStorage[ubtLogic.TimeMsgFlag] = 1;
                ubtLogic.IdleTimeoutFunc();
            }
        }
        if (localStorage[ubtLogic.TimeMsgFlag] != 0) {
            clearInterval(IntervalId);
        }
    }
};

UBT_Logic.prototype.ActiveTimeoutFunc = function () {
    $('#promoCode').modal('show');
};

UBT_Logic.prototype.IdleTimeoutFunc = function () {
    console.log('IdleTimeout');
};

let ubtLogic = new UBT_Logic();
ubtLogic.StartFunc();

$('.js-main-review').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1360,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

const prevArrowCategories =
    '<span class="slick-prev slick-arrow categories-prev"><svg width="16" height="30" viewBox="0 0 16 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.805 0.835003L0.849995 14.125C0.62246 14.3584 0.495117 14.6715 0.495117 14.9975C0.495117 15.3235 0.62246 15.6366 0.849995 15.87L13.805 29.165C13.911 29.2739 14.0377 29.3604 14.1777 29.4195C14.3177 29.4785 14.4681 29.509 14.62 29.509C14.7719 29.509 14.9223 29.4785 15.0623 29.4195C15.2023 29.3604 15.329 29.2739 15.435 29.165C15.653 28.9418 15.7751 28.6421 15.7751 28.33C15.7751 28.0179 15.653 27.7182 15.435 27.495L3.25249 14.9975L15.435 2.5025C15.6523 2.27937 15.7739 1.98022 15.7739 1.66875C15.7739 1.35729 15.6523 1.05813 15.435 0.835003C15.329 0.726145 15.2023 0.639622 15.0623 0.580544C14.9223 0.521465 14.7719 0.491028 14.62 0.491028C14.4681 0.491028 14.3177 0.521465 14.1777 0.580544C14.0377 0.639622 13.911 0.726145 13.805 0.835003Z" fill="black"/></svg></span>';
const nextArrowCategories =
    '<span class="slick-next slick-arrow categories-next"><svg width="16" height="30" viewBox="0 0 16 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.195 0.835003L15.15 14.125C15.3775 14.3584 15.5049 14.6715 15.5049 14.9975C15.5049 15.3235 15.3775 15.6366 15.15 15.87L2.195 29.165C2.08901 29.2739 1.96229 29.3604 1.82231 29.4195C1.68234 29.4785 1.53194 29.509 1.38001 29.509C1.22807 29.509 1.07767 29.4785 0.937697 29.4195C0.797719 29.3604 0.670996 29.2739 0.565006 29.165C0.346951 28.9418 0.224874 28.6421 0.224874 28.33C0.224874 28.0179 0.346951 27.7182 0.565006 27.495L12.7475 14.9975L0.565006 2.5025C0.347698 2.27937 0.226094 1.98022 0.226094 1.66875C0.226094 1.35729 0.347698 1.05813 0.565006 0.835003C0.670996 0.726145 0.797719 0.639622 0.937697 0.580544C1.07767 0.521465 1.22807 0.491028 1.38001 0.491028C1.53194 0.491028 1.68234 0.521465 1.82231 0.580544C1.96229 0.639622 2.08901 0.726145 2.195 0.835003Z" fill="black"/></svg></span>';

$('.js-categories').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    dots: false,
    arrows: true,
    prevArrow: prevArrowCategories,
    nextArrow: nextArrowCategories,
    // autoplay: true,
    // autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 820,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 450,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
    ],
});

const nextArrowHits =
    '<span class="slick-next slick-arrow catalog-hits-next"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="29.5" y="29.5" width="29" height="29" transform="rotate(-180 29.5 29.5)" fill="white" stroke="black"/><path d="M11.4134 7.94637C11.2898 8.06972 11.1917 8.21624 11.1248 8.37754C11.0579 8.53884 11.0234 8.71175 11.0234 8.88637C11.0234 9.06099 11.0579 9.23391 11.1248 9.3952C11.1917 9.5565 11.2898 9.70302 11.4134 9.82637L16.5867 14.9997L11.4134 20.173C11.1641 20.4223 11.024 20.7605 11.024 21.113C11.024 21.4656 11.1641 21.8037 11.4134 22.053C11.6627 22.3023 12.0008 22.4424 12.3534 22.4424C12.7059 22.4424 13.0441 22.3023 13.2934 22.053L19.4134 15.933C19.537 15.8097 19.635 15.6632 19.7019 15.5019C19.7688 15.3406 19.8033 15.1677 19.8033 14.993C19.8033 14.8184 19.7688 14.6455 19.7019 14.4842C19.635 14.3229 19.537 14.1764 19.4134 14.053L13.2934 7.93304C12.7867 7.42637 11.9334 7.42637 11.4134 7.94637Z" fill="black"/></svg></span>';
const prevArrowHits =
    '<span class="slick-prev slick-arrow catalog-hits-prev"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="0.5" y="0.5" width="29" height="29" fill="white" stroke="black"/><path d="M18.5866 22.0536C18.7102 21.9303 18.8083 21.7838 18.8752 21.6225C18.9421 21.4612 18.9766 21.2883 18.9766 21.1136C18.9766 20.939 18.9421 20.7661 18.8752 20.6048C18.8083 20.4435 18.7102 20.297 18.5866 20.1736L13.4133 15.0003L18.5866 9.82696C18.8359 9.57766 18.976 9.23953 18.976 8.88696C18.976 8.5344 18.8359 8.19627 18.5866 7.94696C18.3373 7.69766 17.9992 7.5576 17.6466 7.5576C17.2941 7.5576 16.9559 7.69766 16.7066 7.94696L10.5866 14.067C10.463 14.1903 10.365 14.3368 10.2981 14.4981C10.2312 14.6594 10.1967 14.8323 10.1967 15.007C10.1967 15.1816 10.2312 15.3545 10.2981 15.5158C10.365 15.6771 10.463 15.8236 10.5866 15.947L16.7066 22.067C17.2133 22.5736 18.0666 22.5736 18.5866 22.0536Z" fill="black"/></svg></span>';

$('.js-hits-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    prevArrow: prevArrowHits,
    nextArrow: nextArrowHits,
    // autoplay: true,
    // autoplaySpeed: 2000,
});

$('.header-inter .search').on('click', function () {
    $('.header-search .header-search__input').focus();
    $('.search__wrapper').addClass('show');
    $('.overlay-main').addClass('open');
    $('body').addClass('no-active');
});

$('.overlay-main').on('click', function () {
    $('.search__wrapper').removeClass('show');
    $('body').removeClass('no-active');
    $(this).removeClass('open');
    $('.filter-mobile').removeClass('show');
});

$('.close-search').on('click', function () {
    $('.search__wrapper').removeClass('show');
    $('.overlay-main').removeClass('open');
    $('body').removeClass('no-active');
});

$('.header-catalog').on('click', function () {
    $('.top-catalog').toggleClass('show');
});

// if ($(window).width() < 768) {
//     $('.header__nav').slick({
//         infinite: true,
//         slidesToShow: 4,
//         slidesToScroll: 1,
//         dots: false,
//         arrows: false,
//         autoplay: true,
//         autoplaySpeed: 3000,
//         responsive: [
//             {
//                 breakpoint: 580,
//                 settings: {
//                     slidesToShow: 3,
//                 },
//             },
//             {
//                 breakpoint: 450,
//                 settings: {
//                     slidesToShow: 2,
//                 },
//             },
//         ],
//     });
//     $('.hits-list').slick({
//         infinite: true,
//         slidesToShow: 2,
//         slidesToScroll: 1,
//         dots: false,
//         arrows: false,
//         // autoplay: true,
//         // autoplaySpeed: 3000,
//         responsive: [
//             {
//                 breakpoint: 680,
//                 settings: {
//                     slidesToShow: 1,
//                 },
//             },
//         ],
//     });
// }

$('.tab-review').on('click', function () {
    $('.tab-review').removeClass('show');
    $(this).addClass('show');
    $('.body-item').removeClass('show');
    let tab = $(this).attr('data-tab');
    $('.item-' + tab).addClass('show');
});

$('.js-add-gift-items').on('click', function () {
    $('.gift-items').toggleClass('show');

    $('.js-gift-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        // autoplay: true,
        // autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 980,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerMode: true,
                },
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                },
            },
        ],
    });
});

$('.js-add-gift-message').on('click', function () {
    $('.gift-message-text').toggleClass('show');
});

// $('.js-gift-slider').slick({
//   infinite: true,
//   slidesToShow: 3,
//   slidesToScroll: 1,
//   dots: false,
//   arrows: false,
//   // autoplay: true,
//   // autoplaySpeed: 2000,
//   // responsive: [
//   //   {
//   //     breakpoint: 980,
//   //     settings: {
//   //       slidesToShow: 2,
//   //       slidesToScroll: 1,
//   //     },
//   //   },
//   //   {
//   //     breakpoint: 550,
//   //     settings: {
//   //       slidesToShow: 1,
//   //       slidesToScroll: 1,
//   //     },
//   //   },
//   // ],
// });

$('.js-users-photos').slick({
    infinite: true,
    slidesToShow: 11,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1360,
            settings: {
                slidesToShow: 8,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            },
        },
    ],
});

$('.gift-item').on('click', function () {
    $('.gift-item').removeClass('select');
    $(this).addClass('select');
});

$('#nav-icon3').click(function () {
    $(this).toggleClass('open');
    $('body').toggleClass('no-active');
});

$('#nav-icon3').on('click', function () {
    $('.header__nav-mobile').toggleClass('open');
});

$(document).ready(function () {
    if (!$.cookie('loader')) {
        $.cookie('loader', '1', { expires: 1 });
        console.log('test');
        $('body').addClass('no-active');
        $('.preloader').removeClass('preloader-remove');
        setTimeout(() => {
            $('body').removeClass('no-active');
            $('.preloader').addClass('preloader-remove');
        }, 5000);
    }
});

// $('a.opener-filter').on('click', function (e) {
//   e.preventDefault();
//   var anchor = $(this).attr('href');
//   $('html, body')
//     .stop()
//     .animate(
//       {
//         scrollTop: $(anchor).offset().top,
//       },
//       500
//     );
//   $('.filter-mobile').addClass('show');
// });

$('.filter-mobile h3 svg').on('click', function () {
    $('.filter-mobile').removeClass('show');
});

$('.product-info__link').on('click', function () {
    if (!$('.product-info__desc').hasClass('show')) {
        $('.product-info__desc').addClass('show');
        $(this).text('Свернуть');
    } else {
        $('.product-info__desc').removeClass('show');
        $(this).text('Развернуть');
    }
});

$(document).ready(function () {
    wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false,
        live: true,
    });
    wow.init();

    $('.filter-mobile__opener').on('click', function () {
        $('.filter-mobile').addClass('show');
        $('.overlay-main').addClass('open');
    });
    $('.filter-close').on('click', function () {
        $('.filter-mobile').removeClass('show');
        $('.overlay-main').removeClass('open');
    });
  
    
    
});
