<?php
/**
 * PagesWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.page.widgets
 * @since 0.1
 *
 */
Yii::import('application.modules.page.models.*');

/**
 * Class PagesProductWidget
 */
class PagesWidget extends yupe\widgets\YWidget
{
    /**
     * @var
     */
    public $pageStatus;
    /**
     * @var bool
     */
    public $isUseDataProvider = 0;
    public $topLevelOnly = false;
    /**
     * @var string
     */
    public $order = 't.order ASC, t.create_time ASC';
    /**
     * @var
     */
    public $limit = null;
    /**
     * @var
     */
    public $parent_id;
    /**
     * @var string
     */

    public $category_id;
    /**
     * @var string
     */
    public $view = 'pageswidget';
    /**
     * @var bool
     */
    public $visible = true;

    public $delete = null;

    public $statusDraft = false;
    public $activeTab = 0;

    /**
     *
     */
    public function init()
    {
        parent::init();

        if (!$this->pageStatus) {
            $this->pageStatus = Page::STATUS_PUBLISHED;
        }

        $this->parent_id = (int)$this->parent_id;
        $this->category_id = (int)$this->category_id;

    }

    /**
     * @throws CException
     */
    public function run()
    {
        if ($this->visible) {
            $criteria = new CDbCriteria();
            $criteria->order = $this->order;

            if($this->statusDraft){
                $criteria->addCondition("status = 0");
            } else {
                $criteria->addCondition("status = {$this->pageStatus}");
            }
            
            if ($this->limit) {
                $criteria->limit = (int)$this->limit;
            }

            // if (!Yii::app()->user->isAuthenticated()) {
            //     $criteria->addCondition('is_protected = '.Page::PROTECTED_NO);
            // }
            if ($this->parent_id) {
                $criteria->addCondition("parent_id = {$this->parent_id}");
            }

            if ($this->delete) {
                $criteria->addCondition($this->delete);
            }

            if ($this->category_id) {
                $criteria->addCondition("category_id = {$this->category_id}");
            }
            if ($this->topLevelOnly) {
                $criteria->addCondition("parent_id is null or parent_id = 0");
            }
                if ((int)$this->isUseDataProvider) {
                $pages = new CActiveDataProvider('Page', [
                    'criteria' => $criteria,
                    'pagination' => [
                        'pageSize' => $this->pageSize
                    ],
                ]);
            } else {
                $pages = Page::model()->cache($this->cacheTime)->findAll($criteria);
            }

            $this->render(
                $this->view,
                [
                    'pages' => Page::model()->cache($this->cacheTime)->findAll($criteria),
                ]
            );
        }
    }
}
