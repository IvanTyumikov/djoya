<?php
/**
 * Файл настроек для модуля city
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2019 amyLabs && Yupe! team
 * @package yupe.modules.city.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.city.CityModule',
    ],
    'import'    => [
        'application.modules.city.components.*',
        'application.modules.city.models.*',
    ],
    'component' => [
        'inflection' => [
            'class' => 'application.modules.city.components.Inflection',
		],
    ],
    'rules'     => [
        '/city' => 'city/city/index',
        '/filial-<slug>' => 'city/city/view',
    ],
];