<?php
namespace Fuel\Migrations;

class Escenario
{
	function up()
	{
		\DBUtil::create_table('escenario',array(
			'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
			'escenario' => array('type' => 'varchar', 'constraint' => 255),

			), array('id'));
	}
	function down(){
		\DBUtil::drop_table('escenario');
	}

}