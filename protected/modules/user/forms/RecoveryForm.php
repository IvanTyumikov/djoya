<?php

/**
 * Форма для запроса смены пароля
 *
 * @category YupeComponents
 * @package  yupe.modules.user.forms
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     https://yupe.ru
 *
 **/
class RecoveryForm extends CFormModel
{
    public $email;
    public $verify;
    public $validate;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'checkEmail'],
            ['validate', 'safe'],
        ];
    }

    public function checkEmail($attribute, $params)
    {
        if ($this->hasErrors() === false) {
            $user = User::model()->active()->find(
                'email = :email',
                [
                    ':email' => $this->$attribute
                ]
            );

            if ($user === null) {
                $this->addError(
                    '',
                    Yii::t(
                        'UserModule.user',
                        'Email "{email}" was not found or user was blocked !',
                        [
                            '{email}' => $this->email
                        ]
                    )
                );
            }
        }
    }
    public function beforeValidate(){
        if($this->validate == 1){

        } else{
            if ($_POST['g-recaptcha-response']=='') {
                $this->addError('verify', 'Пройдите проверку reCAPTCHA..');
            } else {
                $ip = CHttpRequest::getUserHostAddress();
                $post = [
                    'secret' => Yii::app()->params['secretkey'],
                    'response' => $_POST['g-recaptcha-response'],
                    'remoteip' => $ip,
                ];

                $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $response = curl_exec($ch);
                curl_close($ch);

                $response = CJSON::decode($response);
                if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
                    $this->addError('verify', implode(', ', $response['error-codes']));
                }
            }
        }
        return parent::beforeValidate();
    }
}
