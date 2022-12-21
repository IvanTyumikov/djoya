<?php

class m200422_143325_add_meta_robots_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{page_page}}', 'meta_robots', 'varchar(250)');
    }

    public function safeDown()
    {
        $this->dropColumn('{{page_page}}', 'meta_robots');
    }
}