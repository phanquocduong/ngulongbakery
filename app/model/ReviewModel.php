<?php
// Tương tác với bảng sanpham
    class ReviewModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }
        
        public function getFeaturedReviews() {
            $sql = "SELECT r.*, u.full_name, u.avatar FROM reviews r INNER JOIN users u ON r.user_id = u.id WHERE r.rating >= 4 AND r.status = 1 ORDER BY r.created_at DESC LIMIT 2";
            return $this->db->getAll($sql);
        }

        function getReviewsOfProduct($condition = '', $params = [], $order = '', $start = 0, $limit = 0) {
            $sql = "SELECT r.*, u.full_name, u.avatar 
                    FROM reviews r 
                    INNER JOIN users u ON r.user_id = u.id 
                    INNER JOIN products p on r.product_id = p.id";
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

        function getReviewCount($condition = '', $params = []) {
            $sql = "SELECT count(*) AS quantity FROM reviews $condition";
            return $this->db->get($sql, $params)['quantity'];
        }
        
        public function addReview($user_id, $rating, $images, $comment, $product_id) {
            $sql = "INSERT INTO reviews (`user_id`, `rating`, `images`, `comment`, `product_id`) VALUES (?,?,?,?,?)";
            return $this->db->execute($sql, [$user_id, $rating, $images, $comment, $product_id]);
        }
    }
?>