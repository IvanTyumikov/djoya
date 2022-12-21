<?php

class m190421_143324_add_page_text_mirror_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{page_page}}', 'text_mirror', 'text');
    }
}
