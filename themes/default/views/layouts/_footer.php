<footer>
    <div class="container">
        <div class="footer__wrapper">
            <div class="footer-line">
                <img src="<?= $this->mainAssets . '/images/header/header-line.svg' ?>" alt="">
            </div>
            <div class="footer-logo">
                <a href="/">
                    <img src="<?= $this->mainAssets . '/images/logo-footer.svg' ?>" alt="logo">
                </a>
            </div>
            <?php if (Yii::app()->hasModule('menu')) : ?>
                <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'bottom-menu', 'name' => 'bottom-menu']); ?>
            <?php endif; ?>
            <div class="footer-categories">
                <div class="footer-menu__title">
                    Что продаем
                </div>
                <div class="footer-menu__list">
                    <a href="/store/ukrasheniya">Украшения</a>
                    <a href="/store/talismany">Талисманы</a>
                    <a href="/store/amulety">Амулеты</a>
                    <a href="/store/podarki">Подарки</a>
                    <a href="/store/nabory">Наборы</a>
                </div>
            </div>
            <div class="footer-contacts">
                <div class="footer-menu__title">
                    Как связаться
                </div>
                <div class="footer-contacts__body">
                    <div class="contacts__item">
                        <a href="tel:+79253526221">+7 (925) 352-62-21</a>
                    </div>
                    <div class="contacts__item">
                        <a href="mailto:info@djoya.ru">info@djoya.ru</a>
                    </div>
                    <div class="footer-socials__icons contact-icons">
                        <div class="socials-icon__item">
                            <a href="">
                                <span class="no-active">
                                    <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/whatsapp.svg') ?>
                                </span>
                                <span class="active">
                                    <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/whatsapp-active.svg') ?>
                                </span>
                            </a>
                        </div>
                        <div class="socials-icon__item">
                            <a href="">
                                <span class="no-active">
                                    <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/viber.svg') ?>
                                </span>
                                <span class="active">
                                    <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/viber-active.svg') ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-socials">
                <div class="footer-menu__title">
                    Соц.сети
                </div>
                <div class="footer-socials__icons">
                    <div class="socials-icon__item">
                        <a href="">
                            <span class="no-active">
                                <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/vk.svg') ?>
                            </span>
                            <span class="active">
                                <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/vk-active.svg') ?>
                            </span>
                        </a>
                    </div>
                    <div class="socials-icon__item">
                        <a href="">
                            <span class="no-active">
                                <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/telegram.svg') ?>
                            </span>
                            <span class="active">
                                <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/telegram-active.svg') ?>
                            </span>
                        </a>
                    </div>
                    <div class="socials-icon__item">
                        <a href="">
                            <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/tiktok.svg') ?>
                        </a>
                    </div>
                    <div class="socials-icon__item">
                        <a href="">
                            <span class="no-active">
                                <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/youtube.svg') ?>
                            </span>
                            <span class="active">
                                <?= file_get_contents('.' . $this->mainAssets . '/images/icons/socials/youtube-active.svg') ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>