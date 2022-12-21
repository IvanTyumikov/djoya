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
class m000000_000005_review_rename_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
    	$this->renameColumn('{{review}}', 'name_service', 'product_id');
    	$this->alterColumn('{{review}}', 'product_id', 'integer default null');
    }

    public function safeDown()
    {
        $this->renameColumn('{{review}}', 'product_id', 'name_service');
    }
}
