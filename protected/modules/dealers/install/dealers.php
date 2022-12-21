<?php
/**
 * Файл настроек для модуля dealers
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2019 amyLabs && Yupe! team
 * @package yupe.modules.dealers.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.dealers.DealersModule',
    ],
    'import'    => [],
    'component' => [],
    'rules'     => [
        '/dealers' => 'dealers/dealers/index',
        '/dealers/<slug>' => 'dealers/dealersCity/view',
    ],
];