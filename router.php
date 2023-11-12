<?php 
    require_once './libs/routerApi.php';
    require_once './app/controllers/materialesApiController.php';
    require_once './app/controllers/clientesApiController.php';
    require_once './app/controllers/productosApiController.php';
    require_once './app/controllers/userApiController.php';
    $router = new Router();


    $router->addRoute('materiales', 'GET', 'materialesApiController','get');
    $router->addRoute('materiales', 'POST', 'materialesApiController', 'addItem' );
    $router->addRoute('materiales/:ID', 'GET', 'materialesApiController','get');
    $router->addRoute('materiales/:ID', 'PUT', 'materialesApiController', 'update');
    $router->addRoute('materiales/:ID', 'DELETE', 'materialesApiController', 'eliminarVenta' );
    $router->addRoute('filtrar', 'GET', 'materialesApiController', 'filtroVentas');
    $router->addRoute('orden', 'GET', 'materialesApiController', 'listVentas' );
    $router->addRoute('paginar', 'GET', 'materialesApiController', 'paginarVentas');


    $router->addRoute('clientes', 'GET', 'clientesApiController','get');
    $router->addRoute('clientes', 'POST', 'clientesApiController', 'insertClient' );
    $router->addRoute('clientes/:ID', 'GET', 'clientesApiController','get');
    $router->addRoute('clientes/:ID', 'PUT', 'clientesApiController', 'updateClient');
    $router->addRoute('clientes/:ID', 'DELETE', 'clientesApiController', 'removeClient' );

    $router->addRoute('productos', 'GET', 'productosApiController','get');
    $router->addRoute('productos', 'POST', 'productosApiController', 'insertProduct' );
    $router->addRoute('productos/:ID', 'GET', 'productosApiController','get');
    $router->addRoute('productos/:ID', 'PUT', 'productosApiController', 'updateProduct');
    $router->addRoute('productos/:ID', 'DELETE', 'productosApiController', 'removeProduct');

    $router->addRoute('user/token', 'GET', 'userApiController', 'getToken' );
    


    $router -> route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 