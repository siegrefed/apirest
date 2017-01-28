<?php

use \Firebase\JWT\JWT;

class Controller_User extends Controller_Rest
{

	public function post_login()
	{
		$usr = Input::post('username');
		$pss = Input::post('password');
		$key = 'siegrefed';

		

		$user = Model_Users::find('all', array(
			'where' => array(
					array('username', $usr),
				)
			));

		if ( ! empty($user) )
		{
			foreach ($user as $key => $value)
			{
				$id = $user[$key]->id;
				$username = $user[$key]->username;
				$password = $user[$key]->password;
			}
		}
		else
		{
			return print('Error de autentificacion');
		}

		if ($username == $usr and $password == $pss)
		{
			$token = array(
					"id" => $id, 
					"username" => $username, 
					"password" => $password
				);
			$jwt = JWT::encode($token, $key);
			

			return[
				'code' => 200,
				'token' => $jwt
			];
		}
	}

	public function get_users()
	{
		var_dump(verificar());
		if(verificar()){

		$user = Model_Users::find('all');
		return $user;}
		else print('error');
	}

	public function get_user($id)
	{
		// $idUser = Input::post('id');

		$user = Model_Users::find ('all', array(
			'where' => array(
				array('id', $id),
				)
			));

		return $user;

	}

	public function post_update($id)
	{
		$user = new Model_Users();
		$user = Model_Users::find($id);

		// $idUser = Input::post('id');
		$username = Input::post('username');
		$password = Input::post('password');
		$email = Input::post('email');



		
		if (! empty($user))
		{
			foreach ($user as $key) {
				if ($key['id'] == $idUser){
				$key->username = $username;
				$key->password = $password;
				$key->email = $email;
				$key->save();
				
			}
				var_dump($key);
			}

			return print('user modificado');
			
		}
		else
		{
			return print('Error');
		}

	}

	public function post_delete($id)
	{
		$user = new Model_Users();
		// $idUser = Input::post('id');
		$user = Model_Users::find('all', array(
			'where' => array(
				array('id', $id),
				)
			));
		

			foreach ($user as $key){
				
					var_dump($key['id']);
					$key -> delete();
					return print('ususafijbsdfaijf');
				

			}


		
		

		

	}

	public function post_create()
	{
		$user = new Model_Users();

		$username = Input::post('username');
		$password = Input::post('password');
		$email = Input::post('email');
		$imagen = Input::post('imagen');

        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->imagen = $imagen;



        	if (empty($username) or empty($password) or empty($email))
        	{
        		return $this->response(array('faltan campos'));
        		 
        	}
        	else 
        	{
        		// try
        		// {
        		// 	$user->save();
        		// 	return $this->response(array('Ususario Creado'));
        		// }
        		// catch(exception $e)
        		// {
        		// 	print('Email ya registrado');
        		// }
        		$bbdd = Model_Users::find('all', array(
        			'where' => array(
        				array('email', $email),
        				)
        			));
        		if (! empty($bbdd))
        		{
        			return $this->response(array('Email ya registrado'));
        		}
        		else
        		{
        			$user->save();
        		return $this->response(array('Ususario Creado'));
        		}


        		
        	}

        	

    }

    private function verificar(){
    	  $auth = apache_request_headers();
        $jwt = $auth["auth"];
        $key = "siegrefed";

        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $token = (array)$decoded;

        if (! empty($auth)){

	       $entry = Model_Users::find('all', array(
	            'where' => array(
	                array('username', $token["username"]),
	                
	            ),
	        ));
	       if (empty($entry)){
	            print("no existe el usuario");
	            return false;
	       }
	      return true;
	  	}
	  	else{
	  		print("logeate primero");
	  		return false;
	  	}
    }      
	
}