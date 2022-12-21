<?php if ($brands): ?>
    <div class="producers">
        <div class="container">
            <div class="producers__top title_top">
                <div class="producers__title title">Бренды производителей</div>
                <a href="<?= Yii::app()->createUrl('/store/product/index');?>" class="producers__cat-link link-arrow">
                    <span>Смотреть все</span>
                    <i class="icon-arrow-next"></i>
                </a>
            </div>
            <div class="producers__main producers-slider">
                <?php foreach ($brands as $i => $brand): ?>
                    <div class="producers__item">
                        <?= CHtml::image($brand->getImageUrl(201, 86), ''); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>