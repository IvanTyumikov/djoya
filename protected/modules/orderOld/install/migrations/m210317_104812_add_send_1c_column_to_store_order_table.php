<?php

class m210317_104812_add_send_1c_column_to_store_order_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_order}}', 'send_1c', 'integer DEFAULT "0"');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_order}}', 'send_1c');
	}
}