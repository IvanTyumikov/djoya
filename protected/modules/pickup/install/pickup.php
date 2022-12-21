<?php
/**
 * Файл настроек для модуля pickup
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2020 amyLabs && Yupe! team
 * @package yupe.modules.pickup.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.pickup.PickupModule',
    ],
    'import'    => [],
    'component' => [
        'deliveryManager' => [
            'class' => 'application.modules.delivery.components.DeliveryManager',
            'deliverySystems' => [
                'pickup' => [
                    'class' => 'application.modules.pickup.components.delivery.PickupSystem'
                ]
            ],
        ],
    ],
    'rules'     => [
        '/pickup' => 'pickup/pickup/index',
    ],
];
