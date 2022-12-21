<?php
/**
 * City install migration
 * Класс миграций для модуля City:
 *
 * @category YupeMigration
 * @package  yupe.modules.city.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m000000_000000_city_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{city_category}}',
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
                'meta_keywords'     => 'text COMMENT "Ключевые слова SEO"',
                'meta_description'  => 'text COMMENT "Описание SEO"',
                'status'            => 'integer COMMENT "Статус"',
                'position'          => 'integer COMMENT "Сортировка"',
            ],
            $this->getOptions()
        );

        $this->createTable(
            '{{city}}',
            [
                'id'                => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_user_id'    => "integer NOT NULL",
                'update_user_id'    => "integer NOT NULL",
                'create_time'       => 'datetime NOT NULL',
                'update_time'       => 'datetime NOT NULL',
                'category_id'       => 'integer COMMENT "Категория"',
                'name_short'        => 'string COMMENT "Короткое название"',
                'name'              => 'string COMMENT "Название"',
                'phone'             => 'text COMMENT "Телефон"',
                'email'             => 'string COMMENT "E-mail"',
                'mode'              => 'string COMMENT "График работы"',
                'address'           => 'text COMMENT "Адрес"',
                'code_map'          => 'text COMMENT "Код карты"',
                'coords'            => 'string COMMENT "Координаты на карте"',
                'description'       => 'text COMMENT "Описание"',
                'status'            => 'integer COMMENT "Статус"',
                'meta_title'        => 'string COMMENT "Title (SEO)"',
                'meta_keywords'     => 'text COMMENT "Ключевые слова SEO"',
                'meta_description'  => 'text COMMENT "Описание SEO"',
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
        $this->dropTableWithForeignKeys('{{city_category}}');
        $this->dropTableWithForeignKeys('{{city}}');
    }
}
