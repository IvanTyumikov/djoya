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
class m000000_000001_review_add_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{review}}', 'category_id', 'integer COMMENT "Категория"');
    }

    public function safeDown()
    {
        $this->dropColumn('{{review}}', 'category_id');
    }
}
