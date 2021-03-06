<?php

use \Firebase\JWT\JWT;

class Controller_User extends Controller_Rest
{

	public function post_login()
	{
		$usr = Input::post('username');
		$pss = Input::post('password');
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
			$jwt = JWT::encode($token, $this->key);

			return[
				'code' => 200,
				'token' => $jwt
			];
		}
	}

	public function get_users()
	{
		$user = Model_Users::find('all');
		return $user;
	}

	public function post_user()
	{
		$idUser = Input::post('id');
		$user = Model_Users::find ('all', array(
			'where' => array(
				array('id', $idUser),
				)
			));

		

		return $user;

	}

	public function post_moduser()
	{
		$user = new Model_Users();
		$idUser = Input::post('id');
		$username = Input::post('username');
		$password = Input::post('password');
		$email = Input::post('email');



		$user = Model_Users::find ('all');

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

	public function post_deluser()
	{
		$user = new Model_Users();
		$idUser = Input::post('id');
		$user = Model_Users::find('all', array(
			'where' => array(
				array('id', $idUser),
				)
			));
		

			foreach ($user as $key){
				
					var_dump($key['id']);
					$key -> delete();
					return print('ususafijbsdfaijf');
				

			}


		
		

		

	}

	public function post_reguser()
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

    
        
	
}