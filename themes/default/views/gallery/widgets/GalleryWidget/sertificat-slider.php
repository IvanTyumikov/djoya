<?php if ($dataProvider->getTotalItemCount()): ?>
    <div class="sertificat__slider sertificat-slider js-sertificat-slider">
        <?php foreach ($dataProvider->getData() as $data): ?>
            <a href="<?= $data->image->getImageUrl(0, 0) ?>" class="sertificat__img" data-fancybox="sertificats">
                <img src="<?= $data->image->getImageUrl(313, 440) ?>" alt="<?= $data->image->alt ?>" width="313" height="440">
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
