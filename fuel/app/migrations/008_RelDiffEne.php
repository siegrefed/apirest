<?php
namespace Fuel\Migrations;

class RelDiffEne
{

    function up()
    {
        \DBUtil::create_table('rel_dificultades_enemigos', array(
            
            'fk_dificultades' => array('type' => 'int', 'constraint' => 11),
            'fk_enemigos' => array('type' => 'int', 'constraint' => 11),
        ), array('fk_enemigos','fk_dificultades'));
    }

    function down()
    {
       \DBUtil::drop_table('rel_dificultades_enemigos');
    }
}