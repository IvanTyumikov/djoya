<?php

use yupe\components\WebModule;

/**
 * Class AlfabankModule
 */
class AlfabankModule extends WebModule
{
    /**
     *
     */
    const VERSION = '1';

    /**
     * @return array
     */
    public function getDependencies()
    {
        return ['payment'];
    }

    /**
     * @return bool
     */
    public function getNavigation()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getAdminPageLink()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getIsShowInAdminMenu()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * @return array
     */
    public function getEditableParams()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('AlfabankModule.alfabank', 'Store');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return Yii::t('AlfabankModule.alfabank', 'Alfabank');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return Yii::t('AlfabankModule.alfabank', 'Alfabank payment module');
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('AlfabankModule.alfabank', 'CopyPast');
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('AlfabankModule.alfabank', 'monshtrina@yandex.ru');
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-rub';
    }

    /**
     *
     */
    public function init()
    {
        parent::init();
    }

}
