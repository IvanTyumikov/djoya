<?php
/**
 * Отображение для _search:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
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
            <?=  $form->textFieldGroup($model, 'user_id', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('user_id'),
                        'data-content' => $model->getAttributeDescription('user_id')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?=  $form->dateTimePickerGroup($model,'date_created', [
            'widgetOptions' => [
                'options' => [],
                'htmlOptions'=>[]
            ],
            'prepend'=>'<i class="fa fa-calendar"></i>'
        ]); ?>
        </div>
		<div class="col-sm-3">
            <?=  $form->textAreaGroup($model, 'text', [
            'widgetOptions' => [
                'htmlOptions' => [
                    'class' => 'popover-help',
                    'rows' => 6,
                    'cols' => 50,
                    'data-original-title' => $model->getAttributeLabel('text'),
                    'data-content' => $model->getAttributeDescription('text')
                ]
            ]]); ?>
        </div>
		<div class="col-sm-3">
            <?=  $form->textFieldGroup($model, 'moderation', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('moderation'),
                        'data-content' => $model->getAttributeDescription('moderation')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?=  $form->textFieldGroup($model, 'username', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('username'),
                        'data-content' => $model->getAttributeDescription('username')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?=  $form->textFieldGroup($model, 'image', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('image'),
                        'data-content' => $model->getAttributeDescription('image')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?=  $form->textFieldGroup($model, 'useremail', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('useremail'),
                        'data-content' => $model->getAttributeDescription('useremail')
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
            'label'       => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t('ReviewModule.review', 'Искать Отзыв'),
        ]
    ); ?>

<?php $this->endWidget(); ?>