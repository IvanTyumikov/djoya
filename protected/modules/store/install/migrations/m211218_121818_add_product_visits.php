<?php

class m211218_121818_add_product_visits extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{store_product}}', 'visits', 'int(12) DEFAULT "0"');
	}

	public function safeDown()
	{
		$this->dropColumn('{{store_product}}', 'visits');
	}
}