<?php
/**
* PartnersController контроллер для partners на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2019 amyLabs && Yupe! team
* @package yupe.modules.partners.controllers
* @since 0.1
*
*/

class PartnersController extends \yupe\components\controllers\FrontController
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