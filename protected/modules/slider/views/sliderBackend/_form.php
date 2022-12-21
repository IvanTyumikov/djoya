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
 *   @var $model Slider
 *   @var $form TbActiveForm
 *   @var $this SliderBackendController
 **/
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm', [
        'id'                     => 'slider-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('SliderModule.slider', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('SliderModule.slider', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

    <div class="row">
        <!--<div class="col-sm-4">
            <?/*=  $form->textFieldGroup($model, 'name_short', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('name_short'),
                        'data-content' => $model->getAttributeDescription('name_short')
                    ]
                ]
            ]); */?>
        </div>-->
        <div class="col-sm-4">
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
        <div class="col-sm-8">
            <?= CHtml::label($model->getAttributeLabel('description'), '') ?>
            <?php $this->widget(
                'yupe\widgets\editors\Textarea',
                [
                    'model'     => $model,
                    'attribute' => 'description',
                    'height' => '150'
                ]
            ); ?>
        </div>
    </div><br>
    <!--<div class="row">
        <div class="col-sm-8">
            <?/*= CHtml::label($model->getAttributeLabel('description_short'), '') */?>
            <?php /*$this->widget(
                'yupe\widgets\editors\Textarea',
                [
                    'model'     => $model,
                    'attribute' => 'description_short',
                    'height' => '150'
                ]
            ); */?>
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-8">
            <?/*= CHtml::label($model->getAttributeLabel('discont'), '') */?>
            <?php /*$this->widget(
                'yupe\widgets\editors\Textarea',
                [
                    'model'     => $model,
                    'attribute' => 'discont',
                    'height' => '150'
                ]
            ); */?>
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-6">
            <?/*= CHtml::label($model->getAttributeLabel('discont_css'), '') */?>
            <?php /*$this->widget(
                'yupe\widgets\editors\Textarea',
                [
                    'model'     => $model,
                    'attribute' => 'discont_css',
                    'height' => '140'
                ]
            ); */?>
        </div>
    </div><br>-->
    <div class="row">
        <!--<div class="col-sm-4">
            <?/*=  $form->textFieldGroup($model, 'button_name', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('button_name'),
                        'data-content' => $model->getAttributeDescription('button_name'),

                    ]
                ]
            ]); */?>
        </div>-->
        <div class="col-sm-4">
            <?=  $form->textFieldGroup($model, 'button_link', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('button_link'),
                        'data-content' => $model->getAttributeDescription('button_link')
                    ]
                ]
            ]); ?>
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

            <?= $form->fileFieldGroup($model, 'image'); ?>

        </div>
    </div>
    <div class='row'>
        <div class="col-sm-7">
            <?php
            echo CHtml::image(
                !$model->isNewRecord && $model->image_xs ? $model->getImageXsUrl(100, 100) : '#',
                $model->name,
                [
                    'class' => 'preview-image',
                    'style' => !$model->isNewRecord && $model->image_xs ? '' : 'display:none',
                ]
            ); ?>

            <?php if (!$model->isNewRecord && $model->image_xs): ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="delete-file2"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                    </label>
                </div>
            <?php endif; ?>

            <?= $form->fileFieldGroup($model, 'image_xs'); ?>

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
            'label'      => Yii::t('SliderModule.slider', 'Сохранить слайд и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('SliderModule.slider', 'Сохранить слайд и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>