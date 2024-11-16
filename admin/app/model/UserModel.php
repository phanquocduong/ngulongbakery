<?php
class UserModel{
    private $db;
    function __construct(){
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    function getUser(){
        $sql = "SELECT * FROM users";
        return $this->db->getAll($sql);
    }
}