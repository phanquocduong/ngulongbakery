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

        function getProductCount($condition = '', $params = []) {
            $sql = "SELECT count(*) AS quantity FROM products $condition";
            return $this->db->get($sql, $params)['quantity'];
        }

        public function getProduct($id) {
            $sql = "SELECT p.*, c.name AS category_name FROM products p INNER JOIN categories c ON p.category_id = c.id WHERE p.id = ?";
            return $this->db->get($sql, [$id]);
        }        

        public function getRelatedProducts($categoryId, $productId) {
            return $this->getProducts('WHERE category_id = ? AND id != ?', [$categoryId, $productId], 'rand()', 0, 4);
        }

        public function getProductByName($name) {
            $sql = "SELECT * FROM products WHERE name = ?";
            return $this->db->get($sql, [$name]);
        }
        
        public function increaseProductViews($id) {
            $sql = "UPDATE products SET views = views + 1 WHERE id = ?";
            return $this->db->execute($sql, [$id]);
        }
    }
?>