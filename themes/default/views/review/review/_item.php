<div class="review__list review-list" itemscope itemtype="https://schema.org/Review">
    <div class="review-list__img">
        <img src="<?= $this->mainAssets . '/images/icons/reviews/products/1.png' ?>" alt="">
    </div>
    <div class="review-list__info">
        <div class="review-list__product">
            <a href="/product/denezhnyy-talisman-dengovorot">Денежный талисман "Деньговорот"</a>
        </div>
        <div class="review-list__raiting review-raiting">
            <div class="review-raiting__lists raiting-list" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                <meta itemprop="worstRating" content="1">
                <meta itemprop="ratingValue" content="<?= $data->rating; ?>">
                <meta itemprop="bestRating" content="5" />
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <div class="review-raiting__list raiting-list__item <?= ($i <= $data->rating) ? 'active' : ''; ?>"></div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="review-list__desc" itemprop="reviewBody">
            <?= $data->text; ?>
        </div>
        <div class="review-list__header">
            <div class="review-list__name" itemprop="author" itemscope itemtype="https://schema.org/Person">
                <span itemprop="name">- <?= CHtml::encode($data->username); ?>, </span>
            </div>
            <div class="review-list__date">
                <?= date("d.m.Y", strtotime($data->date_created)); ?>
            </div>
        </div>
        <!-- <div class="review-list__image review-image">
        <?php foreach ($data->images(['order' => 'position DESC']) as $image) : ?>
            <div class="review-image__item">
                <img src="<?= $image->getImageUrl(83, 63, false); ?>" alt="" data-fancybox="image" href="<?= $image->getImageUrl(); ?>" />
            </div>
        <?php endforeach; ?>
    </div> -->
    </div>
</div>