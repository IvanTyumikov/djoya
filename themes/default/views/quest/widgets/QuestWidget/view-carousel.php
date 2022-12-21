<div class="quest" itemscope itemtype="https://schema.org/FAQPage">
    <div class="container">
        <div class="quest__top title">
            Часто задаваемые <span class="title__green"> <br>вопросы</span>
        </div>
        <div class="quest__main js-quest">
            <?php foreach ($models as $key => $item): ?>
                <?php Yii::app()->controller->renderPartial('//video/video/_view', ['data' => $item]) ?>
            <?php endforeach ?>
        </div>
    </div>
</div>
