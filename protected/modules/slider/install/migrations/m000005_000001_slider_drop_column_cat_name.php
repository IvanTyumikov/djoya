<?php

/**
 *
 **/
class m000005_000001_slider_drop_column_cat_name extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->dropColumn('{{slider}}', 'cat_id');
    }
}
