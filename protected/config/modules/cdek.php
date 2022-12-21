<?php
/**
 * Файл настроек для модуля cdek
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2020 amyLabs && Yupe! team
 * @package yupe.modules.cdek.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.cdek.CdekModule',
    ],
    'import'    => [
        'application.modules.cdek.forms.*'
    ],
    'component' => [
        'deliveryManager' => [
            'class' => 'application.modules.delivery.components.DeliveryManager',
            'deliverySystems' => [
                'cdek' => [
                    'class' => 'application.modules.cdek.components.delivery.CdekSystem'
                ]
            ],
        ],
    ],
    'rules'     => [
        '/cdek/<action>' => 'cdek/cdek/<action>',
    ],
];
