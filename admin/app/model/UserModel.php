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
    public function getIdUser($iduser)
    {
        if ($iduser > 0) {
            // Sử dụng prepared statements để tránh SQL injection
            $sql ="SELECT * FROM users WHERE id = :iduser";
            $params = [':iduser' => $iduser];
            return $this->db->get($sql, $params);
        } else {
            return null;
        }
    }
    public function getUserByRole($role)
    {
        $sql = "SELECT * FROM users WHERE role_id = ?";
        return $this->db->getAll($sql, [$role]);
    }
    function updateUser($data) {
        $data['status'] = isset($data['status']) ? intval($data['status']) : 0;
        $data['created_at'] = !empty($data['created_at']) ? $data['created_at'] : date('Y-m-d H:i:s');
        $sql = "UPDATE users SET email = ?, full_name = ?, phone = ?, address = ?, role_id = ?, avatar = ?, status = ? WHERE id = ?";
        $params = [$data['email'], $data['full_name'], $data['phone'], $data['address'], $data['role_id'], $data['avatar'], $data['status'], $data['id']];
        return $this->db->update($sql, $params);
    }
    // public function deleteUser($id)
    // {
    //     $this->deleteRelatedData($id);
    //     $sql = "DELETE FROM users WHERE id = ?";
    //     $param = [$id];
    //     return $this->db->delete($sql, $param);
    // }

        public function isForeignKey($id)
    {
        $ordersCount = $this->db->query("SELECT COUNT(*) as count FROM orders WHERE user_id = ?", [$id])->fetch()['count'];
        $commentsCount = $this->db->query("SELECT COUNT(*) as count FROM comments WHERE user_id = ?", [$id])->fetch()['count'];
        $favoritesCount = $this->db->query("SELECT COUNT(*) as count FROM favorite_products WHERE user_id = ?", [$id])->fetch()['count'];
        $reviewsCount = $this->db->query("SELECT COUNT(*) as count FROM reviews WHERE user_id = ?", [$id])->fetch()['count'];
        $postsCount = $this->db->query("SELECT COUNT(*) as count FROM posts WHERE author_id = ?", [$id])->fetch()['count'];
        return ($ordersCount > 0 || $commentsCount > 0 || $favoritesCount > 0 || $reviewsCount > 0 || $postsCount > 0);
    }
    public function updateStatus($id, $status){
        $newStatus = ($status == 1) ? 0 : 1;
        $query = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $newStatus, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $newStatus;
    }
    // public function deleteRelatedData($id)
    // {
    //     $this->db->query("DELETE FROM comments WHERE post_id IN (SELECT id FROM posts WHERE author_id = ?)", [$id]);
    //     $this->db->query("DELETE FROM posts WHERE author_id = ?", [$id]);
    //     $this->db->query("DELETE FROM orderdetails WHERE order_id IN (SELECT id FROM orders WHERE user_id = ?)", [$id]);
    //     $this->db->query("DELETE FROM orders WHERE user_id = ?", [$id]);
    //     $this->db->query("DELETE FROM favorite_products WHERE user_id = ?", [$id]);
    //     $this->db->query("DELETE FROM reviews WHERE user_id = ?", [$id]);
    //     $this->db->query("DELETE FROM posts WHERE author_id = ?", [$id]);
    // }
}