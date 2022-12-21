<?php

/**
 */
class LoginModalWidget extends yupe\widgets\YWidget
{
    public $view = 'login-form';
    public $url = false;

    public function run()
    {
    	$module = Yii::app()->getModule('user');

        /*if (false === Yii::app()->getUser()->getIsGuest()) {
            $this->getController()->redirect(\yupe\helpers\Url::redirectUrl(
                $module->loginSuccess
            ));
        }*/

        $badLoginCount = Yii::app()->authenticationManager->getBadLoginCount(Yii::app()->getUser());

        $scenario = $badLoginCount >= (int)$module->badLoginCount ? LoginForm::LOGIN_LIMIT_SCENARIO : '';

        $form = new LoginForm($scenario);

        if (Yii::app()->getRequest()->getIsPostRequest() && !empty($_POST['LoginForm'])) {

            $form->setAttributes(Yii::app()->getRequest()->getPost('LoginForm'));

            if (Yii::app()->authenticationManager->login(
                $form,
                Yii::app()->getUser(),
                Yii::app()->getRequest()
            )
            ) {

                Yii::app()->getUser()->setFlash(
                    'login-success',
                    Yii::t('UserModule.user', 'Вы успешно авторизовались! <br>')
                );
                // $this->getController()->redirect(\yupe\helpers\Url::redirectUrl($url));

                /*Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('UserModule.user', 'You authorized successfully!')
                );

                if (Yii::app()->getUser()->isSuperUser() && $module->loginAdminSuccess) {
                    $redirect = [$module->loginAdminSuccess];
                } else {
                    $redirect = empty($module->loginSuccess) ? Yii::app()->getBaseUrl() : [$module->loginSuccess];
                }

                $redirect = Yii::app()->getUser()->getReturnUrl($redirect);

                Yii::app()->authenticationManager->setBadLoginCount(Yii::app()->getUser(), 0);

                $this->getController()->redirect($redirect);*/

            } else {

                $form->addError('verify', Yii::t('UserModule.user', 'Email or password was typed wrong!'));

                Yii::app()->authenticationManager->setBadLoginCount(Yii::app()->getUser(), $badLoginCount + 1);
            }
        }

        // $this->getController()->render($this->id, ['model' => $form]);
        // if(!Yii::app()->request->isAjaxRequest){
            $this->render($this->view, ['model' => $form]);
        // }

    }
}