<?php

use \Firebase\JWT\JWT;

class Controller_Userdef extends Controller_Rest
{
	//variable privada que almacena la key para des/encreiptar el token 
	private $key = 'siegrefed';

	//funcion para hacer el login 
	public function post_login()
	{
		//recogemos los valores que mandamos desde el body
		$usr = Input::post('username');
		$pss = Input::post('password');
		//$key = 'siegrefed';

		
		//creacion de variable user para la busqueda (query) en la bbdd
		$user = Model_Users::find('all', array(
			'where' => array(
					array('username', $usr),
				)
			));

		//si el resultado de la busqueda no es nulo...
		if ( ! empty($user) )
		{
			//usamos el foreach para guardar los datos recibidos de la bbdd
			foreach ($user as $key => $value)
			{
				$id = $user[$key]->id;
				$username = $user[$key]->username;
				$password = $user[$key]->password;
			}
		}
		//si viene vacia la busqueda mostramos error
		else
		{
			return print('Error de autentificacion');
		}
		//una vez recogidos los datos en el foreach hacemos la comparacion entre ellos y los datos que mandamos por el body
		if ($username == $usr and $password == $pss)
		{
			//si coinciden alamcenamos los datos que nos intersan en un array...
			$token = array(
					"id" => $id, 
					"username" => $username, 
					"password" => $password
				);

			//y los codificamos($this para recurrir a la keyque esta fuera del metodo(linea 8))
			$jwt = JWT::encode($token, $this->key);
			
			//devolvemos la confirmacion y el token encriptado
			return[
				'code' => 200,
				'token' => $jwt,
				'username' => $token['username'],
				'password' => $token['password']
			];
		}
	}

	//funcion para obtener el listado completo de usuarios 
	public function get_users()
	{
		//comprobacion de errores (l. 213)
		if($this->verificar()){
		//una vez comprobado creamos $user para buscar dentro de la bbdd
		$user = Model_Users::find('all');
		// y lo devolvemos 
		return $user;}
		//si la comprobacion falla mandamos un error
		else 
			print('error');
	}

	//funcion para obtener un UNICO usuario
	public function post_user()
	{
		//pillamos el id que mandemos por el body
		 $idUser = Input::post('id');
			//busqueda en la bbdd en el que coincida el id del body con alguno que haya en la bbdd
			$user = Model_Users::find ('all', array(
			'where' => array(
				array('id', $idUser),
				)
			));
		
			//devolvemos resultado
		return $user;

	}

	//funcion para la modificacion de los users
	public function post_update()
	{
		//instanciamos un nuevo modelo de users para evitar errores de residuos 
		$user = new Model_Users();
		//busqueda en toda la bbdd sin restricciones 
		$user = Model_Users::find('all');

		//recogida de datos del body 
		$idUser = Input::post('id');
		$username = Input::post('username');
		$password = Input::post('password');
		$email = Input::post('email');



		//si la busqueda falla (que no va a fallar)....
		if (! empty($user))
		{
			//hacemos un foreach para almacenar los datos obtenidos de la busqueda y en esta ocasion para introducir datos para la modificacion del usuario
			foreach ($user as $key) {
				//restriccion de los datos que queremos de la bbdd('select from WHERE id.user = $idUser')
				if ($key['id'] == $idUser){
				$key->username = $username;
				$key->password = $password;
				$key->email = $email;
				//y ya obtenidos estos datos e igualados a los del body guardamos en la bbdd los cambios 
				$key->save();
				
			}
				//var_dump($key);
			}
			//print de la modificacion
			return print('user modificado');
			
		}
		//si la busqueda fallo print del error
		else
		{
			return print('Error');
		}

	}


	// funcion para borrar usuarios 
	public function post_delete()
	{
		//instancia de nuevo del modelo users
		$user = new Model_Users();
		//recogemos valores del body
		$idUser = Input::post('id');
		//query(select * from users where id.users = $idUser)
		$user = Model_Users::find('all', array(
			'where' => array(
				array('id', $idUser),
				)
			));
		
			//y para todos los datos que hemos recibido de la busqueda...
			foreach ($user as $key){
				
					var_dump($key['id']);
					//los borramos
					$key -> delete();

					return print('Usuario Borrado');
				

			}


		
		

		

	}

	//funcion para la creacion de users
	public function post_create()
	{
		//instancia del modelo users
		$user = new Model_Users();

		//recogida de datos del body 
		$username = Input::post('username');
		$password = Input::post('password');
		$email = Input::post('email');
		$imagen = Input::post('imagen');

		//en base a la instancia del modelo users empezamos a relacionar los campos con los datos del body 
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->imagen = $imagen;


        	//control de errores
        	//si alguno de los campos username, password o email viene vacio....
        	if (empty($username) or empty($password) or empty($email))
        	{
        		//mensaje de faltan campos por rellenear 
        		return $this->response(array('faltan campos'));
        		 
        	}
        	//si vienen completos revision de que no coincida el email que se va a registrar con otro ya registrado 
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



        		//busqueda en la bbdd del email para ver si coincide 
        		$bbdd = Model_Users::find('all', array(
        			'where' => array(
        				array('email', $email),
        				)
        			));
        		//si la busqueda arroja resultados no le dejamos registrarse 
        		if (! empty($bbdd))
        		{
        			return $this->response(array('Email ya registrado'));
        		}
        		//si no los arroja pues dejamos que se registre
        		else
        		{
        			$user->save();
        		return $this->response(array('Ususario Creado'));
        		}


        		
        	}

        	

    }

    //control de errores
    // verificacion del token para en teoria acceder al resto de funciones 
    public function verificar(){
    	//recogida de datos del header
    	  $auth = apache_request_headers();
    	   
        
    	  //si la recogida arroja resultados ....
        if (! empty($auth)){
        	//creacion de una variable para almacenar el dato especifico del header ($header["nombreDato"])
        	$jwt = $auth["auth"];
        	// key para la desencriptar
	        $key = "siegrefed";
	        //desencriptacion que necesita siempre esos campos: token, key y algoritmo
	        $decoded = JWT::decode($jwt, $key, array('HS256'));
	        //recogemos lo decodificado en forma de array (sino da errores despues)
	        $token = (array)$decoded;
	        var_dump($token);
	        return true;

	        //busqueda en la base de datos por si coinciden el nombre del usuario en la bbdd con el del token 
	       $entry = Model_Users::find('all', array(
	            'where' => array(
	                array('username', $token["username"]),
  
	            ),
	        ));

	       // si la busqueda no arroja resultados...
	       if (empty($entry)){
	       	//print de que no existe el usuario
	            print("no existe el usuario");
	            //y negamos la funcion de verificar
	            return false;
	       }
	      return true;
	  	}
	  	//si no se manda un token te dice que te logees ("en teoria ")
	  	else{
	  		print("logeate primero");
	  		return false;
	  	}
    }      
	
}