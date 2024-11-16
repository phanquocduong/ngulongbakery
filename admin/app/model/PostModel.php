<?php
class PostModel{
    private $db;
    function __construct(){
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    function getPost(){
        $sql = "SELECT * FROM posts";
        return $this->db->getAll($sql);
    }
}