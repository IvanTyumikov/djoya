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
class m000001_000000_review_add_column_order extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{review}}', 'order', 'integer DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{review}}', 'order');
    }
}
