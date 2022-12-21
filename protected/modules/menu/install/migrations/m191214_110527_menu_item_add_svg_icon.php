<?php

class m191214_110527_menu_item_add_svg_icon extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{menu_menu_item}}', 'svg_icon', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{menu_menu_item}}', 'svg_icon');
    }
}