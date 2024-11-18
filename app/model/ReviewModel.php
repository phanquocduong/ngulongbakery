<?php
// Tương tác với bảng sanpham
    class ReviewModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }
        
        public function getFeaturedReviews() {
            $sql = "SELECT r.*, u.full_name, u.avatar FROM reviews r INNER JOIN users u ON r.user_id = u.id WHERE rating = 5 ORDER BY rand() LIMIT 2";
            return $this->db->getAll($sql);
        }

        public function getProductReviews($id) {
            $sql = "SELECT r.*, u.full_name, u.avatar 
                    FROM reviews r 
                    INNER JOIN users u ON r.user_id = u.id 
                    INNER JOIN products p on r.product_id = p.id 
                    WHERE r.product_id = ? 
                    ORDER BY id DESC
                    LIMIT 5
                    ";
            return $this->db->getAll($sql, [$id]);
        }

        public function addReview($user_id, $rating, $images, $comment, $product_id) {
            $sql = "INSERT INTO reviews (`user_id`, `rating`, `images`, `comment`, `product_id`) VALUES (?,?,?,?,?)";
            return $this->db->execute($sql, [$user_id, $rating, $images, $comment, $product_id]);
        }
    }
?>