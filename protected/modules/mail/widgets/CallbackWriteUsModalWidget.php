<?php
/**
 * CallbackModalWidget виджет формы "Заказать звонок"
 */
Yii::import('application.modules.mail.models.form.CallbackWriteFormModal');

class CallbackWriteUsModalWidget extends yupe\widgets\YWidget
{
    public $view = 'callback-write-us-widget';

    public function run()
    {
        $model = new CallbackWriteFormModal;
        if (isset($_POST['CallbackWriteFormModal'])) {
            $model->attributes = $_POST['CallbackWriteFormModal'];
            if($model->verify == ''){
                if ($model->validate()) {
                    Yii::app()->user->setFlash('callback-success', Yii::t('MailModule.mail', 'Your request has been successfully sent.'));
                    Yii::app()->controller->refresh();
                }
            }
        }

        $this->render($this->view, [
            'model' => $model,
        ]);
    }

}
