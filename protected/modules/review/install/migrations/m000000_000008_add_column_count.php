<?php

/**
 * Comment install migration
 * Класс миграций для модуля Comment:
 *
 * @category YupeMigration
 * @package  yupe.modules.comment.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m000000_000008_add_column_count extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{review}}', 'countImage', 'integer DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{review}}', 'countImage');
    }
}
