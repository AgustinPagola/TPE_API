<?php
require_once './app/models/productosModel.php';
require_once './app/views/apiView.php';
require_once './app/controllers/apiController.php';
    class productosApiController extends apiController{
        private $model;
        
        function __construct(){
            parent::__construct();
            $this->model = new productosModel();
        }

        function get($params = []){
            if (empty($params)) {
                $ventas = $this->model->getProducts();
                $this->view->response($ventas, 200);
            }
            else{
                $venta = $this->model->getProduct($params [':ID']);
            if(!empty($venta)){
            $this->view->response($venta, 200);
            }
            }   
        }
        function removeProduct($params = []){
            $id= $params[':ID'];
            $venta = $this->model->getProduct($id);

            if($venta){
                $this->model->removeProduct($id);
                $this->view->response('El producto con id '.$id.' ha sido borrada.',200);

            }
            else{
                $this->view->response('El producto con id '.$id.'no existe', 404);
            }

        }
        function insertProduct(){
            $body = $this->getData();

            $producto = $body->producto;
            $monto = $body->monto;
            $descripcion = $body->descripcion;
            if(empty($producto)||empty($monto)||empty($descripcion)){
                $this->view->response('Debe ingresar todos los datos o correctamente', 400);
                return;
            }
            else{
            $id = $this->model->insertProduct($producto,$monto,$descripcion);
            
            $this->view->response('El producto fue agregado con el id='.$id, 201);
            }
        }
        function updateProduct($params =[]){
            $id= $params[':ID'];
            $venta = $this->model->getProduct($id);

            if($venta){
                $body = $this->getData();
              
                $producto = $body->producto;
                $monto = $body->monto;
                $descripcion = $body->descripcion;
                if(empty($producto)||empty($monto)||empty($descripcion)){
                    $this->view->response('Debe ingresar todos los datos o correctamente', 400);
                    return;
                }
                else{
                    $this->model->actualizarItem($id,$producto,$monto,$descripcion);

                    $this->view->response('El producto con el id '.$id.' ha sido modificada', 200);
                }
            }
            else{
                $this->view->response('El producto con id '.$id.' no existe', 404);
            }
            
        }
   

    }