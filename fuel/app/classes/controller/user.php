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
			return $this->errorAuth();
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
		$idUser = Input::post('id');
		$user = Model_Users::find ('all', array(
			'where' => array(
				array('id', $idUser),
				)
			));
		if (! empty($user))
		{
			$user->username = Input::post('username');
			$user->password = Input::post('password');
			$user->save();
		}
		else
		{
			return $this->errorAuth();
		}

	}
	public function post_deluser()
	{
		$idUser = Input::post('id');
		$user = Model_Users::find ('all', array(
			'where' => array(
				array('id', $idUser),
				)
			));
		$user->delete();

	}

	public function post_reguser()
	{
		$user = new Model_Users();
        $user->username = Input::post('username');
        $user->password = Input::post('password');
        $user->email = Input::post('email');
        $user->password = Input::post('imagen');



        	if ($user->username == '' or $user->password == '' or $user->email = '')
        	{
        		return $this->response(array('faltan campos'));
        		 $user->save();
        	}
        	        	else 
        	{
        		

        		return $this->response(array('Ususario Creado'));
        	}

        	

    }

    
        
	
}