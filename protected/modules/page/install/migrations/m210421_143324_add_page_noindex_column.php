<?php

class m210421_143324_add_page_noindex_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{page_page}}', 'noindex', "boolean NOT NULL DEFAULT '0'");
    }
    public function safeDown()
    {
       $this->addColumn('{{page_page}}', 'noindex', 'string');
    }
}