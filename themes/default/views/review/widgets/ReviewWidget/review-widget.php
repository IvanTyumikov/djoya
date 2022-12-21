<?php $totalElements = count($models); ?>
<div class="review__slider review-slider <?= $this->js_class ?>">
    <?php foreach ($models as $key => $model): ?>
        <div class="review-item">
            <div class="review-item__info">
                <div class="review-item__head">
                    <div class="review-item__name"><?= CHtml::encode( $model->username); ?></div>
                    <div class="review-item__date"><?= date("d.m.Y", strtotime($model->date_created)); ?></div>
                </div>
                <div class="review-item__desc">
                    <?= $model->text; ?>
                </div>
<!--                <a href="/" class="review-item__more">Читать весь отзыв</a>-->
            </div>
            <div class="review-item__images">
                <?php foreach ($model->images(['order' => 'position DESC']) as $image): ?>
                    <div class="review-item__image">
                        <picture>
                            <source srcset="<?= $image->getImageUrlWebp(83, 63); ?>" type="image/webp">
                            <img src="<?= $image->getImageUrl(83, 63); ?>" alt="">
                        </picture>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
