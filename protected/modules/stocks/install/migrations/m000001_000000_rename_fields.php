<?php

class m000001_000000_rename_fields extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->renameColumn('{{stocks}}', 'creation_date', 'create_time');
        $this->renameColumn('{{stocks}}', 'change_date', 'update_time');
	}
}