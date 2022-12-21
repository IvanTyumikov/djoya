<?php
/**
 * Partners install migration
 * Класс миграций для модуля Partners:
 *
 * @category YupeMigration
 * @package  yupe.modules.partners.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m000000_000000_partners_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{partners}}',
            [
                'id'             => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_user_id' => "integer NOT NULL",
                'update_user_id' => "integer NOT NULL",
                'create_time'    => 'datetime NOT NULL',
                'update_time'    => 'datetime NOT NULL',
            ],
            $this->getOptions()
        );

        //ix
        $this->createIndex("ix_{{partners}}_create_user", '{{partners}}', "create_user_id", false);
        $this->createIndex("ix_{{partners}}_update_user", '{{partners}}', "update_user_id", false);
        $this->createIndex("ix_{{partners}}_create_time", '{{partners}}', "create_time", false);
        $this->createIndex("ix_{{partners}}_update_time", '{{partners}}', "update_time", false);

    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{partners}}');
    }
}
