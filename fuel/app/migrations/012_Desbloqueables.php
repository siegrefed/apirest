<?php
namespace Fuel\Migrations;

class Desbloqueables
{

    function up()
    {
        \DBUtil::create_table('desbloqueables', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),

            
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('desbloqueables');
    }
}