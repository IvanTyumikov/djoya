<?php if ($category) : ?>
    <?php $city = Yii::app()->cityRepository->getCityFromUrl($_SERVER['REQUEST_URI']) ?>
    <div class="category__top category__index">
        <?php foreach ($category as $key => $data) : ?>
            <?php if (!($city !== null && $data->id == 32)) : ?>
                <div class="category-item">
                    <a href="<?= $data->getCategoryUrl(); ?>" class="category-item__image">
                        <img src="<?= $data->getImageUrl(397, 471); ?>" alt="<?= $data->name; ?>">
                    </a>
                    <div class="category-item__info">
                        <a href="<?= $data->getCategoryUrl(); ?>" class="category-item__name">
                            <?= $data->name; ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>