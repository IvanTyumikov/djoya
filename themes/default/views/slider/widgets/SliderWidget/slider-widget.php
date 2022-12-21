<div class="prev">
    <div class="container">
        <div class="prev__main prev-slider js-prev-slider">
            <?php foreach ($models as $key => $slide): ?>
                <a href="<?= $slide->button_link ?>" class="prev-slider__item">
                    <picture>
                        <source srcset="<?= $slide->getImageUrlWebp(0, 0,true,null,'image'); ?>" type="image/webp">
                        <source srcset="<?= $slide->getImageUrl(0,0,true,null,'image'); ?>" type="image/jpeg">
                        <img src="<?= $slide->getImageUrl(0,0,true,null,'image'); ?>" alt="">
                    </picture>
                </a>
            <?php endforeach ?>
        </div>
    </div>
</div>