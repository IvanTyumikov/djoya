<?php

class m221003_065855_add_gift_message_column_to_order_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{store_order}}', 'gift_message', 'text null');
	}

	public function safeDown()
	{
		$this->addColumn('{{store_order}}', 'gift_message', 'text null');
	}
}
