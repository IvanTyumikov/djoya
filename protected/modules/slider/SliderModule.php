<?php
/**
 * SliderModule основной класс модуля slider
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2017 amyLabs && Yupe! team
 * @package yupe.modules.slider
 * @since 0.1
 */

class SliderModule  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';

    /**
     * @var string
     */
    public $uploadPath = 'slider';
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
     * @var int
     */

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
        return Yii::t('SliderModule.slider', 'Контент');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'uploadPath' => 'Uploading files catalog',
            'allowedExtensions' => 'Accepted extensions (separated by comma)',
            'minSize' => 'Minimum size (in bytes)',
            'maxSize' => 'Maximum size (in bytes)',
        ];
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        return [
            'uploadPath',
            'allowedExtensions',
            'minSize',
            'maxSize',
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
            ['label' => Yii::t('SliderModule.slider', 'Слайды')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('SliderModule.slider', 'Слайды'),
                'url' => ['/slider/sliderBackend/index']
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
        return Yii::t('SliderModule.slider', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('SliderModule.slider', 'http://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('SliderModule.slider', 'Слайды');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('SliderModule.slider', 'Описание модуля "slider"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('SliderModule.slider', 'yupe team');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('SliderModule.slider', 'team@yupe.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/slider/sliderBackend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-picture-o";
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
                'slider.models.*',
                'slider.components.*',
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
                'name' => 'Slider.SliderManager',
                'description' => Yii::t('SliderModule.slider', 'Manage slider'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Slider.SliderBackend.Index',
                        'description' => Yii::t('SliderModule.slider', 'Index')
                    ],
                ]
            ]
        ];
    }
}
