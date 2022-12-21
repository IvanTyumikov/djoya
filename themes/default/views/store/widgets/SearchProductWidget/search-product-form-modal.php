<div id="search-form-Modal" class="search-form-Modal modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    [
                        'action' => ['/store/product/search'],
                        'method' => 'GET',
                    ]
                ) ?>
                    <div class="input-group">
                        <?= CHtml::textField(
                            AttributeFilter::MAIN_SEARCH_QUERY_NAME,
                            CHtml::encode(Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME)),
                            ['class' => 'form-control', 'placeholder' => 'Поиск', 'autocomplete' =>'off']
                        ); ?>

                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                        <div class="search-form-Modal__close" data-dismiss="modal">
                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/filter-close.svg'); ?>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>