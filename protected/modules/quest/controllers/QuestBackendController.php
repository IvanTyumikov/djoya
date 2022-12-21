<?php
/**
* Класс QuestBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Nikkable
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://vk.com/nikkable
**/
class QuestBackendController extends \yupe\components\controllers\BackController
{
    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Quest.QuestBackend.Index']],
            ['allow', 'actions' => ['view'], 'roles' => ['Quest.QuestBackend.View']],
            ['allow', 'actions' => ['create'], 'roles' => ['Quest.QuestBackend.Create']],
            [
                'allow',
                'actions' => ['update', 'inline'],
                'roles' => ['Quest.QuestBackend.Update'],
            ],
            ['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['Quest.QuestBackend.Delete']],
            ['deny'],
        ];
    }
    
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'Quest',
                'validAttributes' => [
                    'status',
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Quest',
            ],
        ];
    }
    /**
    * Отображает по указанному идентификатору
    *
    * @param integer $id
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }

    /**
    * Создает новую модель.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new Quest;

        if (Yii::app()->getRequest()->getPost('Quest') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Quest'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('QuestModule.quest', 'Запись добавлена!')
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
    * Редактирование.
    *
    * @param integer $id Идeнтификатор для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Quest') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Quest'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('QuestModule.quest', 'Запись обновлена!')
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
    * Удаляет модель из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор, который нужно удалить
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
                Yii::t('QuestModule.quest', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('QuestModule.quest', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }

    /**
    * Управление.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new Quest('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Quest') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Quest'));
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
        $model = Quest::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('QuestModule.quest', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
