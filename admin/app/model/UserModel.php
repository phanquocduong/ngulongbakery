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
    
}