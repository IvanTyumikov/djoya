<?php
/**
 * CallbackModalWidget виджет формы "Заказать звонок"
 */
Yii::import('application.modules.mail.models.form.AffiliateForm');

class AffiliateWidget extends yupe\widgets\YWidget
{
    public $view = 'widget';

    public function run()
    {
        $model = new AffiliateForm;
        if (isset($_POST['AffiliateForm'])) {
            $model->attributes = $_POST['AffiliateForm'];
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
