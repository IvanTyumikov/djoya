<?php

class m200802_185033_create_pickup_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable('{{pickup_pickup}}', [
            'id'          => 'pk',
            'name'        => 'string',
            'address'     => 'string',
            'description' => 'text',
            'mode'        => 'string',
            'phone'       => 'string',
            'email'       => 'string',
            'latitude'    => 'string',
            'longitude'   => 'string',
            'status'      => 'integer',
        ], $this->getOptions());
    }

    public function safeDown()
    {
        $this->dropTable('{{pickup_pickup}}');
    }
}
