<?php
/**
* Класс VideoBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     http://yupe.ru
**/
class VideoBackendController extends \yupe\components\controllers\BackController
{
    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Video.VideoBackend.Index']],
            ['allow', 'actions' => ['view'], 'roles' => ['Video.VideoBackend.View']],
            ['allow', 'actions' => ['create'], 'roles' => ['Video.VideoBackend.Create']],
            [
                'allow',
                'actions' => ['update', 'inline'],
                'roles' => ['Video.VideoBackend.Update'],
            ],
            ['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['Video.VideoBackend.Delete']],
            ['deny'],
        ];
    }
    
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'Video',
                'validAttributes' => [
                    'status',
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Video',
            ],
        ];
    }
    /**
    * Отображает видео по указанному идентификатору
    *
    * @param integer $id Идинтификатор видео для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }

    /**
    * Создает новую модель видео.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new Video;

        if (Yii::app()->getRequest()->getPost('Video') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Video'));

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
    * Редактирование видео.
    *
    * @param integer $id Идeнтификатор видео для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Video') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Video'));

            if($model->image){
                if($_FILES['Video']['name']['image'] || $_POST['delete-file']){
                    $temp = Yii::getPathOfAlias('webroot').'/uploads/video/'.$model->image;
                    unlink($temp);
                    if(isset($_POST['delete-file'])){
                        $model->image = '';
                    }
                }
            }

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
    * Удаляет модель видео из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор видео, который нужно удалить
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
    * Управление видео.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new Video('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Video') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Video'));
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
        $model = Video::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('VideoModule.video', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
