<?php
class CommentsModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Khởi tạo đối tượng Database
    }

    public function totalComments($post_id) {
        $sql = "SELECT COUNT(id) AS total_comments FROM comments WHERE post_id = ?";
        // Gọi phương thức query từ đối tượng $this->db
        $result = $this->db->query($sql, [$post_id])->fetch();
        return $result['total_comments'] ?? 0;
    }
    public function getCommentsByPostId($postId) {
        $sql = "SELECT comments.*, users.full_name as fullname , users.avatar as avatar
                FROM comments 
                JOIN users ON comments.user_id = users.id 
                WHERE comments.post_id = ?
                ORDER BY comments.id DESC";;
        return $this->db->getAll($sql, [$postId]);
    }
    public function insertComment($data) {
        $sql = "INSERT INTO comments (comment, user_id, post_id) VALUES (:comment, :user_id, :post_id)";
        return $this->db->insert($sql, $data);
    }
}
