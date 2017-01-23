 
<?php
use \Firebase\JWT\JWT;

class Controller_Users extends Controller_Rest
{

    public function get_users()
    {
        $users = Model_Users::find('all');
        
        return $users;
        // return $this->response(array(
        //     'id' => 1,
        //     'user' => 'Daniel',
        //     'email' => 'daniel@mail.com'
            
        // ));


    }
    public function post_users()
    {
        $user = new Model_Users();
        $user->username = Input::post('username');
        $user->password = Input::post('password');

        $user->save();

        $key = "siegrefed";
        $token = array(
            "username" => "username",
            "password" => "password"
            
        );
        $jwt = JWT::encode($token, $key);
        

        return $this->response(array(
                'mensaje' => 'usuario creado',
                $jwt

            )

        );


        // return $this->response(array(
        //     'usuario' => 'creado'
        //     //'id' => 1,
        //     //'user' => Input::get('user'),
        //     //'email' => Input::get('email')
            
        // ));
    }

    
    public function post_login()
    {
        $user = new Model_Users();
        $user->username = Input::post('username');
        $user->password = Input::post('password');

        $user->save();

        $key = "siegrefed";
        $token = array(
            "username" => $user->username,
            "password" => $user->password
            
        );
        $jwt = JWT::encode($token, $key);
       // print_r($decoded);
        

        return $this->response(array(
                'mensaje' => 'usuario creado',
                $jwt                

            )

        );


        // return $this->response(array(
        //     'usuario' => 'creado'
        //     //'id' => 1,
        //     //'user' => Input::get('user'),
        //     //'email' => Input::get('email')
            
        // ));
    }
    public function get_login()
    {
        $auth = apache_request_headers();
        $jwt = $auth["auth"];
        $key = "siegrefed";

        $users = Model_Users::find('all');
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        $token = (array)$decoded;

        ///var_dump($decoded->username);

        
           // var_dump($user["username"]);
            //var_dump($token["username"]);
            if ($user["username"] == $token["username"] && $user["password"] == $token["password"]){



                return $this->response(array ($user["username"],$user["password"]));
            }else {

                return print('contraseña incorrecta');
            }

        
    }



    public function verify()
    {
        

        $key = "siegrefed";
        $token = array(
            "username" => $user->username,
            "password" => $user->password
            
        );
        $jwt = JWT::encode($token, $key);
       // print_r($decoded);
        

        return $this->response(array(
                
                $jwt               

            )

        );


        // return $this->response(array(
        //     'usuario' => 'creado'
        //     //'id' => 1,
        //     //'user' => Input::get('user'),
        //     //'email' => Input::get('email')
            
        // ));
    }





    public function get_verify(){
        $auth = apache_request_headers();
        $jwt = $auth["auth"];
        $key = "siegrefed";

        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $token = (array)$decoded;

       $entry = Model_Users::find('all', array(
            'where' => array(
                array('username', $token["username"]),
                
            ),
        ));
       if ($entry == is_null()){
            print_r("no existe el usuario");
       }
      return $entry;
       //$users = (array)$entry;
       //if ($users["username"] == $token["username"]){

            //return print_r($users["username"]);}



    }

    public function post_log(){

        $data = apache_request_headers();
        $usr = Input::post('username');
        $pss = Input::post('password');

        $key ="siegrefed";
        $token = array($usr, $pss);
        $jwt = JWT::encode($token, $key);

        verify();

         return $this->response(array(
                
                $jwt               

            )

        );


    }
}









