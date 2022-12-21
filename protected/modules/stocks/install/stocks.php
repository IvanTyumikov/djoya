<?php
/**
 * Файл настроек для модуля stocks
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2019 amyLabs && Yupe! team
 * @package yupe.modules.stocks.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.stocks.StocksModule',
    ],
    'import'    => [
        'application.modules.stocks.models.*',
        'application.modules.stocks.components.*',
        'application.modules.stocks.StocksModule',
    ],
    'component' => [],
    'rules'     => [
        '/stocks/' => 'stocks/stocks/index',
        '/stocks/<slug>' => 'stocks/stocks/view',
    ],
];