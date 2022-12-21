<?php

/**
 * Stocks install migration
 * Класс миграций для модуля Stocks
 *
 * @category YupeMigration
 * @package  yupe.modules.stocks.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m000000_000000_stocks_base extends yupe\components\DbMigration
{

    public function safeUp()
    {
        $this->createTable(
            '{{stocks}}',
            [
                'id'            => 'pk',
                'lang'          => 'char(2) DEFAULT NULL',
                'creation_date' => 'datetime NOT NULL',
                'change_date'   => 'datetime NOT NULL',
                'date'          => 'date NOT NULL',
                'title'         => 'varchar(250) NOT NULL',
                'slug'         => 'varchar(150) NOT NULL',
                'short_text'    => 'text',
                'full_text'     => 'text NOT NULL',
                'image'         => 'varchar(300) DEFAULT NULL',
                'status'        => "integer NOT NULL DEFAULT '0'",
                'description'   => 'varchar(250) NOT NULL',
            ],
            $this->getOptions()
        );

        $this->createIndex("ux_{{stocks}}_slug_lang", '{{stocks}}', "slug,lang", true);
        $this->createIndex("ix_{{stocks}}_status", '{{stocks}}', "status", false);
        $this->createIndex("ix_{{stocks}}_date", '{{stocks}}', "date", false);
    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{stocks}}');
    }
}
