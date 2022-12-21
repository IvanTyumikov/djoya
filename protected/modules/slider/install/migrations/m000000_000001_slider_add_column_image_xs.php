<?php

/**
 *
 **/
class m000000_000001_slider_add_column_image_xs extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{slider}}', 'image_xs', 'string COMMENT "Изображение"');
    }

    public function safeDown()
    {
        $this->dropColumn('{{slider}}', 'image_xs');
    }
}
