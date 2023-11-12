<?php
require_once './app/models/userModel.php';
require_once './app/views/apiView.php';
require_once './app/controllers/apiController.php';
require_once './app/helpers/authHelper.php';
    class userApiController extends apiController{
        private $model;
        private $authHelper;
        
        function __construct(){
            parent::__construct();
            $this->model = new UserModel();
            $this->authHelper= new authHelper();
        }
        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders(); // Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'

            if(empty($basic)) {
                $this->view->response('No envió encabezados de autenticación.', 400);
                return;
            }

            $basic = explode(" ", $basic); // ["Basic", "base64(usr:pass)"]

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticación son incorrectos.', 400);
                return;
            }

            $userpass = base64_decode($basic[1]); // usr:pass
            $userpass = explode(":", $userpass); // ["usr", "pass"]

            $user = $userpass[0];
            $pass = $userpass[1];
            
            $usuarios = $this->model->getUsuarios();
            foreach($usuarios as $usuario){
            $userdata = [ "user" => $usuario->user, "pass" => $usuario->password ]; // Llamar a la DB

            if($user == $usuario->user && password_verify($pass, $usuario->password)) {
                // Usuario es válido
                
                $token = $this->authHelper->createToken($userdata);
                $this->view->response($token, 200);
            } else {
                $this->view->response('El usuario o contraseña son incorrectos.', 400);
            }
        }
        }
    }
