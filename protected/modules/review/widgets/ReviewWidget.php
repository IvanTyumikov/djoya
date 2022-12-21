<?php
/**
 * ReviewNewWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.review.widgets
 * @since 0.1
 *
 */

class ReviewWidget extends yupe\widgets\YWidget
{
	public $view = 'review-widget';
	public $js_class = 'js-review-slider';

    public function run()
    {
		$criteria = new CDbCriteria();
        $criteria->addCondition("t.moderation = 1");

        $model = Review::model()->findAll($criteria);

        $this->render($this->view, [
        	'models' => $model
        ]);
    }
}
