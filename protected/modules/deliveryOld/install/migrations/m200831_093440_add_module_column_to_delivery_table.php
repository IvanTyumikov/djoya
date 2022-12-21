<?php

class m200831_093440_add_module_column_to_delivery_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_delivery}}', 'module', 'varchar(100)');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_delivery}}', 'module');
    }
}
