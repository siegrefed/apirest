<?php
namespace Fuel\Migrations;

class Consumibles
{

    function up()
    {
        \DBUtil::create_table('consumibles', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'cantidad' => array('type' => 'int', 'constraint' => 11),
            
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('consumibles');
    }
}