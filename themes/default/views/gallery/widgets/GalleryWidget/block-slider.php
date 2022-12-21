<?php if ($dataProvider->getTotalItemCount()): ?>
    <div class="block__slider block-slider js-block-slider">
        <?php foreach ($dataProvider->getData() as $data): ?>
            <div class="block-slider__item">
                <picture>
                    <source media="max-width(576px)" srcset="<?= $data->image->getImageUrlWebp(268, 294, false) ?>" type="image/webp">
                    <source srcset="<?= $data->image->getImageUrlWebp() ?>" type="image/webp">
                    <img src="<?= $data->image->getImageUrl() ?>" alt="<?= $data->image->alt ?>">
                </picture>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>