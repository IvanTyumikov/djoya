<?php

class m250000_000000_add_column_image_variant_color_id extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_product_image}}', 'option_color_id', 'int(11) null');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_product_image}}', 'option_color_id');
	}
}