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
class m000000_000002_dealers_add_cloumn_city_id extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->addColumn('{{dealers}}', 'city_id', 'integer');
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropColumn('{{dealers}}', 'slug');
    }
}
