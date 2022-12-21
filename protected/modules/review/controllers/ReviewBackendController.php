<?php
/**
* Класс ReviewBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     http://yupe.ru
**/
class ReviewBackendController extends \yupe\components\controllers\BackController
{
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'Review',
                'validAttributes' => [ 'moderation', 'position' ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Review',
            ],
            'sortablephoto' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'ReviewImage',
            ],
        ];
    }
    /**
    * Отображает Отзыв по указанному идентификатору
    *
    * @param integer $id Идинтификатор Отзыв для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Отзыва.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new Review;

        if (Yii::app()->getRequest()->getPost('Review') !== null) {
            
            $model->setAttributes(Yii::app()->getRequest()->getPost('Review'));
            
            $model->user_id =  Yii::app()->user->id;
            $model->date_created =  date("Y-m-d H:i:s");

            if ($model->save()) {
                $model->updateReviewPhotos();
                $model->updateCountPhotos();
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('ReviewModule.review', 'Запись добавлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('create', ['model' => $model]);
    }
    
    /**
    * Редактирование Отзыва.
    *
    * @param integer $id Идинтификатор Отзыв для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Review') !== null) {

            $model->updateReviewPhotos();
            $model->updateCountPhotos();

            $model->setAttributes(Yii::app()->getRequest()->getPost('Review'));
            
            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('ReviewModule.review', 'Запись обновлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('update', ['model' => $model]);
    }
    
    /**
    * Удаляет модель Отзыва из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Отзыва, который нужно удалить
    *
    * @return void
    */
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            // поддерживаем удаление только из POST-запроса
            $this->loadModel($id)->delete();

            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('ReviewModule.review', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('ReviewModule.review', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
    * Управление Отзывами.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new Review('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Review') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Review'));
        $this->render('index', ['model' => $model]);
    }
    
    /**
    * Возвращает модель по указанному идентификатору
    * Если модель не будет найдена - возникнет HTTP-исключение.
    *
    * @param integer идентификатор нужной модели
    *
    * @return void
    */
    public function loadModel($id)
    {
        $model = Review::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('ReviewModule.review', 'Запрошенная страница не найдена.'));

        return $model;
    }

    /**
     * @throws CHttpException
     */
    public function actionDeleteImage()
    {
        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getIsAjaxRequest()) {

            $id = (int)Yii::app()->getRequest()->getPost('id');

            $model = ReviewImage::model()->findByPk($id);

            $review = Review::model()->findByPk($model->review_id);

            if (null !== $model) {
                $model->delete();
                $review->updateCountPhotos();
                Yii::app()->ajax->success();
            }
            
        }

        throw new CHttpException(404);
    }
}
