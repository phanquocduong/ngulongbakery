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
    public function getIdPros($idpros)
    {
        if ($idpros > 0) {
            // Sử dụng prepared statements để tránh SQL injection
            $sql ="SELECT * FROM products WHERE category_id = :idpros";
            $params = [':idpros' => $idpros];
            return $this->db->getAll($sql, $params);
        } else {
            return null;
        }
    }
    public function getIdCate($idcate)
    {
        if ($idcate > 0) {
            // Sử dụng prepared statements để tránh SQL injection
            $sql ="SELECT * FROM categories WHERE id = :idcate";
            $params = [':idcate' => $idcate];
            return $this->db->get($sql, $params);
        } else {
            return null;
        }
    }
}