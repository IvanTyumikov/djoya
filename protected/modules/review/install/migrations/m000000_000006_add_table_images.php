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
class m000000_000006_add_table_images extends yupe\components\DbMigration
{

    public function safeUp()
    {
        $this->createTable(
            '{{review_image}}',
            array(
                'id'         => 'pk',
                'review_id'  => 'integer DEFAULT NULL COMMENT "Id отзыва"',
                'name'       => 'string COMMENT "Изображение"',
                'title'      => 'string COMMENT "Title"',
            	'alt'        => 'string COMMENT "Alt"',
            	'position'   => 'integer COMMENT "Сортировка"',
            ),
            $this->getOptions()
        );

        $this->addForeignKey(
            "fk_{{review_image}}_review_id",
            '{{review_image}}',
            'review_id',
            '{{review}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{review}}');
    }
}
