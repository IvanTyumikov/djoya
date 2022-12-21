<?php

class m201218_121818_add_product_raiting extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{store_product}}', 'raiting', 'integer DEFAULT "0"');
	}

	public function safeDown()
	{
		$this->dropColumn('{{store_product}}', 'raiting');
	}
}