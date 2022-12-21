<?php
/**
* Класс VideoCategoryBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     http://yupe.ru
**/
class VideoCategoryBackendController extends \yupe\components\controllers\BackController
{
    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Video.VideoCategoryBackend.Index']],
            ['allow', 'actions' => ['view'], 'roles' => ['Video.VideoCategoryBackend.View']],
            ['allow', 'actions' => ['create'], 'roles' => ['Video.VideoCategoryBackend.Create']],
            [
                'allow',
                'actions' => ['update', 'inline'],
                'roles' => ['Video.VideoCategoryBackend.Update'],
            ],
            ['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['Video.VideoCategoryBackend.Delete']],
            ['deny'],
        ];
    }
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'VideoCategory',
                'validAttributes' => [
                    'status',
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'VideoCategory',
            ],
        ];
    }
    /**
    * Отображает Категорию по указанному идентификатору
    *
    * @param integer $id Идинтификатор Категорию для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Категории.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new VideoCategory;

        if (Yii::app()->getRequest()->getPost('VideoCategory') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('VideoCategory'));
        
            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('VideoModule.video', 'Запись добавлена!')
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
    * Редактирование Категории.
    *
    * @param integer $id Идинтификатор Категорию для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('VideoCategory') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('VideoCategory'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('VideoModule.video', 'Запись обновлена!')
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
    * Удаляет модель Категории из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Категории, который нужно удалить
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
                Yii::t('VideoModule.video', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('VideoModule.video', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
    * Управление Категориями.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new VideoCategory('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('VideoCategory') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('VideoCategory'));
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
        $model = VideoCategory::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('VideoModule.video', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
