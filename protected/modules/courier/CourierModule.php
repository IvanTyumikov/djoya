<?php
/**
 * CourierModule основной класс модуля courier
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2020 amyLabs && Yupe! team
 * @package yupe.modules.courier
 * @since 0.1
 */

class CourierModule  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';

    /**
     * Массив с именами модулей, от которых зависит работа данного модуля
     *
     * @return array
     */
    public function getDependencies()
    {
        return parent::getDependencies();
    }

    /**
     * Работоспособность модуля может зависеть от разных факторов: версия php, версия Yii, наличие определенных модулей и т.д.
     * В этом методе необходимо выполнить все проверки.
     *
     * @return array или false
     */
    public function checkSelf()
    {
        return parent::checkSelf();
    }

    /**
     * Каждый модуль должен принадлежать одной категории, именно по категориям делятся модули в панели управления
     *
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('CourierModule.courier', 'content');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        return parent::getParamsLabels();
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        return parent::getEditableParams();
    }

    /**
     * массив групп параметров модуля, для группировки параметров на странице настроек
     *
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return parent::getEditableParamsGroups();
    }

    /**
     * если модуль должен добавить несколько ссылок в панель управления - укажите массив
     *
     * @return array
     */
    public function getNavigation()
    {
        return false;
    }

    /**
     * текущая версия модуля
     *
     * @return string
     */
    public function getVersion()
    {
        return Yii::t('CourierModule.courier', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('CourierModule.courier', 'https://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('CourierModule.courier', 'Доставка курьером');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('CourierModule.courier', 'Описание модуля "Доставка курьером"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('CourierModule.courier', 'yupe team');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('CourierModule.courier', 'team@yupe.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return false;
    }

    public function getIsShowInAdminMenu()
    {
        return false;
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-pencil";
    }

    /**
      * Возвращаем статус, устанавливать ли галку для установки модуля в инсталяторе по умолчанию:
      *
      * @return bool
      **/
    public function getIsInstallDefault()
    {
        return parent::getIsInstallDefault();
    }

    /**
     * Инициализация модуля, считывание настроек из базы данных и их кэширование
     *
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'courier.models.*',
                'courier.components.*',
            ]
        );
    }

    /**
     * Массив правил модуля
     * @return array
     */
    public function getAuthItems()
    {
        return [
            [
                'name' => 'Courier.CourierManager',
                'description' => Yii::t('CourierModule.courier', 'Manage courier'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Courier.CourierBackend.Index',
                        'description' => Yii::t('CourierModule.courier', 'Index')
                    ],
                ]
            ]
        ];
    }
}
