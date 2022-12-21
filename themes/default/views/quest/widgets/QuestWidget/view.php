<div class="quest" itemscope itemtype="https://schema.org/FAQPage">
    <div class="container">
        <div class="quest__top title">
            Часто задаваемые <span class="title__green"> <br>вопросы</span>
        </div>
        <div class="quest__main js-quest">
            <?php foreach ($models as $key => $item): ?>
                <?php Yii::app()->controller->renderPartial('//quest/quest/_view', ['data' => $item]) ?>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php Yii::app()->getClientScript()->registerScript(__FILE__, "
    $('.js-quest .quest-item__head').click(function(e){
        let elem = $(this),
            parent = elem.parent();

        if(parent.hasClass('active')){
            parent.removeClass('active');
        } else{
            $('.js-quest .quest-item').removeClass('active');
            parent.addClass('active');
        }
    })
") ?>
