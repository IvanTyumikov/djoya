<?php
/**
 * Directions install migration
 * Класс миграций для модуля Directions:
 *
 **/
class m220421_143330_directions_add_column_data extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->addColumn('{{page_page}}', 'data', 'longtext');
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropColumn('{{page_page}}', 'data');
    }
}
