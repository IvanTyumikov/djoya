<?php

/**
 * RetailcrmModule основной класс модуля install
 *
 * @author <monshtrina@yandex.ru>
 * @package yupe.modules.retailcrm
 * @since 0.1
 *
 */
class RetailcrmModule extends yupe\components\WebModule
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
    public $api_key = 'nsu8nilJoYq6KwfXZBPWkLAxB0vqlW7u';

    /**
     * Базовый домен
     *
     * @var string
     */
    public $base_domain = 'https://test.ru';


    /**
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'api_key' => Yii::t('RetailcrmModule.retailcrm', 'Api key'),
            'base_domain' => Yii::t('RetailcrmModule.retailcrm', 'Domain'),
        ];
    }

    /**
     * @return array
     */
    public function getEditableParams()
    {
        return [
            'api_key',
            'base_domain',
        ];
    }

    /**
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return [
            '0.main' => [
                'label' => Yii::t('RetailcrmModule.retailcrm', 'Settings'),
                'items' => [
                    'api_key',
                    'base_domain',
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
        return Yii::t('RetailcrmModule.retailcrm', 'Retail CRM');
    }

    /**
     * Метод получения названия модуля:
     *
     * @return string name
     **/
    public function getName()
    {
        return Yii::t('RetailcrmModule.retailcrm', 'Retail CRM');
    }

    /**
     * Метод получения описвния модуля:
     *
     * @return string description
     **/
    public function getDescription()
    {
        return Yii::t('RetailcrmModule.retailcrm', 'Retail CRM');
    }

    /**
     * Метод получения автора модуля:
     *
     * @return string author
     **/
    public function getAuthor()
    {
        return Yii::t('RetailcrmModule.retailcrm', 'Nikkable');
    }

    /**
     * Метод получения почты автора модуля:
     *
     * @return string author mail
     **/
    public function getAuthorEmail()
    {
        return Yii::t('RetailcrmModule.retailcrm', 'monshtrina@yandex.ru');
    }

    /**
     * Метод получения ссылки на сайт автора модуля:
     *
     * @return string author url
     **/
    public function getUrl()
    {
        return Yii::t('RetailcrmModule.retailcrm', 'https://vk.com/nikkable');
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
                'label' => Yii::t('RetailcrmModule.retailcrm', 'Connect (Status)'),
                'url' => ['/retailcrm/retailcrmBackend/index'],
            ],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('RetailcrmModule.retailcrm', 'Clear tokens'),
                'url' => ['/retailcrm/retailcrmBackend/remove'],
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
                'retailcrm.models.*',
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
