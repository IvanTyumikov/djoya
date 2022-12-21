<?php

return [
    'module' => [
        'class' => 'application.modules.store.StoreModule',
    ],
    'import' => [
        'application.modules.store.models.*',
        'application.modules.store.events.*',
        'application.modules.store.listeners.*',
        'application.modules.store.components.helpers.*',
        'application.modules.review.models.*',
    ],
    'component' => [
        'eventManager' => [
            'class' => 'yupe\components\EventManager',
            'events' => [
                'sitemap.before.generate' => [
                    ['\StoreSitemapGeneratorListener', 'onGenerate']
                ],
                'category.after.save' => [
                    ['\StoreCategoryListener', 'onAfterSave']
                ],
                'category.after.delete' => [
                    ['\StoreCategoryListener', 'onAfterDelete']
                ],
            ]
        ],
        'money' => [
            'class' => 'application.modules.store.components.Money',
        ],
        'productRepository' => [
            'class' => 'application.modules.store.components.repository.ProductRepository'
        ],
        'producerRepository' => [
            'class' => 'application.modules.store.components.repository.ProducerRepository'
        ],
        'categoryRepository' => [
            'class' => 'application.modules.store.components.repository.StoreCategoryRepository'
        ],
        'attributesFilter' => [
            'class' => 'application.modules.store.components.AttributeFilter'
        ],
        'session' => [
            'class' => 'CHttpSession',
            'timeout' => 86400,
            'cookieParams' => ['httponly' => true]
        ]
    ],
    'rules' => [
        '/store' => 'store/product/index',
        '/store/search' => 'store/product/search',
        '/store/searchx' => 'store/category/search',
        '/store/categories' => 'store/category/index',
        '/store/brand/<slug:[\w_\/-]+>' => 'store/producer/view',
        '/store/brands' => 'store/producer/index',
        '/store/<path:[\w_\/-]+>' => 'store/category/view',
        '/offers/<action>' => 'store/offers/<action>',
        // ['store/product/view', 'pattern' => '/store/<category:[\w_\/-]+>/<name:[\w_\/-]+>', 'urlSuffix' => '.html'],
//        ['store/product/view', 'pattern' => '/store/<name:[\w_\/-]+>', 'urlSuffix' => '.html'],
//        '/review-modal/<id>' => 'store/product/review',
//        '/product-modal/<id>' => 'store/product/product',
        '/product/<name>' => 'store/product/view',
        '/product/images-color' => 'store/product/imagesColor',
    ],
];
