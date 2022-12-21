<?php $filter = Yii::app()->getComponent('attributesFilter');?>
<div class="filter-block">
    <div class="filter-block__header">
        <?php //выводим тип товара ?>
        <div class="filter-block__heading">
            <i class="icon-arrow-up"></i>
            <span><?= $attribute->title;?></span>
            </button>
        </div>
    </div>
    <div class="filter-block__body filter-block__attribute">
        <div class="filter-block__list">
            <div class="filter-block__item filter-checkbox filter-list <?= ($count <= 5) ? '' : 'hidden'; ?>">
               <?= CHtml::textField($filter->getFieldName($attribute), $filter->getFieldValue($attribute), ['class' => 'form-control']) ?>
            </div>
        </div>
    </div>
</div>
