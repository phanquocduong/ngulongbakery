<?php
    class DiscountModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function validateCoupon($code, $grandTotal, $currentDate) {
            $sql = "SELECT * FROM discounts 
                    WHERE code = ? 
                    AND ? BETWEEN start_date AND end_date 
                    AND (usage_limit IS NULL OR usage_limit > 0)
                    AND ? >= min_order_value
                    AND active = 1";
            return $this->db->get($sql, [$code, $currentDate, $grandTotal]); 
        }

        public function getDiscount($id) {
            $sql = "SELECT * FROM discounts WHERE id = ?";
            return $this->db->get($sql, [$id]);
        }

        public function updateUsageLimitOfDiscount($id) {
            $sql = "UPDATE discounts SET usage_limit = usage_limit - 1 WHERE id = ?";
            return $this->db->get($sql, [$id]);
        }
    }
?>