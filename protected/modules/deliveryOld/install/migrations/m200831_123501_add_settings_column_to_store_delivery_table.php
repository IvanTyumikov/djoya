<?php

class m200831_123501_add_settings_column_to_store_delivery_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_delivery}}', 'settings', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_delivery}}', 'settings');
    }
}
