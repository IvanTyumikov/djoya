<?php 
class m000000_000002_city_add_column_price_file extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{city}}', 'price_file', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{city}}', 'price_file');
    }
}

?>