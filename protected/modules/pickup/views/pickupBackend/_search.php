<?php
/**
 * Отображение для _search:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'action'      => Yii::app()->createUrl($this->route),
        'method'      => 'get',
        'type'        => 'vertical',
        'htmlOptions' => ['class' => 'well'],
    ]
);
?>

<fieldset>
    <div class="row">
        <div class="col-sm-3">
            <?=  $form->textFieldGroup($model, 'id', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('id'),
                        'data-content' => $model->getAttributeDescription('id')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
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
		<div class="col-sm-3">
            <?=  $form->textFieldGroup($model, 'address', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('address'),
                        'data-content' => $model->getAttributeDescription('address')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
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
		<div class="col-sm-3">
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
		<div class="col-sm-3">
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
		<div class="col-sm-3">
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
		<div class="col-sm-3">
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
		<div class="col-sm-3">
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
		<div class="col-sm-3">
            <?=  $form->textFieldGroup($model, 'status', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('status'),
                        'data-content' => $model->getAttributeDescription('status')
                    ]
                ]
            ]); ?>
        </div>
		    </div>
</fieldset>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'context'     => 'primary',
            'encodeLabel' => false,
            'buttonType'  => 'submit',
            'label'       => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t('PickupModule.pickup', 'Искать точку'),
        ]
    ); ?>

<?php $this->endWidget(); ?>