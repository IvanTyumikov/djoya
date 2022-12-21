<div class="header-search">
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
    <!-- <?= CHtml::textField(
                AttributeFilter::MAIN_SEARCH_QUERY_NAME,
                CHtml::encode(Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME)),
                [
                    'class'        => 'header-search__input',
                    'autocomplete' => 'off',
                    'placeholder'  => 'Поиск'
                ]
            ); ?> -->

    <select class="header-search__input js-search-input">
        
    </select>

    <!-- <button type="submit" class="header-search__button btn btn-black">
        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/search-white.svg'); ?>
    </button> -->
    <?php $this->endWidget(); ?>
    <!-- <div class="close-search">
        <?= file_get_contents('.' . Yii::app()->getTheme()->getAssetsUrl() . '/images/icons/close.svg'); ?>
    </div> -->
</div>

<script type="text/javascript">
    $(document).ready(function(){        
        $('.js-search-input').select2({
            ajax: {
              url: '<?= Yii::app()->createUrl('/store/category/search');?>',
              dataType: 'json'               
            },
            placeholder: 'Поиск...',
            minimumInputLength: 3,
         });
        
        $('.js-search-input').on("select2:selecting", function(e) {
            window.location = e.params.args.data.id;
           
        });
    });
     
</script>