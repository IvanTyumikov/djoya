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
 *   @var $model City
 *   @var $form TbActiveForm
 *   @var $this CityBackendController
 **/
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab">Общие</a></li>
    <li><a href="#seo" data-toggle="tab">Данные для поисковой оптимизации</a></li>
</ul>
<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        'id' => 'city-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>

<div class="alert alert-info">
    <?=  Yii::t('CityModule.city', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('CityModule.city', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="common">

        <div class="row">
            <div class="col-sm-4">
                <?=  $form->dropDownListGroup($model, 'category_id', [
                    'widgetOptions' => [
                        'data' => $model->getCategoryList(),
                        'htmlOptions' => [
                            'empty' => '---',
                            'encode' => false,
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('category_id'),
                            'data-content' => $model->getAttributeDescription('category_id')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->dropDownListGroup(
                    $model,
                    'parent_id',
                    [
                        'widgetOptions' => [
                            'data' => $model->getFormattedList(),
                            'htmlOptions' => [
                                'empty' => '--нет--',
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'name_short', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('name_short'),
                            'data-content' => $model->getAttributeDescription('name_short')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
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
        <div class='row'>
            <div class="col-sm-8">
                <?= $form->slugFieldGroup($model, 'slug', ['sourceAttribute' => 'name']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
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
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'phone', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('phone'),
                            'data-content' => $model->getAttributeDescription('phone')
                        ]
                    ]
                ]); ?>
                <?=  $form->error($model, 'phone'); ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'address', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('address'),
                            'data-content' => $model->getAttributeDescription('address')
                        ]
                    ]
                ]); ?>
                <?=  $form->error($model, 'address'); ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'email', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('email'),
                            'data-content' => $model->getAttributeDescription('email')
                        ]
                    ]
                ]); ?>
                <?=  $form->error($model, 'email'); ?>
            </div>
        </div>       
        <br>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textAreaGroup($model, 'code_map', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'rows' => 6,
                        'cols' => 50,
                        'data-original-title' => $model->getAttributeLabel('code_map'),
                        'data-content' => $model->getAttributeDescription('code_map')
                    ]
                ]]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'coords', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('coords'),
                            'data-content' => $model->getAttributeDescription('coords')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 popover-help" data-original-title='<?= $model->getAttributeLabel('description'); ?>'
                 data-content='<?= $model->getAttributeDescription('description'); ?>'>
                <?= $form->labelEx($model, 'description'); ?>
                <?php
                $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'description',
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?=  $form->textFieldGroup($model, 'vk', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('vk'),
                            'data-content' => $model->getAttributeDescription('vk')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
                <?=  $form->textFieldGroup($model, 'instagram', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('instagram'),
                            'data-content' => $model->getAttributeDescription('instagram')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
                <?=  $form->textFieldGroup($model, 'facebook', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('facebook'),
                            'data-content' => $model->getAttributeDescription('facebook')
                        ]
                    ]
                ]); ?>
            </div>
            <!-- <div class="col-sm-3">
                <?php /*=  $form->textFieldGroup($model, 'ok', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('ok'),
                            'data-content' => $model->getAttributeDescription('ok')
                        ]
                    ]
                ]);*/ ?>
            </div> -->
        </div>
        <div class="row">
            <div class="col-sm-8">
                 <?php if (!$model->isNewRecord && $model->price_file): ?>
                    <label for="">Прайс:</label>
                    <a target="_blank" href="<?= $model->getPathPriceFile(); ?>">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        <?= $model->price_file; ?>
                    </a>
                    <br>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="delete-file-price"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                        </label>
                    </div>
                <?php endif; ?>

                <?= $form->fileFieldGroup($model, 'priceFile'); ?>
            </div>
        </div>

        
        <div class="row">
            <div class="col-sm-8">
                <?= $form->checkBoxGroup($model, 'is_default'); ?>
            </div>
        </div>
        

        <div class='row'>
            <div class="col-sm-7">
                <?php
                echo CHtml::image(
                    !$model->isNewRecord && $model->image ? $model->getImageUrl(100, 100) : '#',
                    '',
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

        <div class="row">
            <div class="col-sm-8">
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
   </div>
    <div class="tab-pane" id="seo">
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'meta_title', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('meta_title'),
                            'data-content' => $model->getAttributeDescription('meta_title')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'meta_keywords', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('meta_keywords'),
                            'data-content' => $model->getAttributeDescription('meta_keywords')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->textFieldGroup($model, 'meta_description', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('meta_description'),
                            'data-content' => $model->getAttributeDescription('meta_description')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
    </div>
</div>
    

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('CityModule.city', 'Сохранить Город и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('CityModule.city', 'Сохранить Город и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>