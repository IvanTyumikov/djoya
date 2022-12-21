<?php
$this->title = Yii::t('UserModule.user', 'Настройки');
// $this->breadcrumbs = [Yii::t('UserModule.user', 'Настройки')];
$this->breadcrumbs = [
    "Личный кабинет" => [Yii::app()->createUrl('/user/profile/index')],
    Yii::t('UserModule.user', 'Настройки')
];
$this->layout = "//layouts/user";

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
        [
            'id' => 'profile-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'type' => 'vertical',
            'htmlOptions' => [
                'class' => 'form-white form-label',
                'enctype' => 'multipart/form-data',
            ]
        ]
    );
?>
    <?= $form->errorSummary($model); ?>
    
    <h3>Настройки</h3>
    <div class="lk-setting">
        <div class="lk-setting__img">
            <div class="lk-setting__avatar">
                <?php if($user->avatar) : ?>
                    <?= CHtml::image( '/uploads/' . $this->module->avatarsDir . '/' . $user->avatar, ''); ?>
                <?php else: ?>
                    <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/nophoto.png', '', ['class' => 'nophoto']); ?>
                <?php endif; ?>
            </div>
            <div class="file-upload">
                <label>
                    <?= $form->fileField($model, 'avatar'); ?>
                    <span><div id="count_file">Прикрепить файл</div></span>
                </label>
            </div>
        </div>
        <div class="lk-setting__content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <?= $form->textFieldGroup($model, 'last_name', [
                            'widgetOptions' => [
                                'htmlOptions'=>[
                                    'placeholder' => 'Фамилия'
                                ],
                            ],
                        ]) ?>
                    </div>
                    <div class="col-sm-12">
                        <?= $form->textFieldGroup($model, 'first_name', [
                            'widgetOptions' => [
                                'htmlOptions'=>[
                                    'placeholder' => 'Имя'
                                ],
                            ],
                        ]) ?>
                    </div>
                    <div class="col-sm-12">
                        <?= $form->textFieldGroup($model, 'middle_name', [
                            'widgetOptions' => [
                                'htmlOptions'=>[
                                    'placeholder' => 'Отчество'
                                ],
                            ],
                        ]) ?>
                    </div>
                    <div class="col-sm-12">
                        <?= $form->textAreaGroup($model, 'location', [
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'rows' => 6,
                                    'placeholder' => 'Адрес'
                                ],
                            ],
                        ]); ?>
                    </div>
                    
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <div class="form-group form-group-radio">
                            <br>
                            <?= $form->labelEx($model, 'gender'); ?>
                            <div class="input-group radio-list">
                                <?= $form->radioButtonList($model, 'gender', User::model()->getGendersList(),[
                                    'template'=>'<div class="radio-inline">{input}{label}</div>',
                                    'separator' => ''
                                ]) ?>
                            </div>
                            <?= $form->error($model, 'gender');?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <?= $form->labelEx($model, 'phone', ['class' => 'control-label']) ?>
                            <?php $this->widget('CMaskedTextFieldPhone', [
                                'model' => $model,
                                'attribute' => 'phone',
                                'mask' => '+7-999-999-9999',
                                'htmlOptions'=>[
                                    'class' => 'data-mask form-control',
                                    'data-mask' => 'phone',
                                    'placeholder' => 'Телефон',
                                    'autocomplete' => 'off'
                                ]
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <?= $form->textFieldGroup($user, 'email', [
                            'widgetOptions' => [
                                'htmlOptions' => [
                                    'disabled' => true,
                                    'placeholder' => 'Email'
                                ],
                            ],
                        ]); ?>
                    </div>

                    <div class="col-sm-12">
                        <?= CHtml::submitButton('Сохранить данные', ['class' => 'button_red']) ?>
                    </div>
                </div>
            </div>
            <div class="row lk-setting__bottom">
                
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>

<?php Yii::app()->getClientScript()->registerScript("file-upload", "
    $('.file-upload input[type=file]').change(function(){
        var inputFile = document.getElementById('ProfileForm_avatar').files;
        if(inputFile.length > 0){
            $('#count_file').text('Выбрано файлов ' + inputFile.length);
        }else{
            $('#count_file').text('Прикрепить файл');
        }
    });
"); ?>