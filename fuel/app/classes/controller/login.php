<?php
 use \Firebase\JWT\JWT;
 class Controller_Login extends Controller_Rest
{

  public function post_log(){

        //$data = apache_request_headers();
  		$key ="siegrefed";
        $usr = Input::post('username');
        $pss = Input::post('password');
        $users = Model_Users::find('all', array('where' => array(array('username',$usr),)));

        if(! empty($users)){
        	$token = array($usr, $pss);
        	$jwt = JWT::encode($token, $key);
            //$this->verify();
        	
        }else return $this->response(array('El Usuario no existe'));

    	$decoded = JWT::decode($jwt, $key, array('HS256'));

        $token = (array)$decoded;
        $user = Model_Users::find('all');


    	if ($user["password"] == $token["password"]){



                return $this->response(array ($user["username"],$user["password"]));
            }else {

                return print('contraseña incorrecta');
            }


    }
   
}