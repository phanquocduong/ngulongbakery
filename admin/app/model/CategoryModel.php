<?php
class CategoryModel{
    private $db;
    function __construct(){
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    function getCate(){
        $sql = "SELECT * FROM categories";
        return $this->db->getAll($sql);
    }
}