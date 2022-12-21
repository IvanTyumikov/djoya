<?php

return [
    'module' => [
        'class' => 'application.modules.delivery.DeliveryModule',
    ],
    'import' => [
        'application.modules.delivery.models.*',
    ],
    'component' => [
        'deliveryManager' => [
            'class' => 'application.modules.delivery.components.DeliveryManager',
            'deliverySystems' => [
                'manual' => ['class' => 'application.modules.delivery.components.ManualDeliverySystem']
            ],
        ],
    ],
    'rules' => [
        '/delivery-ajax/<action>' => 'delivery/deliveryAjax/<action>',
    ],
];
