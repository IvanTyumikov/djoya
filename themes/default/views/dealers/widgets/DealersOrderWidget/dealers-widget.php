<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
    'id'=>'dealers-page-form',
    'type' => 'vertical',
    'htmlOptions' => ['class' => 'form dealers-form', 'data-type' => 'ajax-form'],
]); ?>
    <div class="dealers-form__header">
        Заявка о партнерстве
    </div>
    <?php if (Yii::app()->user->hasFlash('dealers-success')): ?>
        <script>
            $('#messageModal').modal('show');
            setTimeout(function(){
                $('#messageModal').modal('hide');
            }, 4000);
        </script>
    <?php endif ?>
    
    <div class="dealers-form-box">
        <div class="dealers-form-box__item">
            <?= $form->textFieldGroup($model, 'company', [
                'widgetOptions'=>[
                    'htmlOptions'=>[
                        'class' => '',
                        'autocomplete' => 'off'
                    ]
                ],
            ]); ?>
        </div>
    </div>
    <?= $form->textFieldGroup($model, 'city', [
        'widgetOptions'=>[
            'htmlOptions'=>[
                'class' => '',
                'autocomplete' => 'off'
            ]
        ],
    ]); ?>
    <?= $form->textFieldGroup($model, 'email', [
        'widgetOptions'=>[
            'htmlOptions'=>[
                'class' => '',
                'autocomplete' => 'off'
            ]
        ],
    ]); ?>
    <?= $form->textFieldGroup($model, 'name', [
        'widgetOptions'=>[
            'htmlOptions'=>[
                'class' => '',
                'autocomplete' => 'off'
            ]
        ],
    ]); ?>
    <div class="form-group">
        <?= $form->labelEx($model, 'phone', ['class' => 'control-label']) ?>
        <?php $this->widget('CMaskedTextFieldPhone', [
            'model' => $model,
            'attribute' => 'phone',
            'mask' => '+7(999)999-99-99',
            'htmlOptions'=>[
                'class' => 'data-mask form-control',
                'data-mask' => 'phone',
                'placeholder' => 'Телефон',
                'autocomplete' => 'off'
            ]
        ]) ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>
    <?= $form->textFieldGroup($model, 'site', [
        'widgetOptions'=>[
            'htmlOptions'=>[
                'class' => '',
                'autocomplete' => 'off'
            ]
        ],
    ]); ?>
    
    <div class="form-group-radio form-group-pl">
        <?php $model->is_pl = ($model->is_pl) ? $model->is_pl : 1;?>
        <?= $form->labelEx($model, 'is_pl'); ?>
        <div class="input-group radio-list">
            <?= $form->radioButtonList($model, 'is_pl', $model->getIsPlList(),[
                'template'=>'<div class="radio-inline">{input}{label}</div>',
                'separator' => ''
            ]) ?>
        </div>
        <?= $form->error($model, 'is_pl');?>
    </div>

    <div class="is-pl-box">
        <div class="is-pl-box__item is-pl-box__item_1 <?= ($model->is_pl == 1) ? 'active' : ''; ?>">
            <?= $form->textFieldGroup($model, 'pl1_nazv', [
                'widgetOptions'=>[
                    'htmlOptions'=>[
                        'class' => '',
                        'autocomplete' => 'off'
                    ]
                ],
            ]); ?>
            <?= $form->textFieldGroup($model, 'pl1_all_area', [
                'widgetOptions'=>[
                    'htmlOptions'=>[
                        'class' => '',
                        'autocomplete' => 'off'
                    ]
                ],
            ]); ?>
            <?= $form->textFieldGroup($model, 'pl1_area', [
                'widgetOptions'=>[
                    'htmlOptions'=>[
                        'class' => '',
                        'autocomplete' => 'off'
                    ]
                ],
            ]); ?>
        </div>
        <div class="is-pl-box__item is-pl-box__item_2 <?= ($model->is_pl == 2) ? 'active' : ''; ?>">
            <?= $form->textFieldGroup($model, 'pl2_nazv_tc', [
                'widgetOptions'=>[
                    'htmlOptions'=>[
                        'class' => '',
                        'autocomplete' => 'off'
                    ]
                ],
            ]); ?>
            <?= $form->textFieldGroup($model, 'pl2_nazv', [
                'widgetOptions'=>[
                    'htmlOptions'=>[
                        'class' => '',
                        'autocomplete' => 'off'
                    ]
                ],
            ]); ?>
            <?= $form->textFieldGroup($model, 'pl2_all_area', [
                'widgetOptions'=>[
                    'htmlOptions'=>[
                        'class' => '',
                        'autocomplete' => 'off'
                    ]
                ],
            ]); ?>
            <?= $form->textFieldGroup($model, 'pl2_area', [
                'widgetOptions'=>[
                    'htmlOptions'=>[
                        'class' => '',
                        'autocomplete' => 'off'
                    ]
                ],
            ]); ?>
        </div>
    </div>
    
    <?= $form->textFieldGroup($model, 'count_personal', [
        'widgetOptions'=>[
            'htmlOptions'=>[
                'class' => '',
            ]
        ]
    ]); ?>
    <?= $form->textAreaGroup($model, 'comment', [
        'widgetOptions'=>[
            'htmlOptions'=>[
                'class' => '',
            ]
        ]
    ]); ?>

    <?= $form->hiddenField($model, 'verify'); ?>

    <div class="form-bot fl fl-wr-w fl-al-it-c">
        <div class="form-button">
            <button class="but but-yellow" id="writetous-modal-button" data-send="ajax">Отправить</button>
        </div>
        <div class="terms_of_use"> 
            * Оставляя заявку вы соглашаетесь с <a target="_blank" href="<?php $this->widget("application.modules.contentblock.widgets.ContentMyBlockWidget", ["id" => 14]); ?>">Условиями обработки персональных данных</a>
         </div>
    </div>
<?php $this->endWidget(); ?>

<?php Yii::app()->getClientScript()->registerScript("is-pl-my", "
    // $('.form-group-pl .radio-inline:first input[type=radio]').prop('checked', true);
    // $('.is-pl-box .is-pl-box__item:first').addClass('active');
    $(document).delegate('.form-group-pl input[type=radio]', 'click', function(){
        var id = $(this).val();
        $('.form-group-pl input[type=radio]').prop('checked', false);
        $('.is-pl-box .is-pl-box__item').removeClass('active');
        $(this).prop('checked', true);
        $('.is-pl-box').find('.is-pl-box__item_'+id).addClass('active');
    });
"); ?>