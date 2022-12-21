<?php
/**
* Класс QuestCategoryBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Nikkable
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://vk.com/nikkable
**/
class QuestCategoryBackendController extends \yupe\components\controllers\BackController
{
    /**
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['allow', 'actions' => ['index'], 'roles' => ['Quest.QuestCategoryBackend.Index']],
            ['allow', 'actions' => ['view'], 'roles' => ['Quest.QuestCategoryBackend.View']],
            ['allow', 'actions' => ['create'], 'roles' => ['Quest.QuestCategoryBackend.Create']],
            [
                'allow',
                'actions' => ['update', 'inline'],
                'roles' => ['Quest.QuestCategoryBackend.Update'],
            ],
            ['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['Quest.QuestCategoryBackend.Delete']],
            ['deny'],
        ];
    }
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'QuestCategory',
                'validAttributes' => [
                    'status',
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'QuestCategory',
            ],
        ];
    }
    /**
    * Отображает по указанному идентификатору
    *
    * @param integer $id Идинтификатор для отображения
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
        $model = new QuestCategory;

        if (Yii::app()->getRequest()->getPost('QuestCategory') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('QuestCategory'));
        
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
    * @param integer $id Идинтификатор для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('QuestCategory') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('QuestCategory'));

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
    * Управление Категориями.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new QuestCategory('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('QuestCategory') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('QuestCategory'));
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
        $model = QuestCategory::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('QuestModule.quest', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
