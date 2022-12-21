<?php

/**
 * GalleryWidget виджет отрисовки галереи изображений
 *
 * @category YupeWidget
 * @package  yupe.modules.gallery.widgets
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     https://yupe.ru
 *
 */

Yii::import('application.modules.gallery.models.*');

class GalleryWidget extends yupe\widgets\YWidget
{
    // сколько изображений выводить на одной странице
    public $limit = 10;

    // ID-галереи
    public $galleryId;

    // Галерея
    public $gallery;

    public $view = 'gallerywidget';

    public $js_class = 'js-review-slider-stories';

    /**
      * @var array
      */
    public $category_id = [];

    /**
     * Запускаем отрисовку виджета
     *
     * @return void
     */
    public function run()
    {
        // Yii::app()->clientScript->registerCssFile(
        //     Yii::app()->assetManager->publish(
        //         Yii::getPathOfAlias('application.modules.gallery.views.assets.css') . '/gallery.css'
        //     )
        // );
        Yii::app()->getClientScript()->registerLinkTag('preload stylesheet', 'text/css', Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.gallery.views.assets.css') . '/gallery.css'));
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.gallery_id = :gallery_id');
        $criteria->params = [':gallery_id' => $this->galleryId];
        if (!empty($this->category_id)){
            $criteria->addInCondition('image.category_id', $this->category_id);
        }
        $criteria->order = 't.position';
        $criteria->with = 'image';

        $dataProvider = new CActiveDataProvider(
            'ImageToGallery', [
                'criteria' => $criteria
            ]
        );

        $this->render(
            $this->view,
            [
                'dataProvider' => $dataProvider,
                'gallery' => $this->gallery,
                'js_class' => $this->js_class,
            ]
        );
    }
}
