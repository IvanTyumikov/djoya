<?php

class m170415_055344_add_fields_orderId extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_order}}', 'orderId', 'varchar(150) null');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_order}}', 'orderId');
	}
}