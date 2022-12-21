<?php
/**
* PartnersBackendController контроллер для partners в панели управления
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2019 amyLabs && Yupe! team
* @package yupe.modules.partners.controllers
* @since 0.1
*
*/

class PartnersBackendController extends \yupe\components\controllers\BackController
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