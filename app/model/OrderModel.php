<?php
class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    function getOrders($condition = '', $params = [], $order = '', $start = 0, $limit = 0) {
        $sql = "SELECT * FROM orders";
        if ($condition) {
            $sql .= " $condition";
        }
        if ($order) {
            $sql .= " ORDER BY $order";
        }
        if ($limit > 0) {
            $sql .= " LIMIT $start, $limit";
        }
        return $this->db->getAll($sql, $params);
    }

    
    function getOrderCount($condition = '', $params = []) {
        $sql = "SELECT count(*) AS quantity FROM orders $condition";
        return $this->db->get($sql, $params)['quantity'];
    }

    function getOrderDetails($id) {
        $sql = "SELECT * FROM orderdetails WHERE order_id = ?";
        return $this->db->getAll($sql, [$id]);
    }

    function changeStatus($id, $status) {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        return $this->db->execute($sql, [$status, $id]);
    }

    function createOrder($idClient, $fullname, $email, $phone, $address, $total, $method, $note, $discountId) {
        $sql = "INSERT INTO orders (`user_id`, `customer`, `email`, `phone`, `shipping_address`, `total_amount`, `payment_method`, `note`, `discount_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->execute($sql, [$idClient, $fullname, $email, $phone, $address, $total, $method, $note, $discountId]);
        $lastId = $this->db->lastInsertId();
        return $lastId;
    }

    function createOrderDetails($orderId, $unitPrice, $quantity, $name, $image) {
        $sql = "INSERT INTO orderdetails (`order_id`, `unit_price`, `quantity`, `product_name`, `product_image`) VALUES (?, ?, ?, ?, ?)";
        $this->db->execute($sql, [$orderId, $unitPrice, $quantity, $name, $image]);
    }

    function updateReviewStatusOfOrder($orderId) {
        $sql = "UPDATE orders SET is_reviewed = 1 WHERE id = ? AND status = 'Giao hàng thành công'";
        return $this->db->execute($sql, [$orderId]);
    }
}
?>