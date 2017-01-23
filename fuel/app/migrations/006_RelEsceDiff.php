<?php
namespace Fuel\Migrations;

class RelEsceDiff
{
	function up()
	{
		\DBUtil::create_table('rel_escenario_dificultad',array(
			'fk_escenario' => array('type' => 'int', 'constraint' => 11),
			'fk_dificultad' => array('type' => 'int', 'constraint' => 11),

			), array('fk_escenario','fk_dificultad'));
	}
	function down(){
		\DBUtil::drop_table('rel_escenario_dificultad');
	}

}