<?php

use yupe\components\WebModule;

/**
 * Class CredittinkoffModule
 */
class CredittinkoffModule extends WebModule
{
    /**
     *
     */
    const VERSION = '1.0';

    /**
     * @return array
     */
    public function getDependencies()
    {
        return ['payment'];
    }

    /**
     * @return array
     */
    public function getNavigation()
    {
        return [];
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
        return Yii::t('CredittinkoffModule.credittinkoff', 'Store');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return Yii::t('CredittinkoffModule.credittinkoff', 'Credit tinkoff');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return Yii::t('CredittinkoffModule.credittinkoff', 'Credit Tinkoff payment module');
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('CredittinkoffModule.credittinkoff', 'Nikkable');
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('CredittinkoffModule.credittinkoff', 'monshtrina@yandex.ru');
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-rub';
    }
}
