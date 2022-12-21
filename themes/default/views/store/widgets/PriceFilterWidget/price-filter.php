<?php $filter = Yii::app()->getComponent('attributesFilter');?>
<div class="filter-block filter-price">
    <div class="filter-price__head">
        <span>Цена:</span>
    </div>
    <div class="filter-price__body">
        <div class="filter-price__inputs range-input" id="range-input-price" type="range-input" data-update="#js-range-price">
            <div class="filter-price__input">
                <?= CHtml::numberField('price[from]', Yii::app()->attributesFilter->getMainSearchParamsValue('price', 'from', Yii::app()->getRequest()), [
                    'class' => "form-control js-from-price filter-block-range__item", 
                    'placeholder' => 0,
                ]); ?>
            </div>
            <div class="filter-price__input">
                <?= CHtml::numberField('price[to]', Yii::app()->attributesFilter->getMainSearchParamsValue('price', 'to', Yii::app()->getRequest()), [
                    'class' => "form-control js-to-price filter-block-range__item", 
                    'placeholder' => ceil($cost['price']),
                ]); ?>
            </div>
        </div>
        <div class="filter-price__range range">
            <input type="text" class="js-range" id="js-range-price" name="my_range" value=""
                data-type="double"
                data-min="0"
                data-max="<?= ceil($cost['price']); ?>"
                data-from="0"
                data-to="<?= ceil($cost['price']); ?>"
                data-grid="true"
                data-skin="round"
            />
        </div>
    </div>
</div>