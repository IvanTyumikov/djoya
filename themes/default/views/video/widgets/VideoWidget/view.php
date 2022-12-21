<div class="video-box">
    <?php foreach ($models as $key => $item): ?>
        <?php Yii::app()->controller->renderPartial('//video/video/_view', ['data' => $item]) ?>
    <?php endforeach ?>
</div>
