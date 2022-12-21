<?php

class m271205_150639_add_field_option_id_variant extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{store_product_variant}}', 'option_id', 'int(11) null');
	}

	public function safeDown()
	{
        $this->dropColumn('{{store_product_variant}}', 'option_id');
	}
}