<?php

/**
 * ReviewModule основной класс модуля review
 *
 */
class ReviewModule extends yupe\components\WebModule
{
    const VERSION = '1';
	public $itemsperpage = 1;
	public $itemsperpagefront = 1;
	public $moderation = 1;
	public $email_from = "";
    public $email_notification = "";
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

    public $metaTitle;
    /**
     * @var
     */
    public $metaDescription;
    /**
     * @var
     */
    public $metaKeyWords;
	 
    public function getDependencies()
    {
        return array(
        );
    }
	
    public function getParamsLabels()
    {
        return array(
        		'itemsperpage' => 'Отзывов на странице панели управления',
        		'itemsperpagefront' => 'Отзывов на странице сайта',
        		'moderation' => 'Отправлять отзывы на модерацию',
        		'adminMenuOrder' => 'adminMenuOrder',
        		'email_from' => 'E-mail от кого приходят уведомления',
                'email_notification' => 'E-mail для уведомлений',
                'metaTitle' => 'Тег title для раздела отзывы',
                'metaDescription' => 'Тег description для раздела отзывы',
                'metaKeyWords' => 'Тег keywords для раздела отзывы',
        );
    }

    public function getVersion()
    {
        return self::VERSION;
    }

    public function getEditableParams()
    {
        return array(
        		'itemsperpage' => array(10,12,20,30,50,100),
        		'itemsperpagefront' => array(10,12,20,30,50,100),
        		'moderation' => array("1"=>"Да","0"=>"Нет"),
        		'email_from',
                'email_notification',
        		'adminMenuOrder' => array(""),
                'metaTitle',
                'metaDescription',
                'metaKeyWords',
        );
    }

    public function getIsInstallDefault()
    {
        return true;
    }

    public function getCategory()
    {
        return Yii::t('ReviewModule.review', 'Сервисы');
    }

    public function getName()
    {
        return "Отзывы";
    }

    public function getDescription()
    {
        return "Модуль отзывов";
    }

    public function getAuthor()
    {
        return "green-s.pro";
    }

    public function getAuthorEmail()
    {
        return "green.rnd@ya.ru";
    }

    public function getUrl()
    {
        return "green-s.pro";
    }

    public function getIcon()
    {
        return "fa fa-fw fa-file";
    }

    public function init()
    {
        parent::init();

        $this->setImport(
            array(
                'application.modules.review.models.*',
                'application.modules.review.components.widgets.*',
            )
        );

        // Если у модуля не задан редактор - спросим у ядра
        if (!$this->editor) {
            $this->editor = Yii::app()->getModule('yupe')->editor;
        }
    }

    public function isMultiLang()
    {
        return false;
    }

    public function getAdminPageLink()
    {
        return '/review/reviewBackend/index';
    }

    public function getNavigation()
    {
        return array(
            array(
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => 'Список отзывов',
                'url'   => array('/review/reviewBackend/index')
            ),

        );
    }

    public function getAuthItems()
    {
        return array(
            array(
                'name'        => 'Review.ReviewManager',
                'description' => 'Управление отзывами',
                'type'        => AuthItem::TYPE_TASK,
                'items'       => array(
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Review.ReviewBackend.Create',
                        'description' => 'Добавление отзыва'
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Review.ReviewBackend.Delete',
                        'description' => 'Удаление отзыва'
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Review.ReviewBackend.Index',
                        'description' => 'Список отзывов'
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Review.ReviewBackend.Update',
                        'description' => 'Редактировать отзывы'
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Review.ReviewBackend.Inline',
                        'description' => 'Редактировать отзывы'
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Review.ReviewBackend.View',
                        'description' => 'Просмотр отзывов'
                    ),
                )
            )
        );
    }
    public function getModerationStatus($moderation)
    {
    	switch ($moderation) {
    		case 0:
    			return "Отклонен";
    			break;
    		case 1:
    			return "Опубликован";
    			break;
    		case 2:
    			return "На модерации";
    			break;

    		default:
    		    break;
    	}
    }
}
