<?php
require_once './app/models/clientesModel.php';
require_once './app/views/apiView.php';
require_once './app/controllers/apiController.php';


    class clientesApiController extends apiController{
        private $model;
        
        
        function __construct(){
            parent::__construct();
            $this->model = new clientesModel();
            
        }

        function get($params = []){
            if (empty($params)) {
                $clientes = $this->model->getClients();
                $this->view->response($clientes, 200);
                return;
            }
         else{
            $cliente = $this->model->getClient($params [':ID']);
            if(!empty($cliente)){
                $this->view->response($cliente, 200);
            }
         }   
        }
        function insertClient(){
            $body = $this->getData();
            $nombre =$body->nombre;
            $apellido =$body->apellido;
            $edad =$body->edad;
            if(empty($nombre)||empty($apellido)||empty($edad)){
                $this->view->response('Debe ingresar todos los datos o correctamente', 400);
                return;
            }
            else{
            $id = $this->model->insertClient($nombre, $apellido, $edad);
            
            $this->view->response('el cliente fue agregada con el id='.$id, 201);
            }
        }
        function removeClient($params = []){
            $id= $params[':ID'];
            $cliente = $this->model->getClient($id);

            if($cliente){
                $this->model->removeClient($id);
                $this->view->response('el cliente con id '.$id.' ha sido borrada.',200);
                return;

            }
            else{
                $this->view->response('el cliente con id '.$id.'no existe', 404);
            }

        }
        function updateClient($params =[]){
            $id= $params[':ID'];
            $venta = $this->model->getClient($id);

            if($venta){
                $body = $this->getData();
                $nombre =$body->nombre;
                $apellido =$body->apellido;
                $edad =$body->edad;
                if(empty($nombre)||empty($apellido)||empty($edad)){
                    $this->view->response('Debe ingresar todos los datos o correctamente', 400);
                    return;
                }
                else{
                $this->model->actualizarCliente($id, $nombre, $apellido, $edad);
                
                $this->view->response('El cliente con el id '.$id.' ha sido modificada', 200);
                }
            }
            else{
                $this->view->response('El cliente con id '.$id.' no existe', 404);
            }
            
        }
   

    }