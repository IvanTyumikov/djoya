<?php
/**
* PickupController контроллер для pickup на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2020 amyLabs && Yupe! team
* @package yupe.modules.pickup.controllers
* @since 0.1
*
*/

class PickupController extends \yupe\components\controllers\FrontController
{
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionIndex()
    {
        $this->render('index');
    }
}