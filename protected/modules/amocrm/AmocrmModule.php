<?php

/**
 * AmocrmModule основной класс модуля install
 *
 * @author <monshtrina@yandex.ru>
 * @package yupe.modules.amocrm
 * @since 0.1
 *
 */
class AmocrmModule extends yupe\components\WebModule
{
    /**
     *
     */
    const VERSION = '1.3';

    /**
     * Access токен
     *
     * @var string
     */
    public $access_token;

    /**
     * Refresh токен
     *
     * @var string
     */
    public $refresh_token;

    /**
     * Время истечения токена
     *
     * @var string
     */
    public $expires;

    /**
     * Базовый домен
     *
     * @var string
     */
    public $baseDomain;

    /**
     * @var string
     */
    public $clientId;

    /**
     * @var string
     */
    public $clientSecret;

    /**
     * @var string
     */
    public $redirectUri;

    /**
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'clientId' => Yii::t('AmocrmModule.amocrm', 'Integration ID'),
            'clientSecret' => Yii::t('AmocrmModule.amocrm', 'The secret key'),
            'redirectUri' => Yii::t('AmocrmModule.amocrm', 'Redirect link'),
        ];
    }

    /**
     * @return array
     */
    public function getEditableParams()
    {
        return [
            'clientId',
            'clientSecret',
            'redirectUri',
        ];
    }

    /**
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return [
            '0.main' => [
                'label' => Yii::t('AmocrmModule.amocrm', 'Setting up tokens'),
                'items' => [
                    'clientId',
                    'clientSecret',
                    'redirectUri',
                ]
            ]
        ];
    }

    /**
     * Метод получения версии:
     *
     * @return string version
     **/
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Метод получения категории:
     *
     * @return string category
     **/
    public function getCategory()
    {
        return Yii::t('AmocrmModule.amocrm', 'Amo CRM');
    }

    /**
     * Метод получения названия модуля:
     *
     * @return string name
     **/
    public function getName()
    {
        return Yii::t('AmocrmModule.amocrm', 'Amo CRM');
    }

    /**
     * Метод получения описвния модуля:
     *
     * @return string description
     **/
    public function getDescription()
    {
        return Yii::t('AmocrmModule.amocrm', 'Amo CRM');
    }

    /**
     * Метод получения автора модуля:
     *
     * @return string author
     **/
    public function getAuthor()
    {
        return Yii::t('AmocrmModule.amocrm', '');
    }

    /**
     * Метод получения почты автора модуля:
     *
     * @return string author mail
     **/
    public function getAuthorEmail()
    {
        return Yii::t('AmocrmModule.amocrm', 'monshtrina@yandex.ru');
    }

    /**
     * Метод получения ссылки на сайт автора модуля:
     *
     * @return string author url
     **/
    public function getUrl()
    {
        return Yii::t('AmocrmModule.amocrm', '');
    }

    /**
     * Метод получения иконки:
     *
     * @return string icon
     **/
    public function getIcon()
    {
        return 'fa fa-fw fa-list-alt';
    }

    /**
     * Метод получения адреса модуля в админ панели:
     *
     * @return string admin url
     **/
    public function getAdminPageLink()
    {

    }

    /**
     * Метод получения меню модуля (для навигации):
     *
     * @return mixed navigation of module
     **/
    public function getNavigation()
    {
        return [
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('AmocrmModule.amocrm', 'Connect (Status)'),
                'url' => ['/amocrm/amocrmBackend/index'],
            ],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('AmocrmModule.amocrm', 'Clear tokens'),
                'url' => ['/amocrm/amocrmBackend/remove'],
            ],
        ];
    }

    /**
     * Метод инициализации модуля:
     *
     * @return nothing
     **/
    public function init()
    {
        $this->setImport(
            [
                'amocrm.models.*',
            ]
        );

        parent::init();
    }


    /**
     * @return array
     */
    public function getDependencies()
    {
        return ['user'];
    }

    public function getAuthItems()
    {
        return [
        ];
    }
}
