<?php
/**
 * Dealers install migration
 * Класс миграций для модуля Dealers:
 *
 * @category YupeMigration
 * @package  yupe.modules.dealers.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m000000_000000_dealers_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{dealers}}',
            [
                'id'             => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_user_id'    => "integer NOT NULL",
                'update_user_id'    => "integer NOT NULL",
                'create_time'       => 'datetime NOT NULL',
                'update_time'       => 'datetime NOT NULL',
                'name_short'        => 'string COMMENT "Короткое Название"',
                'name'              => 'string COMMENT "Название"',
                'phone'             => 'string COMMENT "Телефоны"',
                'location'          => 'text COMMENT "Адрес"',
                'mode'              => 'string COMMENT "График работы"',
                'coords'            => 'string COMMENT "Координаты"',
                'image'             => 'string COMMENT "Изображение"',
                'description'       => 'text COMMENT "Описание"',
                'meta_title'        => 'string COMMENT "Title (SEO)"',
                'meta_keywords'     => 'string COMMENT "Ключевые слова SEO"',
                'meta_description'  => 'string COMMENT "Описание SEO"',
                'status'            => 'integer COMMENT "Статус"',
                'position'          => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );
        
        $this->createTable(
            '{{dealers_city}}',
            [
                'id'             => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_user_id'    => "integer NOT NULL",
                'update_user_id'    => "integer NOT NULL",
                'create_time'       => 'datetime NOT NULL',
                'update_time'       => 'datetime NOT NULL',
                'name_short'        => 'string COMMENT "Короткое Название"',
                'name'              => 'string COMMENT "Название"',
                'image'             => 'string COMMENT "Изображение"',
                'description'       => 'text COMMENT "Описание"',
                'meta_title'        => 'string COMMENT "Title (SEO)"',
                'meta_keywords'     => 'string COMMENT "Ключевые слова SEO"',
                'meta_description'  => 'string COMMENT "Описание SEO"',
                'status'            => 'integer COMMENT "Статус"',
                'position'          => 'integer COMMENT "Сортировка"',
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
        $this->dropTableWithForeignKeys('{{dealers}}');
    }
}
