<?php if(!empty($category)):?>
    <div class="pop-categories">
        <ul>
            <?php 
                $count = 0;
                foreach ($category as $key => $data) : 
                $count++;
                $ajaxChecked = Yii::app()->attributesFilter->isMainSearchParamChecked(AttributeFilter::MAIN_SEARCH_PARAM_CATEGORY, $data->id, Yii::app()->getRequest());
                $checked = false;
                if($count == 1 && $ajaxChecked == false){
                    $checked = true;
                } else if ($ajaxChecked == true){
                    $checked = true;
                }
            ?>
                <li>
                    <?= CHtml::checkBox('category[]', $checked, [
                            'value' => $data->id,
                            'id' => 'category_'. $data->id,
                            'checked' => true
                        ]) ?>
                    <?= CHtml::label($data->name, 'category_'. $data->id);?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif;?>