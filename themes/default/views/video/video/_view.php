<div class="video__item">
    <a href="<?= $data->code ?>" class="video__link" data-fancybox="video">
        <picture>
            <source srcset="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/video/img-video.webp'; ?>" type="image/webp">
            <img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/video/img-video.jpg'; ?>" alt="">
        </picture>
        <span class="video__link-icon"><?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/play.svg'); ?></span>
    </a>
    <div class="video__img">
        <picture>       
            <source srcset="<?= $data->getImageUrlWebp(); ?>" type="image/webp">
            <img src="<?= $data->getImageUrl(); ?>" alt="">
        </picture>
    </div>
</div>