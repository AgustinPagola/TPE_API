<?php
require_once './app/models/materialesModel.php';
require_once './app/views/apiView.php';
require_once './app/controllers/apiController.php';
require_once './app/helpers/authHelper.php';
    class materialesApiController extends apiController{
        private $model;
        private $authHelper;
        
        function __construct(){
            parent::__construct();
            $this->model = new materialesModel();
            $this->authHelper = new authHelper();
        }

        function get($params = [])
        {
            if (empty($params)) {
                $ventas = $this->model->getList();
                $this->view->response($ventas, 200);
            }
         else{
            $venta = $this->model->getItem($params [':ID']);
            if(!empty($venta)){
                $this->view->response($venta, 200);
            }
            else if(empty($venta)){
                $this->view->response('La venta no existe', 404);
            }

         }   
        }
        function eliminarVenta($params = []){
            $user = $this->authHelper->currentUser();
            if(!$user){
                $this->view->response('desautorizado',400);
                return;
            }
            $id= $params[':ID'];
            $venta = $this->model->getItem($id);

            if($venta){
                $this->model->removeItem($id);
                $this->view->response('La venta con id '.$id.' ha sido borrada.',200);

            }
            else{
                $this->view->response('La venta con id '.$id.'no existe', 404);
            }

        }
        function addItem($params =[]){
            $user = $this->authHelper->currentUser();
            if(!$user){
                $this->view->response('desautorizado',400);
                return;
            }
            $body = $this->getData();

           
            $idProducto =$body->idProducto;
            $unidades = $body->unidades;
            $montoTotal = $body->montoTotal;
            $cliente = $body->cliente;
            if(empty($idProducto)||empty($unidades)||empty($montoTotal)||empty($cliente)){
                $this->view->response('Debe ingresar todos los datos', 400);
            }
            else{
            $id = $this->model->insertItem($idProducto,$unidades,$montoTotal,$cliente);
            
            $this->view->response('la venta fue agregada con el id='.$id, 201);
            }
        }
        function update($params =[]){
            $user = $this->authHelper->currentUser();
            if(!$user){
                $this->view->response('desautorizado',400);
                return;
            }
            $id= $params[':ID'];
            $venta = $this->model->getItem($id);
            
            if($venta){
                $body = $this->getData();
                $idProducto =$body->idProducto;
                $unidades = $body->unidades;
                $montoTotal = $body->montoTotal;
                $cliente = $body->cliente;
                if(empty($idProducto)||empty($unidades)||empty($montoTotal)||empty($cliente)){
                    $this->view->response('Debe ingresar todos los datos o correctamente', 400);
                    return;
                }
                else{
                $this->model->actualizarItem($id,$idProducto,$unidades,$montoTotal,$cliente);
                
                $this->view->response('La venta con el id '.$id.' ha sido modificada', 200);
                
                }
            }
            else{
                $this->view->response('La venta con id '.$id.' no existe', 404);
            }
            
        }
        public function listVentas() {
            $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : null;
            $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

            if(empty($order_by)){
                $this->view->response('Debe ingresar un valor para ordenar', 400);
                return;
            }
            else if(($order_by!="idProducto")&&($order_by!="unidades")&&($order_by!="montoTotal")&&($order_by!="cliente")){
                $this->view->response('El valor ingresado no se encontro en la base de datos', 404);
                return;
            }
            else{
            $ventas = $this->model->getVentas($order_by, $order);
            $this->view->response($ventas, 200);
        }
        }
        public function filtroVentas() {
            if (isset($_GET['valor']) && is_numeric($_GET['valor'])) {
                // La variable $_GET['valor'] es un número
                $valor = $_GET['valor'];
            
                $ventas = $this->model->getVentasByFiltro($valor);
                $this->view->response($ventas, 200);
            }
            else{
                $this->view->response('El valor ingresado no es un numero',400);
            }

        } 
        public function paginarVentas(){
            $items_por_pagina =isset($_GET['items_por_pagina']) ? $_GET['items_por_pagina'] : 10; // Número de elementos por página
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            if(empty($pagina) || empty($items_por_pagina)){
                $this->view->response("debe ingresar un valor", 400);
                return;
            }
            else if(isset($_GET['pagina']) && !is_numeric($_GET['pagina']) || (isset($_GET['items_por_pagina']) && !is_numeric($_GET['items_por_pagina']))){
                $this->view->response('El valor ingresado no es un numero',400);
                return;
            }
            else{
            $ventas = $this->model->getVentasPaginated($pagina, $items_por_pagina);
            $this->view->response($ventas, 200);    
        }
        }             

        }
    
    
    ?>

    