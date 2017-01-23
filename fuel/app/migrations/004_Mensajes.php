<?php
namespace Fuel\Migrations;

class Mensajes
{

    function up()
    {
        \DBUtil::create_table('mensajes', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'descripcion' => array('type' => 'varchar', 'constraint' => 700),
            'fecha' => array('type' => 'date'),
            'fk_user' => array('type' => 'int', 'constraint' => 11),
            
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('mensajes');
    }
}