<?php 

class m000000_000004_city_add_image extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{city}}', 'image', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{city}}', 'image');
    }
} ?>