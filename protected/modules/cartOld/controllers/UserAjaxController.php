<?php

class UserAjaxController extends \yupe\components\controllers\FrontController
{
    public function actionAjaxLogin()
    {
        $this->widget('application.modules.cart.widgets.AjaxLoginWidget');
    }

    public function actionAjaxRegistration()
    {
        $this->widget('application.modules.cart.widgets.AjaxRegistrationWidget');
    }
}
