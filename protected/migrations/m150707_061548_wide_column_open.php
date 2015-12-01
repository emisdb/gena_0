<?php

class m150707_061548_wide_column_open extends CDbMigration
{
	public function up()
	{
            $this->alterColumn('client_prop','_value','varchar(128)');
	}

	public function down()
	{
		echo "m150707_061548_wide_column_open does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}