<?php 

class Model_Users extends Orm\Model {

protected static $_table_name = 'users';
protected static $_primary_key = array('id');

protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'username' => array(
            'data_type' => 'varchar',
            //'label' => 'user',
            'validation' => array('required')
           // 'form' => array('type' => 'text'),
            //'default' => 'New article',
        ),
        
        'password' => array(
            'data_type' => 'varchar',
            //'label' => 'password',
            'validation' => array('required')
            //'form' => array('type' => 'text'
                
             //'type' => false, // this prevents this field from being rendered on a form
            //),
        ),
        'email' => array(
                'data_type' => 'varchar'
            ),
        'imagen' => array(
                'data_type' => 'varchar'
            ),
        // 'fk_admin' => array(
        //         'data_type' => 'int'
        //     ),
        // 'fk_player' => array(
        //         'data_type' => 'int'
        //     ),
        
    );



}