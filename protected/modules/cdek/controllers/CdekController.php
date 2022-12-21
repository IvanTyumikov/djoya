<?php
/**
 * CdekController контроллер для cdek на публичной части сайта
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2020 amyLabs && Yupe! team
 * @package yupe.modules.cdek.controllers
 * @since 0.1
 *
 */

class CdekController extends \yupe\components\controllers\FrontController
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

    public function actionWidget($action = 'cdek')
    {
        echo Yii::app()->deliveryManager->getDeliverySystemObject($action)->getWidget();
    }
}
