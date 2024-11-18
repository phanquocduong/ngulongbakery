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
    }
?>