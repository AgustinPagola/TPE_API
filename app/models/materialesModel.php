<?php
require_once './config.php';
class materialesModel {
    private $db;

    function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
    function getList() {
        $query = $this->db->prepare('SELECT * FROM ventas ');
        $query->execute();
        $list = $query->fetchAll(PDO::FETCH_OBJ);
        return $list;
    } 
    function getItem($id){
        $query =$this->db->prepare('SELECT * FROM ventas WHERE idVenta = ?');
        $query->execute([($id)]);
        $venta = $query->fetch(PDO::FETCH_OBJ);
    
        return $venta;
    }
    function removeItem($idVenta) {
        $query = $this->db->prepare('DELETE FROM ventas WHERE idVenta = ?');
        $query->execute([$idVenta]);
    }
    function insertItem($producto, $unidades,$montoTotal,$cliente) {
        $query = $this->db->prepare('INSERT INTO ventas(idProducto, unidades, montoTotal,cliente) VALUES(?,?,?,?)');
        $query->execute (array($producto, $unidades,$montoTotal, $cliente));

        return $this->db->lastInsertId();
    }
    function actualizarItem($idVenta,$nuevoProducto,$nuevasUnidades,$nuevoMontoTotal,$nuevoCliente){
        $query = $this->db->prepare("UPDATE ventas SET idProducto='$nuevoProducto', unidades='$nuevasUnidades', montoTotal='$nuevoMontoTotal',
        cliente='$nuevoCliente'WHERE idVenta = ?");
        $query->execute(array($idVenta));
    }


    function showClient($clienteId){
       $query = $this->db->prepare('SELECT nombre, apellido, edad FROM clientes WHERE id = ?');
       $query->execute(array($clienteId));
       $cliente = $query->fetch(PDO::FETCH_OBJ);
       
       return $cliente;
    }
    public function getVentas($order_by, $order) {
        // Crear la consulta SQL con dos marcadores de posición
        $query = $this->db->prepare("SELECT * FROM ventas ORDER BY $order_by $order");
    
        // Enlazar los valores a los marcadores de posición utilizando execute
        $query->execute();
    
        $ventasOrdenadas = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $ventasOrdenadas;
    }
    public function getVentasByFiltro($valor) {
        $query = $this->db->prepare("SELECT * FROM ventas WHERE unidades > ?");

        // Ejecutar la consulta y obtener los resultados de la base de datos
        $query->execute([$valor]);
        $ventas = $query->fetchAll(PDO::FETCH_OBJ);

        return $ventas;
}
    public function getVentasPaginated($pagina , $items_pagina_pagina ){
       
        $offset = ($pagina - 1) * $items_pagina_pagina;
        
        $query = $this->db->prepare('SELECT * FROM ventas LIMIT :limite OFFSET :offset');
        $query->bindParam(':limite', $items_pagina_pagina, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        $ventas = $query->fetchAll(PDO::FETCH_OBJ);

        return $ventas;
    }
}
?>
