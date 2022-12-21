<?php

class m181218_121816_store_category_name_short_icon extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_category}}', 'name_short', 'string');
        $this->addColumn('{{store_category}}', 'icon', 'string');
        $this->addColumn('{{store_category}}', 'is_home', "boolean not null default '0'");
        $this->addColumn('{{store_category}}', 'name_desc', 'text');
        $this->addColumn('{{store_product}}', 'is_home', "boolean not null default '0'");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_category}}', 'name_short');
        $this->dropColumn('{{store_category}}', 'icon');
        $this->dropColumn('{{store_category}}', 'is_home');
        $this->dropColumn('{{store_category}}', 'name_desc');
        $this->dropColumn('{{store_product}}', 'is_home');
    }
}