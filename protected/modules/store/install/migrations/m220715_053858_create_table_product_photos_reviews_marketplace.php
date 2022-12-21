<?php

class m220715_053858_create_table_product_photos_reviews_marketplace extends yupe\components\DbMigration
{
	public function safeUp()
	{
		$this->createTable(
			"{{store_product_photos_reviews_marketplace}}",
			[
				"id" => "pk",
				"product_id" => "integer not null",
				"name" => "varchar(250) DEFAULT NULL",
				"title" => "varchar(250) DEFAULT NULL",
				"alt" => "varchar(250) DEFAULT NULL",
				'path' => 'string DEFAULT NULL',
			]
		);
	}

	public function safeDown()
	{
		$this->dropTable("{{store_product_photos_reviews_marketplace}}");
	}
}