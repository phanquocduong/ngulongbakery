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
    public function getOrderDetail()
    {
        $sql = "SELECT * FROM orderdetails";
        return $this->db->getAll($sql);
    }
    public function getUserDetail($id)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        return $this->db->getOne($sql, [$id]);
    }
    public function getOrderById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        return $this->db->getOne($sql, [$id]);
    }
    public function getOrderDetailByOrderId($orderId)
    {
        $sql = "SELECT * FROM orderdetails WHERE order_id = ?";
        return $this->db->getAll($sql, [$orderId]);
    }
    public function getDiscountById($discountId)
    {
        $sql = "SELECT * FROM discounts WHERE id = ?";
        return $this->db->getOne($sql, [$discountId]);
    }
}
?>