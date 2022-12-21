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
class m000000_000001_quest_add_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{quest}}', 'category_id', 'integer COMMENT "ID категории"');
    }

    public function safeDown()
    {
        $this->dropColumn('{{quest}}', 'category_id');
    }
}
