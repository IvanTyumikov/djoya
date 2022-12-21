<?php

class m250000_000001_add_column_attribute_option_color extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_attribute_option}}', 'color', 'string DEFAULT NULL');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_attribute_option}}', 'color');
	}
}