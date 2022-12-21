<?php

/**
 * AjaxRegistrationWidget
 */
class AjaxRegistrationWidget extends \yupe\widgets\YWidget
{
    public $view = 'ajax-registration-widget';
    public $redirect = null;

    public function run()
    {
        $module = Yii::app()->getModule('user');
        $model = new RegistrationForm;

        if (isset($_POST['RegistrationForm'])) {
            $model->attributes = $_POST['RegistrationForm'];
            $model->nick_name = $model->email;
            if ($model->validate()) {
                if ($user = Yii::app()->userManager->createUser($model)) {
                    if (!$module->emailAccountVerification) {
                        $this->autoLoginUser($model);
                        Yii::app()->getUser()->setFlash(
                            yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                            Yii::t('UserModule.user', 'Вы успешно зарегистрировались!')
                        );
                    } else {
                        Yii::app()->getUser()->setFlash(
                            yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                            Yii::t('UserModule.user', 'Вы успешно зарегистрировались. Письмо с подтверждением регистрации отправлено на указананный e-mail. Для завершения регистрации - проверьте почту!')
                        );
                    }

                } else {
                    Yii::app()->getUser()->setFlash(
                        yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                        Yii::t('UserModule.user', 'Вы не зарегистрированы')
                    );
                }
            }
        }

        $this->render($this->view, [
            'model' => $model,
            'redirect' => $this->redirect,
        ]);
    }

    /**
     * Auto-login user.
     *
     * @param RegistrationForm $form
     * @return bool
     */
    private function autoLoginUser(RegistrationForm $form)
    {
        $loginForm = new LoginForm();
        $loginForm->remember_me = true;
        $loginForm->email = $form->email;
        $loginForm->password = $form->password;

        return Yii::app()->authenticationManager->login(
            $loginForm,
            Yii::app()->getUser(),
            Yii::app()->getRequest()
        );
    }
}
