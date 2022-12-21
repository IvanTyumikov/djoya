<?php if (!empty($models)) : ?>
    <div class="priceCity-list fl fl-wr-w">
        <?php foreach ($models as $key => $data) : ?>
            <?php if ($data->price_file) : ?>
                <div class="priceCity-list__item fl fl-di-c fl-ju-co-sp-b">
                    <div>
                        <div class="priceCity-list__name">
                            <?= $data->category->name . " г. " . $data->name_short; ?>
                        </div>
                        <div class="priceCity-list__loc">
                            <?= $data->address; ?>
                        </div>
                        <div class="priceCity-list__phone fl fl-wr-w">
                            <span>Тел.: </span><div><?= $data->phone; ?></div>
                        </div>
                        <div class="priceCity-list__phone fl fl-wr-w">
                            <span>E-mail: </span><div><?= $data->email; ?></div>
                        </div>
                    </div>
                    <div class="catalog-price-home js-catalog-price">
                        <div class="catalog-price-home__header">
                            Интернет-магазин
                        </div>
                        <div class="catalog-price-home__body fl fl-al-it-c">
                            <div class="catalog-price-home__info fl fl-al-it-c"><?= $data->getPriceInfo(); ?></div>
                            <div class="catalog-price-home__link">
                                <a class="" target="_blank" href="<?= $data->getPathPriceFile(); ?>">Скачать</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>