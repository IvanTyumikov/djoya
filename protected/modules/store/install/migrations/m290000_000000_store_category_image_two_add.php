<?php

class m290000_000000_store_category_image_two_add extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'image_two', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'image_two');
    }
}