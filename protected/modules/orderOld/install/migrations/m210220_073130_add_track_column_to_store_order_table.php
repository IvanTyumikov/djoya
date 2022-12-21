<?php

class m210220_073130_add_track_column_to_store_order_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_order}}', 'track', 'string');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_order}}', 'track');
	}
}