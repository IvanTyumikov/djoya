<?php

class m000004_000000_add_bg_stock_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{stocks}}', 'bg_stock', 'string');
    }
    public function safeDown()
    {
       $this->dropColumn('{{stocks}}', 'bg_stock', 'string');
    }
}
