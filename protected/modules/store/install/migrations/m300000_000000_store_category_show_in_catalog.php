<?php

class m300000_000000_store_category_show_in_catalog extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'show_in_catalog', 'integer DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'show_in_catalog');
    }
}