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
}

?>