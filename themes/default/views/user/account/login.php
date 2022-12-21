<?php
$this->title = Yii::t('UserModule.user', 'Sign in');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Sign in')];
?>

<div class="lk-content lk-content-form">
    <div class="container">
        <div class="lk-form">
            <div class="lk-form__box">
                <div class="lk-form-header">
                    <h1><?= Yii::t('UserModule.user', 'Вход'); ?></h1>
                </div>

                <?php $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    [
                        'id' => 'login-form',
                        'type' => 'vertical',
                        'htmlOptions' => [
                            'class' => 'login-form form-my',
                        ]
                    ]
                ); ?>

                    <?= $form->errorSummary($model); ?>


                    <?= $form->textFieldGroup($model, 'email', [
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                'class' => '',
                                'placeholder' => 'Ваш E-mail',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>
                    <div class="login-form__item">
                        <?= $form->passwordFieldGroup($model, 'password', [
                            'groupOptions'=>[
                                'class'=>'password-form-group',
                            ],
                            'appendOptions' => [
                                'class'=>'password-input-show',
                            ],
                            'append' => '<i class="fa fa-eye" aria-hidden="true"></i>'
                        ]); ?>
                        <?= CHtml::link(Yii::t('UserModule.user', 'Forgot your password?'), ['/user/account/recovery'], [
                            'class' => 'login-form__link'
                        ]) ?>
                    </div>
                    <?php if ($this->getModule()->sessionLifeTime > 0) : ?>
                        <!-- <div class="checkbox checkbox-one">
                            <input checked="checked" name="LoginForm[remember_me]" id="LoginForm_remember_me" value="1" type="checkbox">
                            <label for="LoginForm_remember_me">Запомнить меня</label>
                        </div> -->
                    <?php endif; ?>
                    <?php if (Yii::app()->getUser()->getState('badLoginCount', 0) >= 3 && CCaptcha::checkRequirements('gd')): { ?>
                        <?php Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js', CClientScript::POS_END); ?>
                        <div class="form-captcha">
                            <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                            </div>
                            <?= $form->error($model, 'verifyCode');?>
                        </div>
                    <?php } endif; ?>
                    <div class="form-my__but">
                        <button class="button_red" id="login-btn" data-send="ajax">
                            Войти
                        </button>
                    </div>

                    <?php if (Yii::app()->hasModule('social')) : ?>
                        <?php $this->widget(
                            'vendor.nodge.yii-eauth.EAuthWidget',
                            [
                                'action' => '/social/login',
                                'predefinedServices' => ['google', 'facebook', 'vkontakte', 'twitter', 'github'],
                            ]
                        ); ?>
                    <?php endif; ?>
                <?php $this->endWidget(); ?>
            </div>
            <div class="lk-form__bottom">
                <div>Еще нет аккаунта?</div>
                <a class="but-link" href="<?= Yii::app()->createUrl('user/account/registration'); ?>"><?= Yii::t('UserModule.user', 'Зарегистрироваться'); ?></a>
            </div>
        </div>
    </div>
</div>

<?php if (Yii::app()->user->hasFlash("success")) : ?>
    <script>
        setTimeout(function(){
            $('#registrationModal').modal('show');
        }, 200);
        setTimeout(function(){
            $('#registrationModal').modal('hide');
        }, 6000);
    </script>
<?php endif; ?>