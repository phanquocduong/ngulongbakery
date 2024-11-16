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
        $sql = 'SELECT * FROM products';
        $query = $this->db->getAll($sql);
        return $query;
    }
}

?>