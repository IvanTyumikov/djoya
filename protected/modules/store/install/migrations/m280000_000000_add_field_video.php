<?php

class m280000_000000_add_field_video extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_product}}', 'video', 'string DEFAULT NULL');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_product}}', 'video');
	}
}