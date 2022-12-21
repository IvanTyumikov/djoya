<?php
/**
 * Slider install migration
 * Класс миграций для модуля Slider:
 *
 * @category YupeMigration
 * @package  yupe.modules.slider.install.migrations
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class m000000_000000_slider_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{slider}}',
            [
                'id'                => 'pk',
                'name'              => 'string COMMENT "Название"',
                'name_short'        => 'string COMMENT "Короткое Название"',
                'image'             => 'string COMMENT "Изображение"',
                'description'       => 'text COMMENT "Описание"',
                'description_short' => 'text COMMENT "Краткое описание"',
                'button_name'       => 'string COMMENT "Название кнопки"',
                'button_link'       => 'string COMMENT "url для кнопки"',
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
        $this->dropTableWithForeignKeys('{{slider}}');
    }
}
