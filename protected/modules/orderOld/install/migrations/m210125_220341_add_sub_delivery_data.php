<?php

class m210125_220341_add_sub_delivery_data extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_order}}', 'sub_delivery_data', 'text');
        $this->addColumn('{{store_order}}', 'delivery_pvz_data', 'text');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_order}}', 'sub_delivery_data');
        $this->dropColumn('{{store_order}}', 'delivery_pvz_data');
	}
}