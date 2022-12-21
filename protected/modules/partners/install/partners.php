<?php
/**
 * Файл настроек для модуля partners
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2019 amyLabs && Yupe! team
 * @package yupe.modules.partners.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.partners.PartnersModule',
    ],
    'import'    => [],
    'component' => [],
    'rules'     => [
        '/partners' => 'partners/partners/index',
    ],
];