<?php
/**
* RupostBackendController контроллер для rupost в панели управления
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2020 amyLabs && Yupe! team
* @package yupe.modules.rupost.controllers
* @since 0.1
*
*/

class RupostBackendController extends \yupe\components\controllers\BackController
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