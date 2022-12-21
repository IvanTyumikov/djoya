<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 *
 *   @var $model Video
 *   @var $form TbActiveForm
 *   @var $this VideoBackendController
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
    <?=  Yii::t('VideoModule.video', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('VideoModule.video', 'обязательны.'); ?>
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
            <?=  $form->textAreaGroup($model, 'code', [
            'widgetOptions' => [
                'htmlOptions' => [
                    'class' => 'popover-help',
                    'rows' => 6,
                    'cols' => 50,
                    'data-original-title' => $model->getAttributeLabel('code'),
                    'data-content' => $model->getAttributeDescription('code')
                ]
            ]]); ?>
        </div>
    </div>
    <div class='row'>
        <div class="col-sm-7">
            <?php
            echo CHtml::image(
                !$model->isNewRecord && $model->image ? $model->getImageUrl(100, 100) : '#',
                $model->name,
                [
                    'class' => 'preview-image',
                    'style' => !$model->isNewRecord && $model->image ? '' : 'display:none',
                ]
            ); ?>

            <?php if (!$model->isNewRecord && $model->image): ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="delete-file"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                    </label>
                </div>
            <?php endif; ?>

            <?= $form->fileFieldGroup(
                $model,
                'image',
                [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'onchange' => 'readURL(this);',
                            'style' => 'background-color: inherit;',
                        ],
                    ],
                ]
            ); ?>
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
            'label'      => Yii::t('VideoModule.video', 'Сохранить видео и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('VideoModule.video', 'Сохранить видео и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>