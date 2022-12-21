<?php

class m210220_073333_add_delivery_column_to_store_order_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_order}}', 'delivery_data', 'text');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_order}}', 'delivery_data');
	}
}