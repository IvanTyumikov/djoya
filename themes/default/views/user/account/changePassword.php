<?php
$this->title = Yii::t('UserModule.user', 'Password recovery');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Password recovery')];
Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js');
?>

<?php //$this->widget('yupe\widgets\YFlashMessages'); ?>

<div class="lk-content">
    <div class="container">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <div class="lk-form">
            <h1><?= Yii::t('UserModule.user', 'Password recovery') ?></h1>
            <?php $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm',
                [
                    'id' => 'login-form',
                    'type' => 'vertical',
                    'htmlOptions' => [
                        'class' => 'form-white',
                    ]
                ]
            ); ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <?= $form->errorSummary($model); ?>

                        </div>
                    </div>

                    <div class='row'>
                        <div class="col-xs-12">
                            <?= $form->passwordFieldGroup($model, 'password'); ?>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="col-xs-12">
                            <?= $form->passwordFieldGroup($model, 'cPassword'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="button_red" id="change-btn">
                                <?= Yii::t('UserModule.user', 'Change password'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
