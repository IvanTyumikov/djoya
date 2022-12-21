<?php

return [
    'module' => [
        'class' => 'application.modules.cart.CartModule',
    ],
    'import' => [
        'application.modules.cart.components.shopping-cart.*',
        'application.modules.cart.events.*',
        'application.modules.cart.models.CartProduct',
    ],
    'component' => [
        'cart' => [
            'class' => 'application.modules.cart.components.shopping-cart.EShoppingCart',
        ],
        'dadata' => [
            'class' => 'application.modules.cart.components.DaDataComponent',
            'token' => 'c6e5301ef100789a5b8ea9fab80dad1614c789f1',
            'secret' => '5d436a406d6ba9541aef3069c90f3702d58ee408',
        ],
    ],
    'rules' => [
        '/cart'                            => 'cart/cart/index',
        '/cart/<action:\w+>'               => 'cart/cart/<action>',
        '/cart/<action:\w+>/<id:\w+>'      => 'cart/cart/<action>',
        '/dadata/<action:\w+>'             => 'cart/dadata/<action>',
        '/dadata/<action:\w+>/<id:\w+>'    => 'cart/dadata/<action>',
        '/cart/user-ajax/<action>'         => 'cart/userAjax/<action>',
    ],
];
