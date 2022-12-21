<?php if ($dataProvider->getTotalItemCount()): ?>
    <div class="product-view__sertificat">
        <?php foreach ($dataProvider->getData() as $data): ?>
            <a href="<?= $data->image->getImageUrl(0, 0) ?>" data-fancybox="sertificats">
                <picture>
                    <source srcset="<?= $data->image->getImageUrlWebp(313, 440) ?>" type="image/webp">
                    <img src="<?= $data->image->getImageUrl(313, 440) ?>" alt="<?= $data->image->alt ?>" width="313" height="440">
                </picture>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
