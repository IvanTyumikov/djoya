<?php
/**
 * ReviewController публичный контроллер для работы со страницами
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.review.controllers
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @since 0.1
 *
 */

class ReviewController extends yupe\components\controllers\FrontController
{
    /**
     * Текущая просматриваемая страница
     */
    public $currentReview;

    /**
     * экшн для отображения конкретной страницы, отображает опубликованные страницы и превью
     */
    public function actionShow()
    {
        $dbCriteria = new CDbCriteria([
        	'condition'     => 't.moderation = 1',
        ]);

        $countImage = 0;

        if (Yii::app()->getRequest()->getIsPostRequest()) {
            if($_POST['filterPhoto'] == 1){
                $dbCriteria->compare('countImage', '> 0');
                $countImage = 1;
            }
        }

        $listperpage = $this->module->getEditableParams()['itemsperpage'];
        $itemsperpagefront = $this->module->itemsperpagefront;
        
        $dataProvider = new CActiveDataProvider('Review', [
            'criteria' => $dbCriteria,
            'pagination' => [
                'pageSize' => $listperpage[$itemsperpagefront],
                'pageVar'  => 'page',
            ],
            'sort' => [
                'attributes' => [
                    'countImage' => [
                        'desc'    =>'countImage DESC',
                        'asc'     =>'countImage ASC',
                        'default' =>'desc',
                    ],
                    'rating' => [
                        'desc'    =>'rating DESC',
                        'asc'     =>'rating ASC',
                        'default' =>'desc',
                    ],
                    'date_created' => [
                        'desc'    =>'date_created DESC',
                        'asc'     =>'date_created ASC',
                        'default' =>'desc',
                    ],
                ],
                'sortVar'      => 'sort',
                'defaultOrder' => 't.position DESC',
            ],
        ]);

        $this->render('review', [
            'dataProvider' => $dataProvider,
            'countImage'   => $countImage
        ]);
    }

	public function actionCreate()
	{
		$model = new Review();

        $this->render('review-create', ['model' => $model]);
	}

    /**
     * Генерирует меню навигации по вложенным страницам для использования в zii.widgets.CBreadcrumbs
     */
    public function getBreadCrumbs()
    {
        $reviews = [];
        if ($this->currentReview->parentReview) {
            $reviews = $this->getBreadCrumbsRecursively($this->currentReview->parentReview);
        }

        $reviews = array_reverse($reviews);
        $reviews[] = $this->currentReview->title;

        return $reviews;
    }

    /**
     * Рекурсивно возвращает пригодный для zii.widgets.CBreadcrumbs массив, начиная со страницы $review
     * @param  Review $review
     * @return array
     * @internal param int $reviewId
     */
    private function getBreadCrumbsRecursively(Review $review)
    {
        $reviews = [];
        $reviews[$review->title] = $review->getUrl();
        $pp = $review->parentReview;
        if ($pp) {
            $reviews += $this->getBreadCrumbsRecursively($pp);
        }

        return $reviews;
    }
}
