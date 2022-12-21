<?php

class m280000_000001_change_size_meta_description_column extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->alterColumn('{{store_product}}', 'meta_description', 'varchar(500)');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_product}}', 'meta_description');
	}
}