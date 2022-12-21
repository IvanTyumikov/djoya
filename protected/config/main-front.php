<?php
$config = require(__DIR__.'/main.php');

return CMap::mergeArray($config, [
    'components' => [
        'clientScript' => [
            'scriptMap' => [
                // 'jquery.js' => '/js/jquery-3.4.1.js',
                // 'jquery.min.js' => '/js/jquery-3.4.1.min.js',
                //'jquery-ui.min.js' => '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js',
            ],
            // 'class' => 'application.modules.yupe.extensions.EClientScript.EClientScript',
            // 'combineScriptFiles' => false, // By default this is set to true, set this to true if you'd like to combine the script files
            // 'combineCssFiles' => false, // By default this is set to true, set this to true if you'd like to combine the css files
            // 'optimizeScriptFiles' => false,    // @since: 1.1
            // 'optimizeCssFiles' => false, // @since: 1.1
            // 'optimizeInlineScript' => false, // @since: 1.6, This may case response slower
            // 'optimizeInlineCss' => false, // @since: 1.6, This may case response slower
            'packages' => [
                'maskedinput' => [
                    'baseUrl' => 'js',
                    'js' => ['jquery.maskedinput.js'],
                    'depends' => ['jquery'],
                ],
            ],
            // 'coreScriptPosition' => CClientScript::POS_END
        ]
    ]
]);