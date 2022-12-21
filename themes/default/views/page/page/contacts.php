<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
$this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: '';
?>

<div class="page-content page-contact">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>

        <h1><?= $model->title; ?></h1>
        <div class="page-contact__wrapper">
            <div class="page-contact__col">
                <div class="page-contact__item">
                    <div class="item-title">
                        Контактный адрес
                    </div>
                    <div class="item-body">
                        <p>ул. Мясникова 32, Смоленск, Россия</p>
                    </div>
                </div>
                <div class="page-contact__item-row">
                    <div class="page-contact__item">
                        <div class="item-title">
                            Email
                        </div>
                        <div class="item-body">
                            <a href="mailto:info@djoya.ru">Info@djoya.ru</a>
                        </div>
                    </div>
                    <div class="page-contact__item">
                        <div class="item-title">
                            Телефон
                        </div>
                        <div class="item-body">
                            <a href="tel:89254522681">+7 (925) 452-26-81</a>
                        </div>
                    </div>
                </div>
                <div class="page-contact__item">
                    <div class="item-title">
                        Юридический адрес
                    </div>
                    <div class="item-body">
                        <p>г Москва ул 10-я Соколиной Горы 6 303</p>
                    </div>
                </div>
                <div class="page-contact__item">
                    <div class="item-title">
                        Соц.сети
                    </div>
                    <div class="item-body">
                        <div class="contacts-socials__icons">
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
            <div class="page-contact__col">
                <div class="page-contact__item">
                    <div class="item-title">
                        Реквизиты магазина Djoya:
                    </div>
                    <div class="item-body">
                        <p>ИП Войтенкова Наталья Михайловна</p>
                        <p>ИНН 771975902886</p>
                        <p>ОГРНИП 320774600391744</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-contact__map">
        <iframe src="<?= Yii::app()->getModule('yupe')->map ?>" frameborder="0" width="100%" height="100%"></iframe>
    </div>
</div>