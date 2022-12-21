<?php

class m280000_000002_change_store_category_size_meta_description_column extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->alterColumn('{{store_category}}', 'meta_description', 'varchar(500)');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_category}}', 'meta_description');
	}
}