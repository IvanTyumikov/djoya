<?php

class m181218_121818_create_table_tabs extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable(
            "{{store_product_tabs}}",
            [
                "id" => "pk",
                "product_id" => "integer not null",
                "title" => "varchar(250) not null",
                "body" => "text",
            ],
            $this->getOptions()
        );

        //fk
        $this->addForeignKey("fk_{{store_product_tabs}}_product", "{{store_product_tabs}}", "product_id", "{{store_product}}", "id", "CASCADE", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropTable("{{store_product_tabs}}");
    }
}