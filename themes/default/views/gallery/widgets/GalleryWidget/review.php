<?php $data = $dataProvider->getData(); ?>
<?php if(count($data) > 0): ?>
<div class="review__slider review-slider review-slider-stories <?= $js_class ?> review-video-style">
    <?php foreach ($data as $key => $item): ?>
        <?php $path = $item->image->getImageUrl(); ?>
        <div class="review-item review-item-full">
            <a href="<?= $path ?>" data-fancybox="reviews" data-width="463" data-height="824">
                <?php if(pathinfo($path)['extension'] === 'mp4'): ?>
                    <video src="<?= $path ?>" muted loop autoplay></video>
                <?php else: ?>
                    <picture>
                        <source srcset="<?= $item->image->getImageUrlWebp() ?>" type="image/webp">
                        <img src="<?= $path ?>" alt="">
                    </picture>
                <?php endif; ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>