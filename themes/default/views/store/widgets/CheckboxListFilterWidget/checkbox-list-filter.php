<?php $filter = Yii::app()->getComponent('attributesFilter');?>
<div class="filter-block">
    <div class="filter-block__header">
        <?php //выводим тип товара ?>
        <div class="filter-block__heading">
            <i class="icon-arrow-up"></i>
            <span><?= $attribute->title;?></span>
            <button type="reset" class="filter-block__heading-reset button-reset">
                <i class="icon-close"></i>
            </button>
        </div>
    </div>
    <div class="filter-block__body filter-block__attribute">
        <div class="filter-block__list">
            <?php //атрибуты товаров - фильтрация ?>
            <?php $count = 1; ?>
            <?php foreach ($attribute->options as $option): ?>
                <div class="filter-block__item filter-checkbox filter-list <?= ($count <= 5) ? '' : 'hidden'; ?>">
                    <?= CHtml::checkBox($filter->getDropdownOptionName($option), $filter->getIsDropdownOptionChecked($option, $option->id), [
                        'value' => $option->id,
                        'id' => $attribute->name."_".$option->id
                    ]) ?>
                    <?= CHtml::label(
                        '<span class="check">
                            <i class="icon-checked"></i>
                        </span>
                        <span>' . $option->value . '</span>', 
                        $attribute->name."_".$option->id);
                    ?>
                </div>
                <?php $count++; ?>
            <?php endforeach;?>

            <?php //если элементов больше 6, показываем "Показать все" ?>
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