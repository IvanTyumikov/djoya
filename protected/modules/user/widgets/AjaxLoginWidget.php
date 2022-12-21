<?php

/**
 * AjaxLoginWidget
 */
class AjaxLoginWidget extends \yupe\widgets\YWidget
{
    public $view = 'ajax-login-widget';

    public function run()
    {
        $model = new LoginForm;

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() and Yii::app()->authenticationManager->login($model, Yii::app()->getUser(), Yii::app()->getRequest())) {
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('UserModule.user', 'You authorized successfully!')
                );
            } else {
                $model->addError('verify', Yii::t('UserModule.user', 'Email or password was typed wrong!'));
            }
        }

        $this->render($this->view, [
            'model'        => $model,
        ]);
    }
}
