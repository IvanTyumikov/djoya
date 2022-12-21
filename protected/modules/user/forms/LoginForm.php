<?php

/**
 * Форма авторизации
 *
 * @category YupeComponents
 * @package  yupe.modules.user.forms
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     https://yupe.ru
 *
 **/
class LoginForm extends yupe\models\YFormModel
{
    /**
     *
     */
    const LOGIN_LIMIT_SCENARIO = 'loginLimit';

    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;
    /**
     * @var
     */
    public $remember_me;
    /**
     * @var
     */
    public $verifyCode;
    public $verify;
    public $validate;

    /**
     * @return array
     */
    public function rules()
    {
        $module = Yii::app()->getModule('user');

        return [
            ['email, password', 'required'],
            // ['verifyCode', 'required', 'on' => self::LOGIN_LIMIT_SCENARIO],
            ['remember_me', 'boolean'],
            // [
            //     'verifyCode',
            //     'yupe\components\validators\YRequiredValidator',
            //     'allowEmpty' => !$module->showCaptcha || !CCaptcha::checkRequirements(),
            //     'message' => Yii::t('UserModule.user', 'Check code incorrect'),
            //     'on' => self::LOGIN_LIMIT_SCENARIO,
            // ],
            // [
            //     'verifyCode',
            //     'captcha',
            //     'allowEmpty' => !$module->showCaptcha || !CCaptcha::checkRequirements(),
            //     'on' => self::LOGIN_LIMIT_SCENARIO,
            // ],
            // ['verifyCode', 'emptyOnInvalid'],
            ['validate', 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('UserModule.user', 'Email'),
            'password' => Yii::t('UserModule.user', 'Password'),
            'remember_me' => Yii::t('UserModule.user', 'Remember me'),
            'verifyCode' => Yii::t('UserModule.user', 'Check code'),
        ];
    }

    /**
     * @return array
     */
    public function attributeDescriptions()
    {
        return [
            'email' => Yii::t('UserModule.user', 'Email'),
            'password' => Yii::t('UserModule.user', 'Password'),
            'remember_me' => Yii::t('UserModule.user', 'Remember me'),
            'verifyCode' => Yii::t('UserModule.user', 'Check code'),
        ];
    }

    /**
     * Обнуляем введённое значение капчи, если оно введено неверно:
     *
     * @param string $attribute - имя атрибута
     * @param mixed $params - параметры
     *
     * @return void
     **/
    public function emptyOnInvalid($attribute, $params)
    {
        if ($this->hasErrors()) {
            $this->verifyCode = null;
        }
    }

    public function beforeValidate(){
        if(Yii::app()->getUser()->getState('badLoginCount', 0) >= 3 && CCaptcha::checkRequirements('gd')){
            if ($_POST['g-recaptcha-response']=='') {
                $this->addError('verifyCode', 'Пройдите проверку reCAPTCHA..');
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
                    $this->addError('verifyCode', implode(', ', $response['error-codes']));
                }
            }
        }
        return parent::beforeValidate();
    }
}
