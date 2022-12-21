<?php

class AlFancybox extends yupe\widgets\YWidget
{
    public $id;
    public $target;
    public $lang;
    public $config = [];

    public function init()
    {
        if (!isset($this->id)) {
            $this->id = $this->getId();
        }

        if (!isset($this->lang)) {
            $this->lang = Yii::app()->language;
        }

        $this->publishAssets();
    }

    public function run()
    {
        $config = CJavaScript::encode($this->config);
        Yii::app()->clientScript->registerScript(
            $this->getId(),
            "$('$this->target').fancybox($config);"
        );
    }

    public function publishAssets()
    {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);

        if (is_dir($assets)) {
            // Yii::app()->getClientScript()->registerCssFile($baseUrl . '/jquery.fancybox.min.css');
            Yii::app()->getClientScript()->registerLinkTag('preload stylesheet', 'text/css', $baseUrl . '/jquery.fancybox.min.css');
            Yii::app()->getClientScript()->registerScriptFile($baseUrl . '/jquery.fancybox.min.js', CClientScript::POS_END);
        }
    }
}