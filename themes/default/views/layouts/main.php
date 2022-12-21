<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">

<head>
    <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::HEAD_START); ?>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
    <meta http-equiv="Content-Language" content="ru-RU" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="facebook-domain-verification" content="nok0f4mmetr7n4p22pt8ov2u2cglxa" />

    <title><?= $this->decodeWidgets($this->title); ?></title>
    <meta name="description" content="<?= $this->decodeWidgets($this->description); ?>" />

    <?php if ($this->robots) : ?>
        <meta name="robots" content="<?= $this->robots; ?>">
    <?php endif ?>

    <?php if ($this->canonical) : ?>
        <link rel="canonical" href="<?= $this->canonical;  ?>" />
    <?php else :
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $canonical_url = $url[0];
    ?>
        <link rel="canonical" href="<?= $canonical_url;  ?>" />
    <?php endif; ?>

    <?php
    Yii::app()->getClientScript()->registerLinkTag('preload stylesheet', 'text/css', $this->mainAssets . '/css/style.min.css?clear24');
    Yii::app()->getClientScript()->registerLinkTag('wow stylesheet', 'text/css', $this->mainAssets . '/css/animate.min.css?clear24');
    Yii::app()->getClientScript()->registerLinkTag('select stylesheet', 'text/css', $this->mainAssets . '/css/select2.min.css?clear24');
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/slick.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.zoom.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/aos.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/main.min.js?clear23', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/store.js?clear22', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.inputmask.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/wow.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/select2.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery-cookie.js', CClientScript::POS_END);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

    <script type="text/javascript">
        // yupe
        const yupeTokenName = "<?= Yii::app()->getRequest()->csrfTokenName; ?>";
        const yupeToken = "<?= Yii::app()->getRequest()->getCsrfToken(); ?>";
        const yupeCartDeleteProductUrl = "<?= Yii::app()->createUrl('/cart/cart/delete/') ?>";
        const yupeCartUpdateUrl = "<?= Yii::app()->createUrl('/cart/cart/update/') ?>";
        const yupeCartWidgetUrl = "<?= Yii::app()->createUrl('/cart/cart/widget/') ?>";
        const phoneMaskTemplate = "<?= Yii::app()->getModule('user')->phoneMask; ?>";
        const categoryIdCoupon = "<?= Yii::app()->getModule('coupon')->categoryId; ?>";

        const yupeCartEmptyMessage = '<div class="cart-index__empty">В корзине нет товаров</div>';

        // delivery
        const deliveryMethodUrl = "<?= Yii::app()->createUrl('/delivery/deliveryAjax/deliveryMethod') ?>";

        // icon slick slider
        const prevArrow = '<span class="slick-prev slick-arrow banner-prev"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="17" cy="17" r="16.5" stroke="white"/><path d="M20.5866 24.0536C20.7102 23.9303 20.8083 23.7838 20.8752 23.6225C20.9421 23.4612 20.9766 23.2883 20.9766 23.1136C20.9766 22.939 20.9421 22.7661 20.8752 22.6048C20.8083 22.4435 20.7102 22.297 20.5866 22.1736L15.4133 17.0003L20.5866 11.827C20.8359 11.5777 20.976 11.2395 20.976 10.887C20.976 10.5344 20.8359 10.1963 20.5866 9.94696C20.3373 9.69766 19.9992 9.5576 19.6466 9.5576C19.2941 9.5576 18.9559 9.69766 18.7066 9.94696L12.5866 16.067C12.463 16.1903 12.365 16.3368 12.2981 16.4981C12.2312 16.6594 12.1967 16.8323 12.1967 17.007C12.1967 17.1816 12.2312 17.3545 12.2981 17.5158C12.365 17.6771 12.463 17.8236 12.5866 17.947L18.7066 24.067C19.2133 24.5736 20.0666 24.5736 20.5866 24.0536Z" fill="white"/></svg></span>';
        const nextArrow = '<span class="slick-next slick-arrow banner-next"><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="17" cy="17" r="16.5" stroke="white"/><path d="M13.4134 9.94637C13.2898 10.0697 13.1917 10.2162 13.1248 10.3775C13.0579 10.5388 13.0234 10.7117 13.0234 10.8864C13.0234 11.061 13.0579 11.2339 13.1248 11.3952C13.1917 11.5565 13.2898 11.703 13.4134 11.8264L18.5867 16.9997L13.4134 22.173C13.1641 22.4223 13.024 22.7605 13.024 23.113C13.024 23.4656 13.1641 23.8037 13.4134 24.053C13.6627 24.3023 14.0008 24.4424 14.3534 24.4424C14.7059 24.4424 15.0441 24.3023 15.2934 24.053L21.4134 17.933C21.537 17.8097 21.635 17.6632 21.7019 17.5019C21.7688 17.3406 21.8033 17.1677 21.8033 16.993C21.8033 16.8184 21.7688 16.6455 21.7019 16.4842C21.635 16.3229 21.537 16.1764 21.4134 16.053L15.2934 9.93304C14.7867 9.42637 13.9334 9.42637 13.4134 9.94637Z" fill="white"/></svg></span>';
    </script>

    <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::HEAD_END); ?>
</head>

<body>
    <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::BODY_START); ?>

    <div class="wrapper">
        <?= $this->decodeWidgets($this->renderPartial('//layouts/_header')); ?>
        <div class="preloader preloader-remove">
            <img src="<?= $this->mainAssets . '/images/preloader.gif' ?>" alt="">
        </div>
        <div class="overlay-main"></div>
        <?= $this->decodeWidgets($content); ?>
        <?= $this->decodeWidgets($this->renderPartial('//layouts/_fixed-socials')); ?>
        <?= $this->decodeWidgets($this->renderPartial('//layouts/_footer')); ?>
    </div>

    <div class='message-modal hidden' id='succes-mesage'>
        <div class='message-modal__content'>
            <div class='message-modal__message'>
                <?= Yii::t("default", "Your message has been sent successfully!"); ?>
            </div>
            <a class='button message-modal__close' data-modal="#succes-mesage" href="#">
                <?= Yii::t("default", "Close a window"); ?>
            </a>
        </div>
    </div>

    <div class='notifications top-right' id="notifications"></div>
    <div class="ajax-loading"></div>

    <?php /* $this->widget('application.modules.mail.widgets.CallbackModalWidget'); */ ?>

    <div id="ordersuccessModal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal__header">
                    <div data-dismiss="modal" class="modal__close">
                        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/modal-close.svg'); ?>
                    </div>
                    <div class="modal__title">Уведомление!</div>
                </div>
                <div class="modal__body">
                    <div class="message-success">
                        <p>Ваш заказ принят. В ближайшее время с вами свяжется наш менеджер для подтверждения заказа.</p>
                        <!--<a href="#payment-methods" class="btn btn-green">Оплатить онлайн</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $fancybox = $this->widget(
        'gallery.extensions.fancybox3.AlFancybox',
        [
            'target' => "[data-fancybox]",
            'lang'   => 'ru',
            'config' => [
                'animationEffect' => "fade",
            ],
        ]
    ); ?>

    <script>
        $('#Order_country').suggestions({
            token: '7f1219832739f5e34def073b045c6ee0174fdbde',
            type: 'ADDRESS',
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function(suggestion) {
                console.log(suggestion);
            },
        });
    </script>

    <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::BODY_END); ?>

</body>

</html>