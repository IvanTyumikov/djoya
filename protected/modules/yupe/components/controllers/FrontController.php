<?php
/**
 * Базовый класс для всех контроллеров публичной части
 *
 * @category YupeComponents
 * @package  yupe.modules.yupe.components.controllers
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @version  0.6
 * @link     https://yupe.ru
 **/

namespace yupe\components\controllers;

use Yii;
use yupe\events\YupeControllerInitEvent;
use yupe\events\YupeEvents;
use application\components\Controller;

/**
 * Class FrontController
 * @package yupe\components\controllers
 */
abstract class FrontController extends Controller
{
    public $mainAssets;
    public $storeItem = "_item"; // Выбираем  отображение боксами, списком или большим списком
    public $storeCountPage = 12;
    public $viewRender; // Определяем, в какой мы вьюхе находимся
    public $isHome = false; // Определяем, на главной странице мы находмся, или нет
    public $classLayout = ''; // Передаем класс в нужный лайоут
    public $utm = []; // UTM метки
    public $robots;
    public $canonical;

    /**
     * Вызывается при инициализации FrontController
     * Присваивает значения, необходимым переменным
     */
    public function init()
    {
        Yii::app()->eventManager->fire(YupeEvents::BEFORE_FRONT_CONTROLLER_INIT, new YupeControllerInitEvent($this, Yii::app()->getUser()));

//        Yii::app()->theme = $this->yupe->theme ?: 'default';

        $this->mainAssets = Yii::app()->getTheme()->getAssetsUrl();

        $bootstrap = Yii::app()->getTheme()->getBasePath() . DIRECTORY_SEPARATOR . "bootstrap.php";

        if (is_file($bootstrap)) {
            require $bootstrap;
        }

        parent::init();
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'InlineWidgetsBehavior' => [
                'class' => 'yupe.components.behaviors.InlineWidgetsBehavior',
                'classSuffix' => 'Widget',
                'startBlock' => '[[w:',
                'endBlock' => ']]',
                'widgets' => Yii::app()->params['runtimeWidgets'],
            ],
        ];
    }

    /**
     * beforeAction
    */
    public function beforeAction($action)
    {
        // Записываем выбранное отображение в cookie, если не существует
        if(isset($_COOKIE["store_item"])) {
            $this->storeItem = $_COOKIE["store_item"];
        }

        if(isset($_COOKIE["store_count"])) {
            $this->storeCountPage = $_COOKIE["store_count"];
        }

        // Записываем UTM если существуют
        if(isset($_GET['utm_campaign'])){
            $this->utm = [
                'utm_campaign' => $_GET['utm_campaign'],
            ];
        }

        if(isset($_GET['utm_term'])){
            $this->utm += ['utm_term' => $_GET['utm_term']];
        }

        if(isset($_GET['utm_content'])){
            $this->utm += ['utm_content' => $_GET['utm_content']];
        }

        if(isset($_GET['utm_source'])){
            $this->utm += ['utm_source' => $_GET['utm_source']];
        }

        if(isset($_GET['utm_medium'])){
            $this->utm += ['utm_medium' => $_GET['utm_medium']];
        }

        return parent::beforeAction($action);
    }
}
