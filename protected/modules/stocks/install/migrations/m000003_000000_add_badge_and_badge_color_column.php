<?php

class m000003_000000_add_badge_and_badge_color_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{stocks}}', 'badge', 'string');
        $this->addColumn('{{stocks}}', 'badge_color', 'string');
    }
    public function safeDown()
    {
       $this->dropColumn('{{stocks}}', 'badge', 'string');
       $this->dropColumn('{{stocks}}', 'badge_color', 'string');
    }
}
