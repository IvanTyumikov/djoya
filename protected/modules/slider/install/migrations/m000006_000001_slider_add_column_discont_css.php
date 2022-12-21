<?php
class m000006_000001_slider_add_column_discont_css extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{slider}}', 'discont_css', 'text');
    }

    public function safeDown()
    {
        $this->addColumn('{{slider}}', 'discont_css');
    }
}
