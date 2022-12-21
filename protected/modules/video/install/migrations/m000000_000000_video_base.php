<?php
/**
 * Video install migration
 * Класс миграций для модуля Video:
 *
 * @category YupeMigration
 * @package  yupe.modules.video.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m000000_000000_video_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{video}}',
            [
                'id'       => 'pk',
                'name'     => 'string COMMENT "Название"',
                'code'     => 'text NOT NULL COMMENT "Код видео"',
                'image'    => 'string COMMENT "Изображение(миниатюра)"',
                'status'   => 'integer DEFAULT "0" COMMENT "Статус"',
                'position' => 'integer COMMENT "Сортировка"'
            ],
            $this->getOptions()
        );

    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{video}}');
    }
}
