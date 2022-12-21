<?php
/**
 * CallbackModalWidget виджет формы "Заказать звонок"
 */
Yii::import('application.modules.mail.models.form.CallbackPriceFormModal');

class CallbackPriceModalWidget extends yupe\widgets\YWidget
{
    public $view = 'widget';

    public function run()
    {
        $model = new CallbackPriceFormModal;
        if (isset($_POST['CallbackPriceFormModal'])) {
            $model->attributes = $_POST['CallbackPriceFormModal'];
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
