<?php
/**
* VideoController контроллер для video на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link http://yupe.ru
* @copyright 2009-2017 amyLabs && Yupe! team
* @package yupe.modules.video.controllers
* @since 0.1
*
*/

class VideoController extends \yupe\components\controllers\FrontController
{
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionIndex()
    {
    	$dataProvider = new CActiveDataProvider(
            'Video', [
                'criteria' => [
                    'scopes' => 'published'
                ],
                'pagination' => [
                    'pageSize' => 9
                ],
                'sort' => [
                    'defaultOrder' => 'position DESC',
                ]
            ]
        );

        $criteria = new CDbCriteria();
        $criteria->order = 't.position DESC';

        $category = VideoCategory::model()->published()->findAll($criteria);

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }
}