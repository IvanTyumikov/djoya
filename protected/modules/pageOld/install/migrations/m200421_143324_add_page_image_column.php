<?php

class m200421_143324_add_page_image_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{page_page}}', 'image', 'string');
    }
    public function safeDown()
    {
       $this->addColumn('{{page_page}}', 'image', 'string');
    }
}