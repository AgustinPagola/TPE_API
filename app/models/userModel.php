<?php
require_once './config.php';
class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE user = ?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
    public function getUsuarios(){
        $query = $this->db->prepare('SELECT * FROM usuarios');
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
