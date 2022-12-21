<div class="filter-search">
    <div class="filter-search__head">
        <?= Yii::t('StoreModule.store', 'Поиск'); ?>
    </div>
    <div class="filter-search__body">
        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            [
                'action' => ['/store/product/index'],
                'method' => 'GET',
                'htmlOptions' => [
                    'class' => 'filter-search__form'
                ]
            ]
        ) ?>
            <div class="filter-search__input-group">
                <?= CHtml::textField(
                    AttributeFilter::MAIN_SEARCH_QUERY_NAME,
                    CHtml::encode(Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME)),
                    [
                        'class' => 'form-control filter-search__input', 
                        'placeholder' => 'Введите ваш запрос, например "Рычажный комплект”', 
                        'autocomplete' =>'off'
                    ]
                ); ?>
                <button type="submit" class="filter-search__but">
                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/filter-search.svg'); ?>
                </button>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
