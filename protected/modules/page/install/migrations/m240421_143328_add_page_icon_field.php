<?php

class m240421_143328_add_page_icon_field extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{page_page}}', 'icon', 'varchar(250)');
    }

    public function safeDown()
    {
        $this->dropColumn('{{page_page}}', 'icon');
    }
}