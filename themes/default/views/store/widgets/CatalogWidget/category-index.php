<?php if ($category) : ?>
    <?php $city = Yii::app()->cityRepository->getCityFromUrl($_SERVER['REQUEST_URI']) ?>
    <div class="category__main category__index">
        <?php foreach ($category as $key => $data) : ?>
            <?php if (!($city !== null && $data->id == 32)) : ?>
                <div class="category-item">
                    <a href="<?= $data->getCategoryUrl(); ?>" class="category-item__image">
                        <img src="<?= $data->getImageUrl(397, 471); ?>" alt="<?= $data->name; ?>">
                    </a>
                    <div class="category-item__info">
                        <a href="<?= $data->getCategoryUrl(); ?>" class="category-item__name">
                            <?= $data->name; ?>[[w:CityReplacement|caseRus=предложный;pretext=в;displayOnMain=false;]]
                        </a>
                        <a href="<?= $data->getCategoryUrl(); ?>" class="category-item__more">Смотреть все</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="main-banner">
        <div class="main-banner__wrapper">
            <img src="/assets/b3139e67/images/banners/banner-1.png" alt="">
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
    <?php $this->widget('application.modules.store.widgets.ProductWidget', [
        'is_hit' => true,
        'title' => 'Хиты продаж',
        'view' => 'product-home',
        'order' => 't.update_time DESC'
    ]); ?>
<?php endif; ?>