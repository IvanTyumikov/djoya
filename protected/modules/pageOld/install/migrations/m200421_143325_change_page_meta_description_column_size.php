<?php

class m200421_143325_change_page_meta_description_column_size extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->alterColumn('{{page_page}}', 'meta_description', 'varchar(500)');
    }
}