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
    
        $sql = "UPDATE users SET email = ?, password = ?, full_name = ?, phone = ?, address = ?, role_id = ?, avatar = ?, status = ?, verification_code = ?, is_verified = ?, created_at = ?, reset_code = ? WHERE id = ?";
        $params = [$data['email'], $data['password'], $data['full_name'], $data['phone'], $data['address'], $data['role_id'], $data['avatar'], $data['status'], $data['verification_code'], $data['is_verified'], $data['created_at'], $data['reset_code'], $data['id']];
    
        // Debug dữ liệu
        print_r($params);
    
        return $this->db->update($sql, $params);
    }
    function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $param = [$id];
        return $this->db->delete($sql, $param);
    }
    public function isForeignKey($id) {
        // Giả sử cột lưu trữ ID người dùng trong bảng posts là 'user_id'
        $query = "SELECT COUNT(*) as count FROM posts WHERE author_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['count'] > 0;
    }
    
}