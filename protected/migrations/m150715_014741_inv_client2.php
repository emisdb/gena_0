<?php

class m150715_014741_inv_client2 extends CDbMigration
{
	public function up()
	{
             $this->addColumn('inv','client_id','int(11)');
             $this->addForeignKey('inv_client', 'inv', 'client_id', 'client', 'id','SET NULL','CASCADE');
	}

	public function down()
	{
            $this->dropColumn('inv','client_id');
                echo "drop inv_client.\n";
		return true;
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