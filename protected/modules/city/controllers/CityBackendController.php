<?php
/**
* Класс CityBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     https://yupe.ru
**/
class CityBackendController extends \yupe\components\controllers\BackController
{
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'City',
                'validAttributes' => [
                    'name',
                    'status'
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'City',
            ],
        ];
    }
    /**
    * Отображает Город по указанному идентификатору
    *
    * @param integer $id Идинтификатор Город для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Города.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new City;

        if (Yii::app()->getRequest()->getPost('City') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('City'));
        
            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('CityModule.city', 'Запись добавлена!')
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
    * Редактирование Города.
    *
    * @param integer $id Идинтификатор Город для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('City') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('City'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('CityModule.city', 'Запись обновлена!')
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
    * Удаляет модель Города из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Города, который нужно удалить
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
                Yii::t('CityModule.city', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('CityModule.city', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
    * Управление Городами.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new City('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('City') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('City'));
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
        $model = City::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('CityModule.city', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
