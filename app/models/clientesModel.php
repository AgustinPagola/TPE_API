<?php
require_once './config.php'; 
class clientesModel{
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }
    function getClients() {
        $query = $this->db->prepare('SELECT * FROM clientes');
        $query->execute();

        $list = $query->fetchAll(PDO::FETCH_OBJ);
        return $list;
    }
    function getClient($id){
        $query =$this->db->prepare('SELECT * FROM clientes WHERE id = ?');
        $query->execute([($id)]);
        $cliente = $query->fetch(PDO::FETCH_OBJ);
    
        return $cliente;
    }
    function insertClient($nombre, $apellido, $edad){
        $query = $this->db->prepare('INSERT INTO clientes(nombre, apellido, edad) VALUES(?,?,?)');
        $query->execute (array($nombre, $apellido, $edad));

        return $this->db->lastInsertId();
    }
    function removeClient($id){
       $query = $this->db->prepare('DELETE FROM clientes WHERE id = ?');
       $query->execute([$id]);
    }
    function actualizarCliente($clienteId,$nuevoNombre,$nuevoApellido,$nuevaEdad){
        $query = $this->db->prepare("UPDATE clientes SET nombre='$nuevoNombre', apellido='$nuevoApellido',
        edad='$nuevaEdad'WHERE id = ?");
        $query->execute(array($clienteId));
    }
    }