<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Nikkable
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     https://vk.com/nikkable
 *
 *   @var $model Quest
 *   @var $form TbActiveForm
 *   @var $this QuestBackendController
 **/
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm', [
        'id'                     => 'generators-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('QuestModule.quest', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('QuestModule.quest', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>
    
    <!-- <div class="row">
        <div class="col-sm-7">
            <?=  $form->dropDownListGroup($model, 'category_id', [
                'widgetOptions' => [
                    'data' => $model->getCategoryList(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('category_id'),
                        'data-content' => $model->getAttributeDescription('category_id'),
                        'empty' => '--Выберите категорию --'
                    ]
                ]
            ]); ?>
        </div>
    </div> -->
    
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
            <?=  $form->textAreaGroup($model, 'body', [
            'widgetOptions' => [
                'htmlOptions' => [
                    'class' => 'popover-help',
                    'rows' => 6,
                    'cols' => 50,
                    'data-original-title' => $model->getAttributeLabel('body'),
                    'data-content' => $model->getAttributeDescription('body')
                ]
            ]]); ?>
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

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('QuestModule.quest', 'Сохранить и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('QuestModule.quest', 'Сохранить и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>