<?php
require_once './config.php'; 
class productosModel{
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }
    function getProducts() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        $list = $query->fetchAll(PDO::FETCH_OBJ);
        return $list;
    }
    function getProduct($idProducto){
        $query = $this->db->prepare('SELECT producto, monto, descripcion FROM productos WHERE idProducto = ?');
        $query->execute(array($idProducto));
        $producto = $query->fetch(PDO::FETCH_OBJ);
        
        return $producto;
     }
     function removeProduct($idProducto){
        $query = $this->db->prepare('DELETE FROM productos WHERE idProducto = ?');
        $query->execute([$idProducto]);
     }
    function insertProduct( $producto, $monto, $descripcion){
        $query = $this->db->prepare('INSERT INTO productos( producto, monto, descripcion) VALUES(?,?,?)');
        $query->execute (array($producto, $monto, $descripcion));

        return $this->db->lastInsertId();
    }
    function actualizarItem($idProducto,$nuevoProducto,$nuevoPrecio,$nuevaDescripcion){
        $query = $this->db->prepare("UPDATE productos SET producto='$nuevoProducto', monto='$nuevoPrecio',
        descripcion='$nuevaDescripcion'WHERE idProducto = ?");
        $query->execute(array($idProducto));
    }

    }
