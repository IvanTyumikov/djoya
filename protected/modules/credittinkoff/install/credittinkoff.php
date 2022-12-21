<?php

return [
    'module' => [
        'class' => 'application.modules.credittinkoff.CredittinkoffModule',
    ],
    'component' => [
        'paymentManager' => [
            'paymentSystems' => [
                'credittinkoff' => [
                    'class' => 'application.modules.credittinkoff.components.payments.CredittinkoffPaymentSystem',
                ]
            ],
        ],
    ],
    'rules' => [
        '/credittinkoff/init/<orderId:\w+>' => 'credittinkoff/payment/init',
    ],
];
