<?php if(!empty($producers)):?>
    <div class="filter-block">
        <div class="filter-block__header">
            <?php //выводим тип товара ?>
            <div class="filter-block__heading">
                <i class="icon-arrow-up"></i>
                <span>Производители</span>
                <button type="reset" class="filter-block__heading-reset button-reset">
                    <i class="icon-close"></i>
                </button>
            </div>
        </div>
        <div class="filter-block__body">
            <div class="filter-block__list">
                <?php $count = 1; ?>
                <?php foreach($producers as $producer):?>
                    <div class="filter-block__item filter-checkbox filter-list">
                        <?= CHtml::checkBox('brand[]',Yii::app()->attributesFilter->isMainSearchParamChecked(AttributeFilter::MAIN_SEARCH_PARAM_PRODUCER, $producer->id, Yii::app()->getRequest()),['value' => $producer->id, 'id' => 'brand_'.$producer->id]);?>
                        <?= CHtml::label('<span class="check"><i class="icon-checked"></i></span><span>'.$producer->name.'</span>', 'brand_'.$producer->id);?>
                    </div>
                    <?php $count++; ?>
                <?php endforeach;?>
                <?php if($count > 6) : ?>
                    <div class="filter-block__footer">
                        <a class="filter-block__more but-more" href="#">
                            <span data-text="Скрыть">Показать все</span>
                            <i class="icon-arrow-down"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif;?>
