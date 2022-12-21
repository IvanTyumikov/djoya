<?php
/**
 * Файл настроек для модуля slider
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2017 amyLabs && Yupe! team
 * @package yupe.modules.slider.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.slider.SliderModule',
    ],
    'import'    => [],
    'component' => [],
    'rules'     => [
        '/slider' => 'slider/slider/index',
    ],
];