<?php
/**
 * Quest install migration
 * Класс миграций для модуля Quest:
 *
 * @category YupeMigration
 * @package  yupe.modules.quest.install.migrations
 * @author   Nikkable
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://vk.com/nikkable
 **/
class m000001_000000_quest_category_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{quest_category}}',
            [
                'id'       => 'pk',
                'name'     => 'string COMMENT "Название"',
                'status'   => 'integer DEFAULT "0" COMMENT "Статус"',
                'position' => 'integer COMMENT "Сортировка"'
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
        $this->dropTableWithForeignKeys('{{quest_category}}');
    }
}
