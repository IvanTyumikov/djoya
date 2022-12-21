<?php
    $store = Yii::app()->getModule('store');

    $arrayImage = [];

    if(count($product->getImages()) > 0){
        foreach ($product->getImages() as $image){
            if($image->option_color_id && $image->option_color_id == $optionId){
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

<?php if ($arrayImage): ?>
    <div class="thumbnails__small thumbnails-small">
        <?php foreach ($arrayImage as $key => $image): { ?>
            <div class="thumbnails-small__item <?= $key === 0 ? 'active' : ''; ?>">
                <div class="thumbnail js-change-small-image">
                    <img src="<?= $image['url-small']; ?>"
                    data-src-big="<?= $image['url']; ?>"
                    alt="<?= $image['alt'] ?>"
                    title="<?= $image['title'] ?>"
                    width="<?= $store->smallImgWidth ?>"
                    height="<?= $store->smallImgHeight ?>"/>
                </div>
            </div>
        <?php } endforeach; ?>
    </div>
    <div class="thumbnails__preview thumbnails-preview">
        <div class="js-thumbnails-preview-slider">
            <?php foreach ($arrayImage as $image): { ?>
                <a href="<?= $image['url']; ?>" class="thumbnails-preview__img zoom js-product-zoom" data-fancybox>
                    <img src="<?= $image['url']; ?>"
                    alt="<?= $image['alt'] ?>"
                    title="<?= $image['title'] ?>"
                    data-option-id="<?= $image['option-id'] ?>"
                    itemprop="image"
                    width="<?= $store->imgWidth ?>"
                    height="<?= $store->imgHeight ?>">
                </a>
            <?php } endforeach; ?>
        </div>
        <?php if($product->discount): ?>
            <div class="product-view__discount">
                -<?= str_replace('.00', '', number_format($product->discount, 2, '.', ' ')); ?>%
            </div>
        <?php endif; ?>
    </div>

    <?php if ($product->is_delivery): ?>                
        <div class="badge badge-yellow">Бесплатная доставка</div>
    <?php endif; ?>
    
<?php else: ?>
    <div class="thumbnails__error">Изображения отсутствуют</div>
<?php endif; ?>

