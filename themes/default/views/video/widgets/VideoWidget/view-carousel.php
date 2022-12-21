<div class="video__main video-slider js-video-slider">
    <?php foreach ($models as $key => $item): ?>
        <?php Yii::app()->controller->renderPartial('//video/video/_view', ['data' => $item]) ?>
    <?php endforeach ?>
</div>