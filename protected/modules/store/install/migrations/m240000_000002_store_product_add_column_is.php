<?php

class m240000_000002_store_product_add_column_is extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'is_new', "boolean not null default '0'");
        $this->addColumn('{{store_product}}', 'is_hit', "boolean not null default '0'");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'is_new');
        $this->dropColumn('{{store_product}}', 'is_hit');
    }
}