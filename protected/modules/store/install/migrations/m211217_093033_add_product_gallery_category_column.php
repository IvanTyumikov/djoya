<?php

class m211217_093033_add_product_gallery_category_column extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{store_product}}', 'gallery_category', 'integer null');
	}

	public function safeDown()
	{
		$this->dropColumn('{{store_product}}', 'gallery_category');
	}
}