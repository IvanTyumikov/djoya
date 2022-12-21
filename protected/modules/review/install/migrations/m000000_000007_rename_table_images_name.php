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
class m000000_000007_rename_table_images_name extends yupe\components\DbMigration
{

    public function safeUp()
    {
        $this->renameColumn('{{review_image}}', 'name', 'image');

    }

    public function safeDown()
    {
        $this->renameColumn('{{review_image}}', 'image', 'name');
    }
}
