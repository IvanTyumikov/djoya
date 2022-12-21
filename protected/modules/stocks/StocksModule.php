<?php

/**
 * StocksModule основной класс модуля stocks
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2019 amyLabs && Yupe! team
 * @package yupe.modules.stocks
 * @since 0.1
 */

use yupe\components\WebModule;

class StocksModule extends WebModule
{
    const VERSION = '1';

    /**
     * @var string
     */
    public $uploadPath = 'stocks';
    public $uploadPathBgStock = 'stocks-bg';
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
     * @var string
     */
    public $title;
    public $description;

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
     * Каждый модуль должен принадлежать одной категории, именно по категориям делятся модули в панели управления
     *
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('StocksModule.stocks', 'Content');
    }

    /**
     * @return bool
     */
    public function getInstall()
    {
        if (parent::getInstall()) {
            @mkdir(Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath, 0755);
        }

        return false;
    }

    /**
     * @return array|bool
     */
    public function checkSelf()
    {
        $messages = [];

        $uploadPath = Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath;

        if (!is_writable($uploadPath)) {
            $messages[WebModule::CHECK_ERROR][] = [
                'type' => WebModule::CHECK_ERROR,
                'message' => Yii::t(
                    'StocksModule.stocks',
                    'Directory "{dir}" is not accessible for write! {link}',
                    [
                        '{dir}' => $uploadPath,
                        '{link}' => CHtml::link(
                            Yii::t('StocksModule.stocks', 'Change settings'),
                            [
                                '/yupe/backend/modulesettings/',
                                'module' => 'stocks',
                            ]
                        ),
                    ]
                ),
            ];
        }

        return (isset($messages[WebModule::CHECK_ERROR])) ? $messages : true;
    }

    /**
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'editor' => Yii::t('StocksModule.stocks', 'Visual editor'),
            'uploadPath' => Yii::t(
                'StocksModule.stocks',
                'Uploading files catalog (relatively {path})',
                [
                    '{path}' => Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . Yii::app()->getModule(
                        "yupe"
                    )->uploadPath,
                ]
            ),
            'allowedExtensions' => Yii::t('StocksModule.stocks', 'Accepted extensions (separated by comma)'),
            'minSize' => Yii::t('StocksModule.stocks', 'Minimum size (in bytes)'),
            'maxSize' => Yii::t('StocksModule.stocks', 'Maximum size (in bytes)'),
            'title' => Yii::t('StocksModule.stocks', 'Title'),
            'description' => Yii::t('StocksModule.stocks', 'Description')
        ];
    }

    /**
     * @return array
     */
    public function getEditableParams()
    {
        return [
            'editor' => Yii::app()->getModule('yupe')->getEditors(),
            'uploadPath',
            'allowedExtensions',
            'minSize',
            'maxSize',
            'title',
            'description',
        ];
    }

    /**
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return [
            'main' => [
                'label' => Yii::t('StocksModule.stocks', 'General module settings'),
                'items' => [
                    'editor',
                ],
            ],
            'images' => [
                'label' => Yii::t('StocksModule.stocks', 'Stocks settings'),
                'items' => [
                    'uploadPath',
                    'allowedExtensions',
                    'minSize',
                    'maxSize',
                ],
            ],
            'seo' => [
                'label' => Yii::t('StocksModule.stocks', 'SEO settings'),
                'items' => [
                    'title',
                    'description',                    
                ],
            ],
        ];
    }

    /**
     * если модуль должен добавить несколько ссылок в панель управления - укажите массив
     *
     * @return array
     */
    public function getNavigation()
    {
        return [
            ['label' => Yii::t('StocksModule.stocks', 'Stocks')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('StocksModule.stocks', 'Stocks list'),
                'url' => ['/stocks/stocksBackend/index']
            ],
        ];
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * @return bool
     */
    public function getIsInstallDefault()
    {
        return true;
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('StocksModule.stocks', 'http://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('StocksModule.stocks', 'Stocks');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('StocksModule.stocks', 'Online store stock module');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('StocksModule.stocks', 'nikkable');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('StocksModule.stocks', 'monshtrina@yandex.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/stocks/stocksBackend/index';
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
     * @return bool
     */
    public function isMultiLang()
    {
        return true;
    }

    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'stocks.models.*',
            ]
        );
    }

    /**
     * @return array
     */
    public function getAuthItems()
    {
        return [
            [
                'name' => 'Stocks.StocksManager',
                'description' => Yii::t('StocksModule.stocks', 'Manage stocks'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Stocks.StocksBackend.Create',
                        'description' => Yii::t('StocksModule.stocks', 'Creating stock'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Stocks.StocksBackend.Delete',
                        'description' => Yii::t('StocksModule.stocks', 'Removing stock'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Stocks.StocksBackend.Index',
                        'description' => Yii::t('StocksModule.stocks', 'List of stocks'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Stocks.StocksBackend.Update',
                        'description' => Yii::t('StocksModule.stocks', 'Editing stocks'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Stocks.StocksBackend.View',
                        'description' => Yii::t('StocksModule.stocks', 'Viewing stocks'),
                    ],
                ],
            ],
        ];
    }
}
