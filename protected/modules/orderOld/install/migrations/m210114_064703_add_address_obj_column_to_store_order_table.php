<?php

class m210114_064703_add_address_obj_column_to_store_order_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_order}}', 'address_obj', 'text');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_order}}', 'address_obj');
	}
}