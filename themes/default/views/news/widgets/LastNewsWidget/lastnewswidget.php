<?php if (isset($models) && $models != []): ?>
    <div class="news">
        <div class="container">
            <div class="news__top title_top">
                <div class="news__title title">Статьи Телтос</div>
                <a href="<?= Yii::app()->createUrl('/news/news/index');?>" class="news__cat-link title_top__link button-white">
                    <span>Все статьи</span>
                    <i class="icon-arrow-next"></i>
                </a>
            </div>
            <div class="news__main">
                <div class="news__row news-slider">
                    <?php foreach ($models as $key => $model): ?>
                        <div class="news__col news-box">
                            <div class="news-box__row">
                                <a href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $model->slug]); ?>" class="news-box__img">
                                    <img src="<?= $model->getImageUrl(450, 240) ?>" alt="">
                                </a>
                                <span class="news-box__date"><?= Yii::app()->dateFormatter->format("dd MMMM yyyy", $model->date); ?></span>
                                <a href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $model->slug]); ?>" class="news-box__title"><?= $model->title ?></a>
                            </div>
                            <a href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $model->slug]); ?>" class="news-box__link-more">
                                <span>Читать далее</span>
                                <i class="icon-arrow-down"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
