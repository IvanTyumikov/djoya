<?php

class UserAjaxController extends \yupe\components\controllers\FrontController
{
    public function actionAjaxLogin()
    {
        $this->widget('application.modules.user.widgets.AjaxLoginWidget');
    }

    public function actionAjaxRegistration()
    {
        $this->widget('application.modules.user.widgets.AjaxRegistrationWidget');
    }
}
