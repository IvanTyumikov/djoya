<?php
/**
 * Файл настроек для модуля courier
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2020 amyLabs && Yupe! team
 * @package yupe.modules.courier.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.courier.CourierModule',
    ],
    'import'    => [
        'application.modules.courier.forms.*'
    ],
    'component' => [
        'deliveryManager' => [
            'class' => 'application.modules.delivery.components.DeliveryManager',
            'deliverySystems' => [
                'courier' => [
                    'class' => 'application.modules.courier.components.delivery.CourierSystem'
                ]
            ],
        ],
    ],
    'rules'     => [
        '/courier/<action>' => 'courier/courier/<action>',
    ],
];
