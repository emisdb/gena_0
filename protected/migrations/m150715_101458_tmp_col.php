<?php

class m150715_101458_tmp_col extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tmp_xml','user','int(11)');
            $this->addColumn('tmp_docd','user','int(11)');
            $this->addColumn('tmp_doc','user','int(11)');
  	}

	public function down()
	{
		echo "m150715_101458_tmp_col does not support migration down.\n";
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