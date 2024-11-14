<?php
// Tương tác với bảng danhmuc
    class CategoryModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        function getCategories($condition = '', $params = [], $order = '', $start = 0, $limit = 0) {
            $sql = "SELECT * FROM categories";
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