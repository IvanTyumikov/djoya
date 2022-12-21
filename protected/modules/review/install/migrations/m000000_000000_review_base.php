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
class m000000_000000_review_base extends yupe\components\DbMigration
{

    public function safeUp()
    {
        $this->createTable(
            '{{review}}',
            array(
                'id'            => 'pk',
                'user_id'       => 'integer DEFAULT NULL',
                'date_created'  => 'datetime NOT NULL',
                'text'          => 'text NOT NULL',
            	'moderation'       => 'integer DEFAULT NULL',
            	'username'       => 'varchar(256) DEFAULT NULL',
                'image'       => 'varchar(256) DEFAULT NULL',
            	'useremail'       => 'varchar(256) DEFAULT NULL',
            ),
            $this->getOptions()
        );


    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{review}}');
    }
}
