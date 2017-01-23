<?php
namespace Fuel\Migrations;

class Enemigos
{

    function up()
    {
        \DBUtil::create_table('enemigos', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'name' => array('type' => 'varchar', 'constraint' => 255),
            'descripcion' => array('type' => 'varchar', 'constraint' => 255),
            'imagen' => array('type' => 'varchar', 'constraint' => 255),
            'vida' => array('type' => 'int', 'constraint' => 11),
            'ataque' => array('type' => 'int', 'constraint' => 11),
            
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('enemigos');
    }
}