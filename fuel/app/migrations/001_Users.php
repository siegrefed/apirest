<?php
namespace Fuel\Migrations;

class Users
{

    function up()
    {
        \DBUtil::create_table('users', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'username' => array('type' => 'varchar', 'constraint' => 255),
            'password' => array('type' => 'varchar', 'constraint' => 255),
            'email' => array('type' => 'varchar', 'constraint' => 255),
            'imagen' => array('type' => 'varchar', 'constraint' => 255),
            'fk_admin' => array('type' => 'int', 'constraint' => 11),
            'fk_player' => array('type' => 'int', 'constraint' => 11),
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('users');
    }
}