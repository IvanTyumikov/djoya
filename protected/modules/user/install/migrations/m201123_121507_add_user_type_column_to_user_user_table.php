<?php

class m201123_121507_add_user_type_column_to_user_user_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{user_user}}', 'type', 'integer DEFAULT "0"');
        $this->addColumn('{{user_user}}', 'inn', 'string');
        $this->addColumn('{{user_user}}', 'company', 'string');
        $this->addColumn('{{user_user}}', 'ogrn', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{user_user}}', 'type');
        $this->dropColumn('{{user_user}}', 'inn');
        $this->dropColumn('{{user_user}}', 'company');
        $this->dropColumn('{{user_user}}', 'ogrn');
    }
}
