<?php
Yii::import('application.modules.mail.MailModule');
/**
 * Форма заказать звонок
 */
class CallbackPriceFormModal extends CFormModel
{
    public $name;
    public $phone;
    public $email;
    public $body;
    public $verify;
    public $verifyCode;
    public $title;

    public function rules()
    {
        return [
            ['name, phone', 'required'],
            ['email', 'email'],
            ['verify, body, title', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'   => Yii::t('MailModule.mail', 'Ваше имя'),
            'phone'  => Yii::t('MailModule.mail', 'Ваш телефон'),
            'body'   => Yii::t('MailModule.mail', 'Сообщение'),
            'verify' => Yii::t('MailModule.mail', 'Verify'),
            'title' => Yii::t('MailModule.mail', 'Заголовок формы'),
        ];
    }

    public function beforeValidate(){
        if ($_POST['g-recaptcha-response']=='') {
            $this->addError('verifyCode', Yii::t('MailModule.mail', 'Пройдите проверку reCAPTCHA..'));
        } else {
            // $ip = CHttpRequest::getUserHostAddress();
            $post = [
                'secret' => Yii::app()->params['secretkey'],
                'response' => $_POST['g-recaptcha-response'],
                // 'remoteip' => $ip,
            ];

            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);

            $response = CJSON::decode($response);
            if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
                $this->addError('verifyCode', implode(', ', $response['error-codes']));
            }
        }
        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        if (empty($this->getErrors())) {

            Yii::import('application.modules.feedback.FeedbackModule');

            $feedback = new FeedBack;
            $feedback->name = $this->name;
            $feedback->phone = $this->phone;
            $feedback->email = $this->email;
            $feedback->theme = 'Заявка на оптовый прайс';

            $feedback->save();

            if (Yii::app()->hasModule('amocrm')){
                $amocrm = new Amocrm;
                $amocrm->addLead([
                    'phone' => $this->phone,
                    'name' => $this->name
                ]);
            }

            Yii::app()->mailMessage->raiseMailEvent('callback-price-modal', $this->getAttributes());
        }
        return parent::afterValidate();
    }
}
?>