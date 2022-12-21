<?php
/**
 * StocksController контроллер для работы с акциями в публичной части сайта
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.stocks.controllers
 * @since 0.1
 *
 */

class StocksController extends \yupe\components\controllers\FrontController
{

	public function actionView($slug)
    {
        $model = Stocks::model();

        $model = ($this->isMultilang())
            ? $model->language(Yii::app()->getLanguage())->find('slug = :slug', [':slug' => $slug])
            : $model->find('slug = :slug', [':slug' => $slug]);

        if (!$model) {
            throw new CHttpException(404, Yii::t('StocksModule.stocks', 'Stocks article was not found!'));
        }

        $this->render('view', ['model' => $model]);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $model = Stocks::model();

        $model = ($this->isMultilang())
            ? $model->language(Yii::app()->getLanguage())->findAll()
            : $model->findAll();

        if (!$model) {
            throw new CHttpException(404, Yii::t('StocksModule.stocks', 'Stocks article was not found!'));
        }

        $this->render('index', ['model' => $model]);
    }
}