<?php
// Tương tác với bảng sanpham
    class ProductModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        function getProducts($condition = '', $params = [], $order = '', $start = 0, $limit = 0) {
            $sql = "SELECT * FROM products";
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
    }
?>