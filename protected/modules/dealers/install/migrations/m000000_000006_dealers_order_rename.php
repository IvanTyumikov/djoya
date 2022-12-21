<?php
/**
 * Dealers install migration
 * Класс миграций для модуля Dealers:
 *
 * @category YupeMigration
 * @package  yupe.modules.dealers.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m000000_000006_dealers_order_rename extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->alterColumn('{{dealers_order}}', 'platform', "text");
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
    }
}
