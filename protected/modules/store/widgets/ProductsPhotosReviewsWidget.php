<?php

/**
 * ProductsPhotosReviewsWidget виджет отрисовки фотографий пользователей
 *
 * @category YupeWidget
 * @package  yupe.modules.store.widgets
 *
 */

Yii::import('application.modules.store.models.ProductPhotosReviews');

class ProductsPhotosReviewsWidget extends yupe\widgets\YWidget
{
    // сколько изображений выводить на одной странице
    public $limit = 10;

    public $view = 'products-photos-reviews';

    public $js_class = 'js-products-photos-reviews';

    public $product_id = null;

    /**
     * Запускаем отрисовку виджета
     *
     * @return void
     */
    public function run()
    {
        // Yii::app()->getClientScript()->registerLinkTag('preload stylesheet', 'text/css', Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.gallery.views.assets.css') . '/gallery.css'));
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.product_id = :product_id');
        $criteria->params = [':product_id' => $this->product_id];

        // echo ('<pre>');
        // print_r($criteria);
        // exit;

        $dataProvider = new CActiveDataProvider(
            'ProductPhotosReviews',
            [
                'criteria' => $criteria
            ]
        );

        // echo ('<pre>');
        // print_r($dataProvider);
        // exit;

        $this->render(
            $this->view,
            [
                'dataProvider' => $dataProvider,
                'js_class' => $this->js_class,
            ]
        );
    }
}
