<?php

/**
 * Виджет вывода последних новостей
 *
 * @category YupeWidget
 * @package  yupe.modules.stocks.widgets
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     http://yupe.ru
 *
 **/
Yii::import('application.modules.stocks.models.*');

/**
 * Class StocksWidget
 */
class StocksWidget extends yupe\widgets\YWidget
{
    public $view = 'stocks';

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->limit = (int)$this->limit;
        $criteria->order = 'date DESC';


		$model = Stocks::model()->findAll();

        $this->render($this->view, ['model' => $model]);

    }
}