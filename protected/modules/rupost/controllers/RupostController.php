<?php

/**
 * RupostController контроллер для rupost на публичной части сайта
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2020 amyLabs && Yupe! team
 * @package yupe.modules.rupost.controllers
 * @since 0.1
 *
 */

class RupostController extends \yupe\components\controllers\FrontController
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

    public function actionWidget()
    {
        echo Yii::app()
            ->deliveryManager
            ->getDeliverySystemObject('rupost')
            ->getWidget();
    }
}
