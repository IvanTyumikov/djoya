<?php
/**
* DealersController контроллер для dealers на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2019 amyLabs && Yupe! team
* @package yupe.modules.dealers.controllers
* @since 0.1
*
*/

class DealersController extends \yupe\components\controllers\FrontController
{
    /*
     * Действие "по умолчанию"
    */
    public function actionIndex()
    {
        $dbCriteria = new CDbCriteria([
            'condition' => 't.status = :status',
            'params' => [
                ':status' => DealersCity::STATUS_PUBLIC,
            ],
            'order' => 't.position DESC',
        ]);

        $dataProvider = new CActiveDataProvider('DealersCity', [
            'criteria' => $dbCriteria,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->render('index', ['dataProvider' => $dataProvider]);
    }
}