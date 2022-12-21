<?php
$store = Yii::app()->getModule('store');

foreach ($product->getVariantsColorGroup() as $title => $variantsGroup) {
    $count = 0;
    foreach ($product->getOptionsListForImagesRelation($variantsGroup) as $key => $value) {
        $count++;
        $optionId = $value['variant_id'];
        break;
    }
}

$arrayImage = []; //Только нужные изображения

if (count($product->getImages()) > 0) {
    foreach ($product->getImages() as $image) {
        if ($image->option_color_id && $image->option_color_id == $optionId) {
            $arrayImage[] = [
                'url' => $image->getImageUrl($store->imgWidth, $store->imgHeight),
                'url-small' => $image->getImageUrl($store->smallImgWidth, $store->smallImgHeight),
                'alt' => CHtml::encode($image->alt),
                'title' => CHtml::encode($image->title),
                'option-id' => $image->option_color_id,
            ];
        }
    }
}
?>

<div class="thumbnails" id="thumbnails">
    <?php if ($arrayImage) : ?>
        <div class="thumbnails__small thumbnails-small">
            <?php foreach ($arrayImage as $key => $image) : { ?>
                    <div class="thumbnails-small__item <?= $key === 0 ? 'active' : ''; ?>">
                        <div class="thumbnail js-change-small-image">
                            <img src="<?= $image['url-small']; ?>" data-src-big="<?= $image['url']; ?>" alt="<?= $image['alt'] ?>" title="<?= $image['title'] ?>" width="<?= $store->smallImgWidth ?>" height="<?= $store->smallImgHeight ?>" />
                        </div>
                    </div>
            <?php }
            endforeach; ?>
        </div>
        <div class="thumbnails__preview thumbnails-preview">
            <?php if (Yii::app()->hasModule('favorite')) : ?>
                <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', [
                    'product' => $data,
                    'view' => "favorite-item"
                ]); ?>
            <?php endif; ?>
            <div class="js-thumbnails-preview-slider">
                <?php foreach ($arrayImage as $image) : { ?>
                        <a href="<?= $image['url']; ?>" class="thumbnails-preview__img zoom js-product-zoom" data-fancybox>
                            <img src="<?= $image['url']; ?>" alt="<?= $image['alt'] ?>" title="<?= $image['title'] ?>" data-option-id="<?= $image['option-id'] ?>" itemprop="image" width="<?= $store->imgWidth ?>" height="<?= $store->imgHeight ?>">
                        </a>
                <?php }
                endforeach; ?>
            </div>
            <?php if ($product->discount) : ?>
                <div class="product-view__discount">
                    -<?= str_replace('.00', '', number_format($product->discount, 2, '.', ' ')); ?>%
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="thumbnails__small thumbnails-small">
            <div class="thumbnails-small__item active">
                <div class="thumbnail js-change-small-image">
                    <img src="<?= StoreImage::product($product, $store->smallImgWidth, $store->smallImgHeight); ?>" data-src-big="<?= StoreImage::product($product); ?>" alt="" width="<?= $store->smallImgWidth ?>" height="<?= $store->smallImgHeight ?>" />
                </div>
            </div>
            <?php if (count($product->getImages()) > 0) : ?>
                <?php foreach ($product->getImages() as $key => $image) : { ?>
                        <?php if ($image->option_color_id == $firstColor) : ?>
                            <div class="thumbnails-small__item">
                                <div class="thumbnail js-change-small-image">
                                    <img src="<?= $image->getImageUrl($store->smallImgWidth, $store->smallImgHeight); ?>" data-src-big="<?= $image->getImageUrl(); ?>" alt="<?= CHtml::encode($image->alt) ?>" title="<?= CHtml::encode($image->title) ?>" width="<?= $store->smallImgWidth ?>" height="<?= $store->smallImgHeight ?>" />
                                </div>
                            </div>
                        <?php endif; ?>
                <?php }
                endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="thumbnails__preview thumbnails-preview">
            <div class="js-thumbnails-preview-slider">
                <a href="<?= StoreImage::product($product); ?>" class="thumbnails-preview__img zoom js-product-zoom" data-fancybox>
                    <img src="<?= StoreImage::product($product, $store->imgWidth, $store->imgHeight); ?>" alt="<?= CHtml::encode($product->getImageAlt()); ?>" title="<?= CHtml::encode($product->getImageTitle()); ?>" itemprop="image" width="<?= $store->imgWidth ?>" height="<?= $store->imgHeight ?>">
                </a>
                <?php if (count($product->getImages()) > 0) : ?>
                    <?php foreach ($product->getImages() as $key => $image) : { ?>
                            <?php if ($image->option_color_id == $firstColor) : ?>
                                <a href="<?= $image->getImageUrl(); ?>" class="thumbnails-preview__img zoom js-product-zoom" data-fancybox>
                                    <img src="<?= $image->getImageUrl($store->imgWidth, $store->imgHeight); ?>" alt="<?= CHtml::encode($image->alt) ?>" title="<?= CHtml::encode($image->title) ?>" data-option-id="<?= $image->option_color_id ?>" itemprop="image" width="<?= $store->imgWidth ?>" height="<?= $store->imgHeight ?>">
                                </a>
                            <?php endif; ?>
                    <?php }
                    endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="markers">
                <?php if ($product->is_delivery) : ?>
                    <div class="badge badge-yellow">Бесплатная доставка</div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>