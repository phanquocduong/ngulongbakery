<?php
class PostModel{
    private $db;
    function __construct(){
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    function getPost() {
        $sql = "SELECT posts.*, categories.name AS category_name, users.full_name AS author_name
                FROM posts
                JOIN categories ON posts.category_id = categories.id
                JOIN users ON posts.author_id = users.id";
        return $this->db->getAll($sql);
    }
    public function getIdPost($idpost)
    {
        if ($idpost > 0) {
            // Sử dụng prepared statements để tránh SQL injection
            $sql ="SELECT posts.*, categories.name AS category_name, users.full_name AS author_name
                FROM posts
                JOIN categories ON posts.category_id = categories.id
                JOIN users ON posts.author_id = users.id
                WHERE posts.id = :idpost";
            $params = [':idpost' => $idpost];
            return $this->db->get($sql, $params);
        } else {
            return null;
        }
    }

    // Lấy comments theo id post trên url
    public function getCommentsByPostId($postId)
    {
        $sql = "SELECT comments.*, users.full_name FROM comments 
                JOIN users ON comments.user_id = users.id 
                WHERE comments.post_id = ?";
        return $this->db->getAll($sql, [$postId]);
    }
    
}