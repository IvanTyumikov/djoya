<div class="search-product-header-mobile">
    <?php $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        [
            'action' => ['/store/product/index'],
            'method' => 'GET',
            'htmlOptions' => [
                'class' => 'header-search__main'
            ]
        ]
    ) ?>
        <input autocomplete="off" type="text" class="search-product-header-mobile__input" placeholder="Поиск по каталогу" name="q" id="q">
        <button type="submit" class="search-product-header-mobile__button">
            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/mobile/icon-search.svg'); ?>
        </button>
    <?php $this->endWidget(); ?>
</div>
