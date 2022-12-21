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

  //js-review-video-slider
  $('.js-review-video-slider').slick({
    fade: false,
    infinite: true,
    slidesToShow: 4,
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
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 440,
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

      parent.find('.wg-product-image__thumbnails-item').removeClass('active');
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
      if (dx < 0 || dx > dropZone.width() || dy < 0 || dy > dropZone.height()) {
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

      $('body,html').animate({ scrollTop: elBlock.offset().top - 50 }, 1000);
    } else {
      let elBlockText = elBlock.find('.structure-block__desc').text();

      $('.structure-block__mobile-desc').remove();
      el.append(
        '<span class="structure-block__mobile-desc">' + elBlockText + '</span>'
      );

      console.log();
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
    $('.product-view__image').css({ 'margin-bottom': sideHeight + 46 + 'px' });
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
  let lastActiveTimeFlag = parseInt(localStorage[ubtLogic.LastActiveTimeFlag]);
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


