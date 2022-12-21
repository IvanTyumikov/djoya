<?php
Yii::import('application.modules.mail.MailModule');

/**
 * Форма заказать звонок
 */
class AffiliateForm extends CFormModel
{
    public $radio;
    public $name;
    public $phone;
    public $email;
    public $city;
    public $body;
    public $verify;
    public $verifyCode;
    public $title;

    public function rules()
    {
        return [
            ['name, phone', 'required'],
            ['email', 'email'],
            ['verify, body, title, city, radio', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'   => Yii::t('MailModule.mail', 'ФИО'),
            'phone'  => Yii::t('MailModule.mail', 'Телефон'),
            'email'  => Yii::t('MailModule.mail', 'Почта'),
            'city'  => Yii::t('MailModule.mail', 'Город'),
            'body'   => Yii::t('MailModule.mail', 'Комментарий'),
            'verify' => Yii::t('MailModule.mail', 'Verify'),
            'title' => Yii::t('MailModule.mail', 'Заголовок формы'),
        ];
    }

    public function beforeValidate(){
       /* if ($_POST['g-recaptcha-response']=='') {
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
        }*/
        return parent::beforeValidate();
    }

    public function getRadioLists() {
        return [
            'Дистрибуция (опт и мелкий опт)' => 'Дистрибуция (опт и мелкий опт)',
            'Дропшиппинг' => 'Дропшиппинг',
            'Партнерская программа с промокодом' => 'Партнерская программа с промокодом'
        ];
    }

    public function afterValidate()
    {
        if (empty($this->getErrors())) {

//            Yii::import('application.modules.feedback.FeedbackModule');
//
//            $feedback = new FeedBack;
//            $feedback->name = $this->name;
//            $feedback->phone = $this->phone;
//            $feedback->theme = 'Заказ звонка';
//
//            $feedback->save();
//
//            if (Yii::app()->hasModule('amocrm')){
//                $amocrm = new Amocrm;
//                $amocrm->addLead([
//                    'phone' => $this->phone,
//                    'name' => $this->name
//                ]);
//            }

            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'city' => $this->city,
                'phone' => $this->phone,
                'radio' => $this->radio
            ];

            $this->sendBitrixLead($data);
            
            Yii::app()->mailMessage->raiseMailEvent('affiliate-programm', $this->getAttributes());
        }
        return parent::afterValidate();
    }

    public function sendBitrixLead( $data ) {
        $idUser = 1;
        $codeWebhooks = 'tfy9tgflzr3213d2';
        $queryUrl = 'https://dcmedia.bitrix24.ru/rest/'.$idUser.'/'.$codeWebhooks.'/crm.lead.add.json';

        $queryData = http_build_query(array(
            'fields' => array(
                'PHONE' => [
                    "n0" => [
                        "VALUE" => $data['phone'],
                        "VALUE_TYPE" => "WORK",
                    ],
                ],
                'EMAIL' => [
                    "n0" => [
                        "VALUE" => $data['email'],
                        "VALUE_TYPE" => "WORK",
                    ]
                ],
                'ASSIGNED_BY_ID' => 11,
                'SOURCE_ID' => 'UC_TJ8O6Z',
            ),
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        ));

        if($queryData !== '') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $queryUrl,
                CURLOPT_POSTFIELDS => $queryData,
            ));

            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result, 1);

            if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
        }
    }
}
?>