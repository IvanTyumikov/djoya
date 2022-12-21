<?php

class m201001_053646_add_sub_delivery_id extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_order}}', 'sub_delivery_id', 'integer');
        $this->addColumn('{{store_order}}', 'number_track', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_order}}', 'sub_delivery_id');
        $this->dropColumn('{{store_order}}', 'number_track');
    }
}
