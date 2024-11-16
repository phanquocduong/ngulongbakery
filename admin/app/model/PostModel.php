<?php
class PostModel{
    private $db;
    function __construct(){
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    public function getPost() {
        $sql = "SELECT posts.*, categories.name AS category_name, users.full_name AS author_name
                FROM posts
                JOIN categories ON posts.category_id = categories.id
                JOIN users ON posts.author_id = users.id";
        return $this->db->getAll($sql);
    }
    
    
}