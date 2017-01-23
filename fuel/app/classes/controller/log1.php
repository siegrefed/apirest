<?php
 use \Firebase\JWT\JWT;
 class Controller_Log1 extends Controller_Rest
{
    public function errorAuth(){
        return $this->response(array('Error de autentificacion'));
    }


    public function post_log(){
        
        $key = 'siegrefed';
        
        $usr = Input::post('username');
        $pss = Input::post('password');
        
        $user = Model_Users::find('all', array('where' => array(array('username',$usr),)));
       
        if(! empty($user)){
          
            foreach ($user as $key => $value) {
                $id = $user[$key]->id;
                $username = $user[$key]->username;
                $password = $user[$key]->password;
                # code...
            }
            
    }else {return $this->response(array('El Usuario no existe'));}

    if($username == $usr && $password == $pss){
        $token = array(
            'id'=> $id,
            'username' => $username,
            'password' => $password


            );

        $jwt = JWt::encode($token, $key);

        return[
            'code' => 200,
            'token' => $jwt
        ];
    }else {
        return $this->errorAuth();
    }

}
}