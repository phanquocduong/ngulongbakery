<?php
    class BannerModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        function getBanners($condition = '', $params = [], $order = '', $start = 0, $limit = 0) {
            $sql = "SELECT * FROM banners";
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