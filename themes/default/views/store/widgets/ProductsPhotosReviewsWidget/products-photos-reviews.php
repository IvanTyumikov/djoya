<?php $data = $dataProvider->getData(); ?>

<?php
// echo ('<pre>');
// print_r($data);
// exit;
?>

<?php if (count($data) > 0) : ?>
    <div class="review__slider review-slider review-slider-stories <?= $js_class ?>">
        <?php foreach ($data as $key => $item) : ?>
            <?php
            // echo ('<pre>');
            // print_r($item);
            // exit;
            ?>
            <?php $path = $item->path; ?>
            <div class="review-item review-item-full">
                <a href="<?= $path ?>" data-fancybox="reviews" data-width="463" data-height="824">
                    <img src="<?= $path ?>" alt="<?= $item->alt; ?>" title="<?= $item->title; ?>">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>