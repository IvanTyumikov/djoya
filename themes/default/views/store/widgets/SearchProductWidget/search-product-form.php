<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'action' => ['/store/product/index'],
        'method' => 'GET',
        'htmlOptions' => [
            'class'  => 'form-inline form-search'
        ]
    ]
) ?>
    <div class="input-group search-input-group">
        <?= CHtml::textField(AttributeFilter::MAIN_SEARCH_QUERY_NAME, CHtml::encode(Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME)),
            [
                'class'        => 'form-control', 
                'autocomplete' => 'off',
                'placeholder'  => 'Введите ваш запрос, например "Саженцы"'
            ]
        ); ?>
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/search.svg'); ?>
            </button>
        </span>
    </div>
<?php $this->endWidget(); ?>