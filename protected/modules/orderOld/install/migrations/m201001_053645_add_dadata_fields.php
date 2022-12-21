<?php

class m201001_053645_add_dadata_fields extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_order}}', 'region_obj', 'text');
        $this->addColumn('{{store_order}}', 'city_obj', 'text');
        $this->addColumn('{{store_order}}', 'street_obj', 'text');
        $this->addColumn('{{store_order}}', 'house_obj', 'text');
        $this->addColumn('{{store_order}}', 'apartment_obj', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_order}}', 'region_obj');
        $this->dropColumn('{{store_order}}', 'city_obj');
        $this->dropColumn('{{store_order}}', 'street_obj');
        $this->dropColumn('{{store_order}}', 'house_obj');
        $this->dropColumn('{{store_order}}', 'apartment_obj');
    }
}
