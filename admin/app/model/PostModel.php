<?php
class PostModel
{
    private $db;
    function __construct()
    {
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    //lấy dữ liệu từ bảng post
    function getPost()
    {
        $sql = "SELECT posts.*, categories.name AS category_name, users.full_name AS author_name
                FROM posts
                JOIN categories ON posts.category_id = categories.id
                JOIN users ON posts.author_id = users.id";
        return $this->db->getAll($sql);
    }
    //lấy thông tin post theo id
    public function getIdPost($idpost)
    {
        if ($idpost > 0) {
            // Sử dụng prepared statements để tránh SQL injection
            $sql = "SELECT posts.*, categories.name AS category_name, users.full_name AS author_name, users.avatar AS avatar_user
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

    public function deleteCommentById($commentId)
    {
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $commentId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    //Thêm Posts
    public function insertPost($data)
    {
        if (isset($data['created_at'])) {
            $date = $data['created_at']; 
            $mysqlDate = date('Y-m-d H:i:s', strtotime($date));
            $data['created_at'] = $mysqlDate;
        }
        $sql = "INSERT INTO posts(title, image, content, created_at, status, author_id, category_id) VALUES(?,?,?,?,?,?,?)";
        $params = [
            $data['title'],
            $data['image'],
            $data['content'],
            $data['created_at'],
            $data['status'],
            $data['author_id'],
            $data['category_id']
        ];
        return $this->db->insert($sql, $params);
    }

    public function updatePost($data)
    {
        // Ensure the created_at field is properly formatted
        if (isset($data['created_at'])) {
            $date = $data['created_at']; // Dữ liệu ban đầu
            $mysqlDate = date('Y-m-d H:i:s', strtotime($date)); // Chuyển đổi định dạng
            $data['created_at'] = $mysqlDate;
        }
    
        $sql = "UPDATE posts SET title = ?, image = ?, content = ?, created_at = ?, status = ?, author_id = ?, category_id = ? WHERE id = ?";
        $params = [
            $data['title'],
            $data['image'],
            $data['content'],
            $data['created_at'],
            $data['status'],
            $data['author_id'],
            $data['category_id'],
            $data['id'],
        ];
    
        return $this->db->update($sql, $params);
    }
    public function deletePost($postId)
{
    if ($this->isForeignKey($postId)) {
        // Xóa các bình luận trước khi xóa bài viết
        $this->deleteRelatedData($postId);
    }

    // Xóa bài viết
    $sql = "DELETE FROM posts WHERE id = ?";
    return $this->db->delete($sql, [$postId]);
}

    public function isForeignKey($postId) {
        $commentsCount = $this->db->query("SELECT COUNT(*) as count FROM comments WHERE post_id = ?", [$postId])->fetch()['count'];
        return $commentsCount > 0;
    }
    
    public function deleteRelatedData($postId)
{
    // Xóa dữ liệu liên quan trong bảng comments
    $this->db->query("DELETE FROM comments WHERE post_id = ?", [$postId]);
}

}