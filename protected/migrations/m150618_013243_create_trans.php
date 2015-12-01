<?php

class m150618_013243_create_trans extends CDbMigration
{
	public function up()
	{
            $this->addColumn('exp','transport','int(11)');
            $this->addColumn('tmp_doc','transport','varchar(15)');
            $this->addColumn('tmp_doc','man','varchar(15)');
            $this->addForeignKey('exp_transport', 'exp', 'transport', 'client', 'id','SET NULL','CASCADE');
	}

	public function down()
	{
            $this->dropColumn('exp','transport');
                echo "drop exp.transport.\n";
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