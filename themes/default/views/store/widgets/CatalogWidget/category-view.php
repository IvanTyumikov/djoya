<?php if (false) : ?>
    <div class="category__main category__view js-category-view-slider">
        <?php foreach ($category as $key => $data) : ?>
            <a href="<?= $data->getCategoryUrl(); ?>" class="category-item <?= Yii::app()->request->requestUri === $data->getCategoryUrl() ? 'active' : '' ?>">
                <span class="category-item__image">
                    <?php if ($data->getImageTwoUrl()) : ?>
                        <img src="<?= $data->getImageTwoUrl() ?>" alt="<?= $data->name; ?>">
                    <?php endif; ?>
                </span>
                <span class="category-item__name">
                    <span class="value"><?= $data->name; ?></span>
                </span>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>