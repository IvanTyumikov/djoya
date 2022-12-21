<?php
/**
 * QuestModule основной класс модуля quest
 *
 * @author Nikkable
 * @link https://vk.com/nikkable
 * @copyright 2009-2017 amyLabs && Yupe! team
 * @package yupe.modules.quest
 * @since 0.1
 */

class QuestModule  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';
    /**
     * @var string
     */
    public $uploadPath = 'quest';
    /**
     * @var string
     */
    public $allowedExtensions = 'jpg,jpeg,png,gif';
    /**
     * @var int
     */
    public $minSize = 0;
    /**
     * @var int
     */
    public $maxSize = 5368709120;
    /**
     * @var int
     */
    public $maxFiles = 1;
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
        return Yii::t('QuestModule.quest', 'Content');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        // return parent::getParamsLabels();
        return [

        ];
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        //return parent::getEditableParams();
        return [
        ];
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
        return [
            ['label' => Yii::t('QuestModule.quest', 'Quest')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('QuestModule.quest', 'Quest'),
                'url' => ['/quest/questBackend/index']
            ],
            [
                'icon' => 'fa fa-fw fa-folder-open',
                'label' => Yii::t('QuestModule.quest', 'Категории'),
                'url' => ['/quest/questCategoryBackend/index']
            ],
        ];
    }

    /**
     * текущая версия модуля
     *
     * @return string
     */
    public function getVersion()
    {
        return Yii::t('QuestModule.quest', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('QuestModule.quest', 'https://vk.com/nikkable');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('QuestModule.quest', 'Quest');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('QuestModule.quest', 'Описание модуля "Quest"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('QuestModule.quest', 'Nikkable');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('QuestModule.quest', 'monshtrina@yandex.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/quest/questBackend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-file";
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
                'quest.models.*',
                'quest.components.*',
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
                'name' => 'Video.VideoManager',
                'description' => Yii::t('QuestModule.quest', 'Manage'),
                'type' => AuthItem::TYPE_ROLE,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_TASK,
                        'name' => 'Quest.QuestCategoryBackend.Management',
                        'description' => Yii::t('QuestModule.quest', 'Categories'),
                        'items' => [
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestCategoryBackend.Index',
                                'description' => Yii::t('QuestModule.quest', 'Index')
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestCategoryBackend.Create',
                                'description' => Yii::t('QuestModule.quest', 'Creating'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestCategoryBackend.Delete',
                                'description' => Yii::t('QuestModule.quest', 'Removing'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestCategoryBackend.Update',
                                'description' => Yii::t('QuestModule.quest', 'Editing'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestCategoryBackend.View',
                                'description' => Yii::t('QuestModule.quest', 'Viewing'),
                            ],
                        ]
                    ],
                    [
                        'type' => AuthItem::TYPE_TASK,
                        'name' => 'Quest.QuestBackend.Management',
                        'description' => Yii::t('QuestModule.quest', 'Manage'),
                        'items' => [
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestBackend.Index',
                                'description' => Yii::t('QuestModule.quest', 'Index')
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestBackend.Create',
                                'description' => Yii::t('QuestModule.quest', 'Creating'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestBackend.Delete',
                                'description' => Yii::t('QuestModule.quest', 'Removing'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestBackend.Update',
                                'description' => Yii::t('QuestModule.quest', 'Editing'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Quest.QuestBackend.View',
                                'description' => Yii::t('QuestModule.quest', 'Viewing'),
                            ],
                        ]
                    ],
                ]
            ]
        ];
    }
}
