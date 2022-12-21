<?php
/**
* QuestController контроллер на публичной части сайта
*
* @author Nikkable
* @link https://vk.com/nikkable
* @copyright 2009-2017 amyLabs && Yupe! team
* @package yupe.modules.quest.controllers
* @since 0.1
*
*/

class QuestController extends \yupe\components\controllers\FrontController
{
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionIndex()
    {
    	$dataProvider = new CActiveDataProvider(
            'Quest', [
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

        $category = QuestCategory::model()->published()->findAll($criteria);

        $this->render('index', [
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }
}