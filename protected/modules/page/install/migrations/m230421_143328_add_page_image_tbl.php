<?php

/**
 * m000000_000000_page_base install migration
 * Класс миграций для модуля Page:
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.page.install.migrations
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @since 1.0
 *
 */
class m230421_143328_add_page_image_tbl extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{page_page_image}}',
            [
                'id'       => 'pk',
                'page_id'  => 'integer DEFAULT NULL',
                'image'       => 'string COMMENT "Изображение" not null',
                'title'       => 'string COMMENT "Название изображения" not null',
                'alt'         => 'string COMMENT "Alt изображения" not null',
                'position'    => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys("{{page_page_image}}");
    }
}
