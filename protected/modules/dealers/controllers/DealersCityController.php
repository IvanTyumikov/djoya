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

class DealersCityController extends \yupe\components\controllers\FrontController
{
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionView($slug)
    {
        $model = DealersCity::model()->published();

        $model = $model->find('slug = :slug', [':slug' => $slug]);

        if (!$model) {
            throw new CHttpException(404, Yii::t('DealersModule.dealers', 'News article was not found!'));
        }

        $this->render('view', ['model' => $model]);
    }
    
    /**
     *
     */
    public function actionIndex()
    {
        $dbCriteria = new CDbCriteria([
            'condition' => 't.status = :status',
            'params' => [
                ':status' => DealersCity::STATUS_PUBLISHED,
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