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
 *   @var $model QuestCategory
 *   @var $form TbActiveForm
 *   @var $this QuestCategoryBackendController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id'                     => 'video-category-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => ['class' => 'well'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('QuestModule.quest', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('QuestModule.quest', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

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