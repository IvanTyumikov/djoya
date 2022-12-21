<?php
class m000003_000001_slider_add_column_discont extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{slider}}', 'discont', 'text');
    }

    public function safeDown()
    {
        $this->addColumn('{{slider}}', 'discont');
    }
}
