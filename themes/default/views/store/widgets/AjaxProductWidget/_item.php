<div class="pr-slider__item pr-slider-box">
    <a href="<?= ProductHelper::getUrl($data); ?>" class="pr-slider-box__img">
        <img src="<?= StoreImage::product($data, 230, 174, false); ?>"
             alt="<?= CHtml::encode($data->getImageAlt()); ?>"
             title="<?= CHtml::encode($data->getImageTitle()); ?>">
        <?php $count = 0; ?>
        <?php foreach ($data->categories as $key => $categ) : ?>
            <?php $categoryIds = Yii::app()->getModule('store')->getBadge($categ); ?>
            <?php if($categoryIds) : ?>
                <div class="product-box__badge product-badge product-badge-<?= $categoryIds->id; ?> <?= ($count == 0) ? '' : 'hidden'; ?>">
                    <span class="product-badge__svg">
                        <span><?= $categoryIds->name; ?></span>
                        <?= $categoryIds->name_desc; ?>
                    </span>
                </div>
                <?php $count++; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if($count > 1) : ?>
            <div class="product-type-arrow hidden"></div>
        <?php endif; ?>
    </a>
    <?php if ($data->hasDiscount()) : ?>
        <div class="pr-slider-box__price">
            <div class="pr-slider-box__price-new">
                <strong><?= str_replace('.00', '', number_format($data->getResultPrice(), 0, '.', ' ')); ?></strong>
                <span>₽</span>
            </div>
            <div class="pr-slider-box__price-old">
                <span class="pr-slider-box__discount">-15%</span>
                <strong><?= str_replace('.00', '', number_format($data->getBasePrice(), 2, '.', ' ')); ?></strong>
                <span>₽</span>
            </div>
        </div>
    <?php else: ?>
        <div class="pr-slider-box__price">
            <div class="pr-slider-box__price-base">
                <strong><?= str_replace('.00', '', number_format($data->getBasePrice(), 2, '.', ' ')); ?></strong>
                <span>₽</span>
            </div>
        </div>
    <?php endif; ?>
    <a href="<?= ProductHelper::getUrl($data); ?>" class="pr-slider-box__name"><?= $data->getName() ?></a>
</div>