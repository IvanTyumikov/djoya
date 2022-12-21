<?php

class m200307_080044_add_column_is_default extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{city}}', 'is_default', 'int(1) DEFAULT 0');
    }

    public function safeDown()
    {
        $this->dropColumn('{{city}}', 'is_default');
    }
}