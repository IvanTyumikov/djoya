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
class m000000_000001_dealers_add_cloumn extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->addColumn('{{dealers}}', 'slug', 'string');
        $this->addColumn('{{dealers_city}}', 'slug', 'string');
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropColumn('{{dealers}}', 'slug');
        $this->dropColumn('{{dealers_city}}', 'slug');
    }
}
