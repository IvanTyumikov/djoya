<?php
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id' => 'delivery-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well']
    ]
);
?>

<div class="alert alert-info">
    <?= Yii::t('DeliveryModule.delivery', 'Fields with'); ?>
    <span class="required">*</span>
    <?= Yii::t('DeliveryModule.delivery', 'are required'); ?>
</div>

<?= $form->errorSummary($model); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-7">
                <?= $form->dropDownListGroup(
                    $model,
                    'status',
                    [
                        'widgetOptions' => [
                            'data' => $model->getStatusList(),
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'name'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->dropDownListGroup($model, 'module', [
                    'widgetOptions' => [
                        'data' => Yii::app()->deliveryManager->getSystemsFormattedList(),
                        'htmlOptions' => [
                            'id' => 'delivery-system',
                        ],
                    ]
                ]) ?>
            </div>
        </div>

        <div class="row" id="delivery-system-settings-row" style="display: none;">
            <div class="col-sm-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title">Настройки способа доставки</span>
                    </div>
                    <div class="panel-body" id="delivery-system-settings">
                        <?php $this->renderPartial(
                            '_delivery_system_settings',
                            [
                                'deliverySystem' => $model->module,
                                'deliverySettings' => $model->getDeliverySystemSettings()
                            ]
                        ); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <?= $form->textFieldGroup($model, 'price'); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->textFieldGroup($model, 'free_from'); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->textFieldGroup($model, 'available_from'); ?>
            </div>

        </div>
        <!-- <div class="row">
            <div class="col-sm-7">
                <?php // $form->checkBoxGroup($model, 'separate_delivery'); ?>
            </div>
        </div> -->
        <div class='row'>
            <div class="col-sm-12 <?= $model->hasErrors('description') ? 'has-error' : ''; ?>">
                <?= $form->labelEx($model, 'description'); ?>
                <?php $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'description',
                    ]
                ); ?>
                <p class="help-block"></p>
                <?= $form->error($model, 'description'); ?>
            </div>
        </div>
        <?= $form->hiddenField($model, 'position'); ?>
    </div>
    <?php if (!empty($payments)) :?>
    <div class="col-sm-4">
        <?= $form->checkBoxListGroup(
            $model,
            'payment_methods',
            [
                'widgetOptions' => [
                    'data' => CHtml::listData($payments, 'id', 'name'),
                ],
            ]
        );?>
    </div>
    <?php endif;?>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->getIsNewRecord() ? Yii::t('DeliveryModule.delivery', 'Add delivery and continue') : Yii::t('DeliveryModule.delivery', 'Save delivery and continue'),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->getIsNewRecord() ? Yii::t('DeliveryModule.delivery', 'Add delivery and close') : Yii::t('DeliveryModule.delivery', 'Save delivery and close'),
    ]
); ?>

<?php $this->endWidget(); ?>


<script type="text/javascript">
    $(document).ready(function () {
        $('#delivery-system').change(function () {
            var module = this.value;
            if (module) {
                $.ajax({
                    url: '<?=  Yii::app()->createUrl('/delivery/deliveryBackend/deliverySystemSettings')?>',
                    type: 'get',
                    data: {
                        delivery_id: <?=  $model->id ?: '""'?>,
                        delivery_system: module
                    },
                    success: function (data) {
                        $('#delivery-system-settings').html(data);
                    }
                });
            }
            else {
                $('#delivery-system-settings').html('');
            }
        })
    });

    $(document).ready(function(){
        $('#delivery-system').on('change', function(){
            if($(this).val()) {
                $('#delivery-system-settings-row').show();
            }else{
                $('#delivery-system-settings-row').hide();
            }
        });
        if($('#delivery-system').val()) {
            $('#delivery-system-settings-row').show();
        }
    });
</script>