<?php
class OrderModel
{
    public $db;
    public function __construct()
    {
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    public function getOrder()
    {
        $sql = "SELECT * FROM orders";
        return $this->db->getAll($sql);
    }
}
?>