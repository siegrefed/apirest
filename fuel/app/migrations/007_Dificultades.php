<?php
namespace Fuel\Migrations;

class Dificultades
{

    function up()
    {
        \DBUtil::create_table('dificultades', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'name' => array('type' => 'varchar', 'constraint' => 255),
            'descripcion' => array('type' => 'varchar', 'constraint' => 255),
            'imagen' => array('type' => 'varchar', 'constraint' => 255),
            
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('dificultades');
    }
}