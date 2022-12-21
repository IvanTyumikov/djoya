<?php
/**
* CityController контроллер для city на публичной части сайта
*
* @author yupe team <team@yupe.ru>
* @link https://yupe.ru
* @copyright 2009-2019 amyLabs && Yupe! team
* @package yupe.modules.city.controllers
* @since 0.1
*
*/

class CityController extends \yupe\components\controllers\FrontController
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

    /**
     *
     * @return void
     */
    public function actionView($slug)
    {
        $model = City::model()->published()->find('slug = :slug', [':slug' => $slug]);

        // $model = City::model()->published();
        // $model = ($this->isMultilang())
        //     ? $model->language(Yii::app()->getLanguage())->find('slug = :slug', [':slug' => $slug])
        //     : $model->find('slug = :slug', [':slug' => $slug]);

        if (!$model) {
            throw new CHttpException(404, Yii::t('CityModule.city', 'Page was not found'));
        }

        $this->render('view', ['model' => $model]);
    }

    public function actionCalculate($value='')
    {
    	# code...
    }
}