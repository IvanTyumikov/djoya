<?php

class m220304_063343_add_is_delivery_column_to_store_product_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{store_product}}', 'is_delivery', 'boolean');
	}

	public function safeDown()
	{
		$this->dropColumn('{{store_product}}', 'is_delivery');
	}
}