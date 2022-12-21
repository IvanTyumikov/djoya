<?php
/**
 * VideoModule основной класс модуля video
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2017 amyLabs && Yupe! team
 * @package yupe.modules.video
 * @since 0.1
 */

class VideoModule  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';
    public $url;
    /**
     * @var string
     */
    public $uploadPath = 'video';
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
        return Yii::t('VideoModule.video', 'Content');
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
            'url' => Yii::t('VideoModule.video', 'Адрес на страницу все видео'),
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
            'url',
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
            ['label' => Yii::t('VideoModule.video', 'video')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('VideoModule.video', 'video'),
                'url' => ['/video/videoBackend/index']
            ],
            [
                'icon' => 'fa fa-fw fa-folder-open',
                'label' => Yii::t('VideoModule.video', 'Категории'),
                'url' => ['/video/videoCategoryBackend/index']
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
        return Yii::t('VideoModule.video', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('VideoModule.video', 'http://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('VideoModule.video', 'video');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('VideoModule.video', 'Описание модуля "video"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('VideoModule.video', 'yupe team');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('VideoModule.video', 'team@yupe.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/video/videoBackend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-youtube-play";
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
                'video.models.*',
                'video.components.*',
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
                'description' => Yii::t('VideoModule.video', 'Manage video'),
                'type' => AuthItem::TYPE_ROLE,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_TASK,
                        'name' => 'Video.VideoCategoryBackend.Management',
                        'description' => Yii::t('VideoModule.video', 'Video categories'),
                        'items' => [
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoCategoryBackend.Index',
                                'description' => Yii::t('VideoModule.video', 'Index')
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoCategoryBackend.Create',
                                'description' => Yii::t('VideoModule.video', 'Creating block'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoCategoryBackend.Delete',
                                'description' => Yii::t('VideoModule.video', 'Removing block'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoCategoryBackend.Update',
                                'description' => Yii::t('VideoModule.video', 'Editing blocks'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoCategoryBackend.View',
                                'description' => Yii::t('VideoModule.video', 'Viewing blocks'),
                            ],
                        ]
                    ],
                    [
                        'type' => AuthItem::TYPE_TASK,
                        'name' => 'Video.VideoBackend.Management',
                        'description' => Yii::t('VideoModule.video', 'Manage video'),
                        'items' => [
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoBackend.Index',
                                'description' => Yii::t('VideoModule.video', 'Index')
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoBackend.Create',
                                'description' => Yii::t('VideoModule.video', 'Creating block'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoBackend.Delete',
                                'description' => Yii::t('VideoModule.video', 'Removing block'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoBackend.Update',
                                'description' => Yii::t('VideoModule.video', 'Editing blocks'),
                            ],
                            [
                                'type' => AuthItem::TYPE_OPERATION,
                                'name' => 'Video.VideoBackend.View',
                                'description' => Yii::t('VideoModule.video', 'Viewing blocks'),
                            ],
                        ]
                    ],
                ]
            ]
        ];
    }
}
