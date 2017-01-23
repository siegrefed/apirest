<?php
namespace Fuel\Migrations;

class Logros
{

    function up()
    {
        \DBUtil::create_table('logros', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'name' => array('type' => 'varchar', 'constraint' => 255),
            'descripcion' => array('type' => 'varchar', 'constraint' => 255),
            'imagen' => array('type' => 'varchar', 'constraint' => 255),
            'recompensa' => array('type' => 'int', 'constraint' => 11),
            'fk_player' => array('type' => 'int', 'constraint' => 11),
            
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('logros');
    }
}