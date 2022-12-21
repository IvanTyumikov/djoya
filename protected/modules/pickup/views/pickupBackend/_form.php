<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 *
 *   @var $model Pickup
 *   @var $form TbActiveForm
 *   @var $this PickupBackendController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'                     => 'pickup-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => [],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('PickupModule.pickup', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('PickupModule.pickup', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->select2Group($model, 'address', [
                'widgetOptions' => [
                    'asDropDownList' => false,
                    'options' => [
                        'minimumInputLength' => 3,
                        'ajax' => [
                            'url' => Yii::app()->createUrl('/cart/dadata/getAddress'),
                            'quietMillis' => 1000,
                            'data' => 'js:function(res) {
                                return {query: res};
                            }',
                            'results' => 'js: function(res) {
                                return res;
                            }'
                        ],
                    ],
                    'events' => [
                        'change.select2' => 'js:function(e) {
                            $("input[name=\"Pickup[address]\"]").val(e.added.text);
                            if ($("input[name=\"Pickup[name]\"]").val()===""){
                                $("input[name=\"Pickup[name]\"]").val(e.added.text);
                            }
                            if (e.added.data.geo_lat) {
                                $("input[name=\"Pickup[latitude]\"]").val(e.added.data.geo_lat);
                            }
                            if (e.added.data.geo_lon) {
                                $("input[name=\"Pickup[longitude]\"]").val(e.added.data.geo_lon);
                            }
                        }'
                    ],
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="well">
                <h4>Яндекс карты</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <?=  $form->textFieldGroup($model, 'latitude', [
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'class' => 'popover-help',
                                    'data-original-title' => $model->getAttributeLabel('latitude'),
                                    'data-content' => $model->getAttributeDescription('latitude')
                                ]
                            ]
                        ]); ?>
                    </div>
                    <div class="col-sm-6">
                        <?=  $form->textFieldGroup($model, 'longitude', [
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'class' => 'popover-help',
                                    'data-original-title' => $model->getAttributeLabel('longitude'),
                                    'data-content' => $model->getAttributeDescription('longitude')
                                ]
                            ]
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'name', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('name'),
                        'data-content' => $model->getAttributeDescription('name')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->dropDownListGroup($model, 'status', [
                'widgetOptions' => [
                    'data' => $model->getStatusList(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('status'),
                        'data-content' => $model->getAttributeDescription('status')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textAreaGroup($model, 'description', [
            'widgetOptions' => [
                'htmlOptions' => [
                    'class' => 'popover-help',
                    'rows' => 6,
                    'cols' => 50,
                    'data-original-title' => $model->getAttributeLabel('description'),
                    'data-content' => $model->getAttributeDescription('description')
                ]
            ]]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'mode', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('mode'),
                        'data-content' => $model->getAttributeDescription('mode')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'phone', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('phone'),
                        'data-content' => $model->getAttributeDescription('phone')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'email', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('email'),
                        'data-content' => $model->getAttributeDescription('email')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('PickupModule.pickup', 'Сохранить точку и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('PickupModule.pickup', 'Сохранить точку и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>