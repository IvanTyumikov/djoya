<?php

class m200715_154203_add_address_columnt_to_user_user_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{user_user}}', 'zipcode', 'string');
        $this->addColumn('{{user_user}}', 'region', 'string');
        $this->addColumn('{{user_user}}', 'city', 'string');
        $this->addColumn('{{user_user}}', 'street', 'string');
        $this->addColumn('{{user_user}}', 'building', 'string');
        $this->addColumn('{{user_user}}', 'apartment', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{user_user}}', 'zipcode', 'string');
        $this->dropColumn('{{user_user}}', 'region', 'string');
        $this->dropColumn('{{user_user}}', 'city', 'string');
        $this->dropColumn('{{user_user}}', 'street', 'string');
        $this->dropColumn('{{user_user}}', 'building', 'string');
        $this->dropColumn('{{user_user}}', 'apartment', 'string');
    }
}
