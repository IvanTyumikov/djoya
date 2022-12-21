<?php 
class m000000_000001_city_base extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{city}}', 'slug', 'varchar(250)');
        $this->addColumn('{{city}}', 'parent_id', 'integer');
    }

    public function safeDown()
    {
        $this->dropColumn('{{city}}', 'slug');
        $this->dropColumn('{{city}}', 'parent_id');
    }
}

?>