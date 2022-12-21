<?php
/**
* SliderController контроллер для slider на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link http://yupe.ru
* @copyright 2009-2017 amyLabs && Yupe! team
* @package yupe.modules.slider.controllers
* @since 0.1
*
*/

class SliderController extends \yupe\components\controllers\FrontController
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