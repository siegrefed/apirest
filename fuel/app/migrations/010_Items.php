<?php
namespace Fuel\Migrations;

class Items
{

    function up()
    {
        \DBUtil::create_table('items', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'name' => array('type' => 'varchar', 'constraint' => 255),
            'descripcion' => array('type' => 'varchar', 'constraint' => 255),
            'imagen' => array('type' => 'varchar', 'constraint' => 255),
            'precio' => array('type' => 'int', 'constraint' => 11),
            'fk_consumibles' => array('type' => 'int', 'constraint' => 11),
            'fk_desbloqueables' =>array('type' => 'int', 'constraint' => 11),
            
            
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('items');
    }
}