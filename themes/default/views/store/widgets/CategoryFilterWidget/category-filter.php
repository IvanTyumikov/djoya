<?php if(!empty($categories)):?>
    <div class="category-filter__lists">
        <?php foreach($categories as $category):?>
            <div class="category-filter__list">
                <?= CHtml::checkBox(
                    'category[]',
                    Yii::app()->attributesFilter->isMainSearchParamChecked(AttributeFilter::MAIN_SEARCH_PARAM_CATEGORY, 
                    $category->id, 
                    Yii::app()->getRequest()),
                    [
                        'value' => $category->id, 
                        'id' => 'category_'. $category->id,
                        'data-url' => $category->getCategoryUrl(),
                ]); ?>
                <?= CHtml::label($category->name, 'category_'. $category->id);?>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>
