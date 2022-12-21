<?php 
class m000000_000003_city_add_column_soc extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{city}}', 'vk', 'string');
        $this->addColumn('{{city}}', 'instagram', 'string');
        $this->addColumn('{{city}}', 'facebook', 'string');
        $this->addColumn('{{city}}', 'ok', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{city}}', 'vk');
        $this->dropColumn('{{city}}', 'instagram');
        $this->dropColumn('{{city}}', 'facebook');
        $this->dropColumn('{{city}}', 'ok');
    }
}

?>