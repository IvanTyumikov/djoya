<?php

return [
    'module' => [
        'class' => 'application.modules.alfabank.AlfabankModule',
    ],
    'component' => [
        'paymentManager' => [
            'paymentSystems' => [
                'alfabank' => [
                    'class' => 'application.modules.alfabank.components.payments.AlfabankPaymentSystem',
                ]
            ],
        ],
    ],
];
