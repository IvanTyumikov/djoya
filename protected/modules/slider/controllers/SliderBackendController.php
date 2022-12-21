<?php
/**
* Класс SliderBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     http://yupe.ru
**/
class SliderBackendController extends \yupe\components\controllers\BackController
{
    public function actions()
    {
        return [
            'inline' => [
                'class'           => 'yupe\components\actions\YInLineEditAction',
                'model'           => 'Slider',
                'validAttributes' => [
                    'name',
                    'status'
                ]
            ],
            'sortable' => [
                'class' => 'yupe\components\actions\SortAction',
                'model' => 'Slider',
            ],
        ];
    }
    /**
    * Отображает слайд по указанному идентификатору
    *
    * @param integer $id Идинтификатор слайд для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель слайда.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $model = new Slider;

        if (Yii::app()->getRequest()->getPost('Slider') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Slider'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('SliderModule.slider', 'Запись добавлена!')
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
    * Редактирование слайда.
    *
    * @param integer $id Идинтификатор слайд для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Slider') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Slider'));

            if($model->image){
                if(!empty($_FILES['Slider']['name']['image']) || !empty($_POST['delete-file'])){
                    $temp = Yii::getPathOfAlias('webroot').'/uploads/slider/'.$model->image;
                    unlink($temp);
                    if(isset($_POST['delete-file'])){
                        $model->image = '';
                    }
                }
            }

            if($model->image_xs){
                if($_FILES['Slider']['name']['image_xs'] || !empty($_POST['delete-file'])){
                    $temp = Yii::getPathOfAlias('webroot').'/uploads/slider/moblie/'.$model->image_xs;
                    unlink($temp);
                    if(isset($_POST['delete-file2'])){
                        $model->image_xs = '';
                    }
                }
            }
            
            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('SliderModule.slider', 'Запись обновлена!')
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
    * Удаляет модель слайда из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор слайда, который нужно удалить
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
                Yii::t('SliderModule.slider', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('SliderModule.slider', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
    * Управление слайдами.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new Slider('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Slider') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Slider'));
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
        $model = Slider::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('SliderModule.slider', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
