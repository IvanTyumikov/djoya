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
class m000000_000001_video_add_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{video}}', 'category_id', 'integer COMMENT "Категория"');
    }

    public function safeDown()
    {
        $this->dropColumn('{{video}}', 'category_id');
    }
}
