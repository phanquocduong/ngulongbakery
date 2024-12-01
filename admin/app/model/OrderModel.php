<?php

namespace App\Model;

class OrderModel
{
    private $conn;
    private $db;
    public function __construct()
    {
        require_once '../app/model/database.php';
        $this->db = new \Database();
    }

    // lấy danh sách đơn hàng
    public function getOrder()
    {
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        return $this->db->getAll($sql);
    }
    function getNewOrders()
    {
        $sql = "SELECT * FROM orders WHERE DATE(created_at) = CURDATE()"; // Lấy ra các đơn hàng mới trong ngày
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Use global namespace for PDO
    }
    // lấy tổng doanh thu
    public function getTotalAmount()
    {
        $sql = "SELECT SUM(total_amount) as total FROM orders";
        return $this->db->getOne($sql);
    }

    // lấy tổng doanh thu theo ngày hôm nay
    public function getTotalFee()
    {
        $sql = "SELECT SUM(total_amount) as totalToday FROM orders WHERE DATE(created_at) = CURDATE()";
        return $this->db->getOne($sql);
    }

    // lấy chi tiết đơn hàng
    public function getOrderDetail()
    {
        $sql = "SELECT * FROM orderdetails";
        return $this->db->getAll($sql);
    }

    // lấy thông tin chi tiết đơn hàng theo id
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

    public function chanceStatuspr($status, $id)
    {
        $sql = "UPDATE `orders` SET `status` = ? WHERE `orders`.`id` = ?";

        return $this->db->query($sql, [$status, $id]);
    }

    // lấy đơn hàng theo ngày
    public function getOrderToday()
    {
        $sql = "SELECT * FROM orders WHERE DATE(created_at) = CURDATE()";
        return $this->db->getOne($sql);
    }
    // lấy đơn hàng theo tuần
    public function getOrderInWeek()
    {
        $sql = "SELECT * FROM orders WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
        return $this->db->getAll($sql);
    }
}
