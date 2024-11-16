<?php
class AdProductsModel
{
    private $db;
    public function __construct()
    {
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    public function getProducts()
    {
        $sql = "SELECT products.*, categories.name AS category_name
                FROM products
                JOIN categories ON products.category_id = categories.id";
        return $this->db->getAll($sql);
    }
    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        return $this->db->getOne($sql, [$id]);
    }
    public function getBestSell()
    {
        $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            JOIN categories ON products.category_id = categories.id
            WHERE products.sold > 5
            ORDER BY products.sold DESC";
        return $this->db->getAll($sql);
    }
    public function stock_quantity()
    {
        $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            JOIN categories ON products.category_id = categories.id
            ORDER BY products.stock_quantity DESC";
        return $this->db->getAll($sql);
    }
}

?>