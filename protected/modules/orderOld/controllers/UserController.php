<?php

/**
 * Class UserController
 */
class UserController extends \yupe\components\controllers\FrontController
{
    /**
     * @return array
     */
    public function filters()
    {
        return [
            'accessControl',
        ];
    }

    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'actions' => ['index'], 'users' => ['@'],],
            ['deny', 'users' => ['*'],],
        ];
    }

     /**
     *
     */
    // public function actionIndex()
    // {
    //     $this->render(
    //         'index',
    //         [
    //             'orders' => Order::model()->findAllByAttributes(
    //                 ['user_id' => Yii::app()->getUser()->getId()],
    //                 ['order' => 'date DESC']
    //             ),
    //         ]
    //     );
    // }
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Order', [
            'criteria' => [
                'condition' => 't.user_id = :user_id',
                'params' => [':user_id' => Yii::app()->getUser()->getId()],
                'limit' => 20,
                'order' => 't.date DESC',
            ],
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
