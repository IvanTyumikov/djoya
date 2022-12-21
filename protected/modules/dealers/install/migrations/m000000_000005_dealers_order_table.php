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
class m000000_000005_dealers_order_table extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{dealers_order}}',
            [
                'id'             => 'pk',
                //для удобства добавлены некоторые базовые поля, которые могут пригодиться.
                'create_time'       => 'datetime NOT NULL',
                'update_time'       => 'datetime NOT NULL',
                'company'           => 'string COMMENT "Компания"',
                'city'              => 'string COMMENT "Город"',
                'name'              => 'text COMMENT "Контактное лицо"',
                'email'             => 'string COMMENT "E-mail"',
                'phone'             => 'string COMMENT "Телефон"',
                'site'              => 'string COMMENT "Сайт"',
                'platform'          => 'string COMMENT "Координаты"',
                'image'             => 'string COMMENT "Изображение"',
                'comment'           => 'text COMMENT "Комментарий"',
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
        $this->dropTableWithForeignKeys('{{dealers_order}}');
    }
}
