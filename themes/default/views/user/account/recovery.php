<?php
/**
 * @var TbActiveForm $form
 */
Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js', CClientScript::POS_END);

$this->title = Yii::t('UserModule.user', 'Password recovery');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Password recovery')];
?>

<div class="lk-content lk-content-form">
    <div class="container">
        <div class="lk-form">
            <div class="lk-form__box">
                <div class="lk-form-header">
                    <h1><?= Yii::t('UserModule.user', 'Password recovery') ?></h1>
                    <div class="lk-form-header__desc">
                        <?= Yii::t('UserModule.user', 'Enter an email you have used during signup'); ?>
                    </div>
                </div>
                <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                    'id' => 'recovery-form',
                    'type' => 'vertical',
                    'htmlOptions' => ['class' => 'recovery-form form-my'],
                ]); ?>

                    <?= $form->textFieldGroup($model, 'email', [
                        'labelOptions' => [
                            'label' => false
                        ],
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                // 'placeholder' => Yii::t('UserModule.user', 'Enter an email you have used during signup'),
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>

                    <div class="form-bot">
                        <div class="form-captcha">
                            <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
                            <?= $form->error($model, 'verify');?>
                        </div>
                        <div class="form-button">
                            <button class="button_red" id="recovery-btn">
                                <?= Yii::t('UserModule.user', 'Recover password'); ?>
                            </button>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="lk-form__bottom">
                Уже есть аккаунт?
                <a class="but-link" href="<?= Yii::app()->createUrl('user/account/login'); ?>"><?= Yii::t('UserModule.user', 'Войти'); ?></a>
            </div>
        </div>
    </div>
</div>