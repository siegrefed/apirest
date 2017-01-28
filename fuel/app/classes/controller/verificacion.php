<?php

private function verificarAuth()
	{
		$header = apache_request_headers();
		if (isset($header['Authorization'])) 
		{
			$token = $header['Authorization'];
			$dataJwtUser = JWT::decode($token, $this->key, $this->algorithm);
			if (isset($dataJwtUser->username) and isset($dataJwtUser->password)) 
			{
				$user = Model_User::find('all', array(
				    'where' => array(
				        array('username', $dataJwtUser->username),
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
					return false;
				}
			}
			else
			{
				return false;
			}
			if ($username == $dataJwtUser->username and $password == $dataJwtUser->password) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}