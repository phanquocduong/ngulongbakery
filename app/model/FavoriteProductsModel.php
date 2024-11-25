<?php
// Tương tác với bảng sản phẩm yêu thích
    class FavoriteProductsModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getFavoriteProduct($user_id, $product_id) {
            $sql = "SELECT * FROM favorite_products WHERE user_id = ? AND product_id = ?";
            return $this->db->get($sql, [$user_id, $product_id]);
        }

        public function deleteFavoriteProduct($user_id, $product_id) {
            $sql = "DELETE FROM favorite_products WHERE user_id = ? AND product_id = ?";
            return $this->db->execute($sql, [$user_id, $product_id]);
        }

        public function addFavoriteProduct($user_id, $product_id) {
            $sql = "INSERT INTO favorite_products (user_id, product_id) VALUES (?, ?)";
            return $this->db->execute($sql, [$user_id, $product_id]);
        }
    }
?>