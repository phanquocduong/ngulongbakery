<?php
class CategoryModel
{
    private $db;
    function __construct()
    {
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    function getCate()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->getAll($sql);
    }
    public function getIdPro($id)
    {
        $sql = "SELECT * FROM products WHERE category_id = ? LIMIT 1";
        return $this->db->getOne($sql, [$id]);
    }
    public function getIdCate($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        return $this->db->getOne($sql, [$id]);
    }
    public function countProductsByCategoryId($categoryId)
    {
        $sql = "SELECT COUNT(*) as count FROM products WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
    public function getProductsByCategoryId($categoryId)
    {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        return $this->db->getAll($sql, [$categoryId]);
    }
}