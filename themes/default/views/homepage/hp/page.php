<?php

/** @var Page $page */

if ($page->layout) {
    $this->layout = "//layouts/{$page->layout}";
}
$this->isHome = true; // Это главная страница

// $this->title = $page->meta_title ?: $page->title;
$this->title = 'Главная';
$this->breadcrumbs = [
    Yii::t('HomepageModule.homepage', 'Pages'),
    $page->title
];
$this->description = $page->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
?>

<?php /*echo $this->renderPartial('//layouts/_prev'); */ ?>

<?php /* $this->widget('application.modules.slider.widgets.SliderWidget'); */ ?>


<div class="main-info wow fadeIn" data-wow-duration="1.5s">
    <div class="container">
        <div class="main-info__wrapper">
            <div class="main-info__topper">
                Ручная работа • Натуральные материалы • Ограниченный тираж
            </div>
            <div class="main-info__title">
                <h1>
                    Сила природы, с любовью
                </h1>
            </div>
            <div class="main-info__bottom">
                Большой выбор предметов силы и подарков
                для красоты и радости жизни
            </div>
        </div>
    </div>
</div>

<div class="main-categories wow fadeIn" data-wow-duration="1.5s">
    <div class="container">
        <div class="main-categories__wrapper">
            <div class="main-categories__block">
                <div class="block-part">
                    <a href="/store/svechi">
                        <div class="small-block marg-b">
                            <img src="<?= $this->mainAssets . '/images/main-categories/1.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Свечи
                                </div>
                                <div class="category-price">
                                    от 70 ₽
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/store/masla">
                        <div class="big-block">
                            <img src="<?= $this->mainAssets . '/images/main-categories/3.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Масла
                                </div>
                                <div class="category-price">
                                    от 200 ₽
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="block-part">
                    <a href="/store/talismany">
                        <div class="small-block marg-b">
                            <img src="<?= $this->mainAssets . '/images/main-categories/2.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Талисманы
                                </div>
                                <div class="category-price">
                                    от 300 ₽
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/store/ukrasheniya">
                        <div class="small-block marg-b">
                            <img src="<?= $this->mainAssets . '/images/main-categories/4.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Украшения
                                </div>
                                <div class="category-price">
                                    от 600 ₽
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/store/nabory">
                        <div class="small-block">
                            <img src="<?= $this->mainAssets . '/images/main-categories/5.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Наборы
                                </div>
                                <div class="category-price">
                                    от 500 ₽
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-categories__block">
                <div class="block-part">
                    <a href="/store/kukly">
                        <div class="big-block marg-b">
                            <img src="<?= $this->mainAssets . '/images/main-categories/6.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Куклы
                                </div>
                                <div class="category-price">
                                    от 1000 ₽
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/store/amulety">
                        <div class="small-block">
                            <img src="<?= $this->mainAssets . '/images/main-categories/7.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Амулеты
                                </div>
                                <div class="category-price">
                                    от 200 ₽
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="block-part">
                    <a href="/store/podarki">
                        <div class="small-block marg-b">
                            <img src="<?= $this->mainAssets . '/images/main-categories/8.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Подарки
                                </div>
                                <div class="category-price">
                                    от 800 ₽
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/store/akcii">
                        <div class="big-block">
                            <img src="<?= $this->mainAssets . '/images/main-categories/9.png' ?>" alt="">
                            <div class="block-info">
                                <div class="category-name">
                                    Акции
                                </div>
                                <div class="category-price">
                                    от 10 %
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-review__wrapper wow fadeIn" data-wow-duration="1.5s">
    <div class="container">
        <div class="main-review">
            <h2>
                Отзывы
            </h2>
            <div class="main-review__list js-main-review">
                <div class="main-review__item">
                    <div class="review-avatar">
                        <img src="<?= $this->mainAssets . '/images/review/avatars/1.png' ?>" alt="">
                    </div>
                    <div class="review-name">
                        Анжелика
                    </div>
                    <div class="review-product">
                        Подарки
                    </div>
                    <div class="review-text">
                        Сегодня приехала уже вторая посылка. Качество на высшем уровне, это именно то, что я хотела! У вашего магазина…
                    </div>
                </div>
                <div class="main-review__item">
                    <div class="review-avatar">
                        <img src="<?= $this->mainAssets . '/images/review/avatars/2.png' ?>" alt="">
                    </div>
                    <div class="review-name">
                        Марго
                    </div>
                    <div class="review-product">
                        Наборы
                    </div>
                    <div class="review-text">
                        Замечательное качество товара! Не пожалела, что заказала с данного магазина
                    </div>
                </div>
                <div class="main-review__item">
                    <div class="review-avatar">
                        <img src="<?= $this->mainAssets . '/images/review/avatars/3.png' ?>" alt="">
                    </div>
                    <div class="review-name">
                        Светлана
                    </div>
                    <div class="review-product">
                        Куклы
                    </div>
                    <div class="review-text">
                        Лучший магазин который я видела! Спасибо вам большое
                    </div>
                </div>
            </div>
            <div class="main-review__btns">
                <a href="/review" class="review-all">
                    Читать больше
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main-banner wow fadeIn" data-wow-duration="1.5s">
    <div class="container">
        <div class="main-banner__wrapper">
            <img src="<?= $this->mainAssets . '/images/banners/banner-1.png' ?>" alt="">
            <div class="main-banner__info">
                <h3>
                    Талисман на удачу
                </h3>
                <p>
                    Закажи набор для ритуала и получи <br> «Талисман на удачу» в подарок
                </p>
                <a href="">
                    Подробнее
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main-seo wow fadeIn" data-wow-duration="1.5s">
    <div class="container">
        <div class="main-seo__wrapper">
            <div class="seo-block-1">
                <h3>
                    Амулеты, украшения и сувениры
                </h3>
                <p>
                    Эзотерические товары и вера в силу различных даров природы пришли к нам из далёкой древности и по-прежнему актуальны для людей во всем мире. В каталоге нашего сайта широко представлены различные талисманы и амулеты, красивые браслеты, стильные медальоны, изящные кулоны, восковые свечи, гадальные карты и руны, и многое другое. Узнайте больше о товарах и их свойствах на страницах нашего сайта.
                </p>
            </div>
            <div class="seo-block-2">
                <h4>
                    Регулярное обновление ассортимента
                </h4>
                <p>
                    Мы постоянно следим за модными тенденциями и пополняем каталог новыми товарами. Устраиваем распродажи, в рамках которых покупатели могут приобрести товары с дисконтом. Скидки в нашем магазине позволяют сделать выгодные покупки. Информация об акциях публикуется в специальном разделе.
                </p>
            </div>
            <div class="seo-block-3">
                <h4>
                    Гарантия качества
                </h4>
                <p>
                    Мы сотрудничаем только с проверенными деловыми партнёрами, отдавая предпочтение надёжным производителями и поставщиками для того, чтобы наша репутация и ваши покупки оставались безупречными.
                </p>
            </div>
        </div>
    </div>
</div>