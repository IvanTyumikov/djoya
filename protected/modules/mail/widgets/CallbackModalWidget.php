<?php
/**
 * CallbackModalWidget виджет формы "Заказать звонок"
 */
Yii::import('application.modules.mail.models.form.CallbackFormModal');

class CallbackModalWidget extends yupe\widgets\YWidget
{
    public $view = 'callback-widget';

    public function run()
    {
        $model = new CallbackFormModal;
        if (isset($_POST['CallbackFormModal'])) {
            $model->attributes = $_POST['CallbackFormModal'];
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
