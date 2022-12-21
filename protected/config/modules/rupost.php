<?php
/**
 * Файл настроек для модуля rupost
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2020 amyLabs && Yupe! team
 * @package yupe.modules.rupost.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.rupost.RupostModule',
    ],
    'import'    => [
        'application.modules.rupost.forms.*'
    ],
    'component' => [
        'deliveryManager' => [
            'class' => 'application.modules.delivery.components.DeliveryManager',
            'deliverySystems' => [
                'rupost' => [
                    'class' => 'application.modules.rupost.components.delivery.RupostSystem'
                ]
            ],
        ],
    ],
    'rules'     => [
        "/rupost/<action>" => "rupost/rupost/<action>"
    ],
];
