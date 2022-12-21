<?php
return array(
    'module'    => array(
        'class' => 'application.modules.review.ReviewModule',
    ),
    'import'    => [
        'application.modules.review.models.*',
        'application.modules.review.ReviewModule',
    ],
    'component' => [
        'ReviewManager' => [
            'class' => 'application.modules.review.components.ReviewManager',
        ],
    ],
    'rules'     => array(
        '/review/page/<page>' => 'review/review/show',
        '/review' => 'review/review/show',
    	'/review/create' => 'review/review/create',
    ),
);
