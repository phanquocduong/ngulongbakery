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
            $sql = "SELECT p.*, c.name AS category_name 
                    FROM products p INNER JOIN categories c ON p.category_id = c.id 
                    WHERE p.id = ? AND p.status = 1 AND p.stock_quantity > 0";
            return $this->db->get($sql, [$id]);
        }        

        public function getRelatedProducts($categoryId, $productId, $productTags) {
            // Chuyển đổi các tag thành mảng
            $tagsArray = explode(',', $productTags);
            $productTagsWildcards = [];
            
            // Tạo mảng wildcard cho mỗi tag
            foreach ($tagsArray as $tag) {
                $tag = trim($tag);
                $productTagsWildcards[] = '%' . $tag . '%';
            }

            // Xây dựng điều kiện SQL
            $condition = "
                WHERE 
                    (category_id = ? AND id != ? AND status = 1 AND stock_quantity > 0) 
                OR 
                    (tags LIKE ?";
            
            // Thêm các điều kiện "tags LIKE ?" với mảng productTagsWildcards
            if (!empty($productTagsWildcards)) {
                $condition .= implode(' OR tags LIKE ?', array_fill(0, count($productTagsWildcards), ''));
            }
            
            // Hoàn tất điều kiện
            $condition .= ") AND id != ? AND status = 1 AND stock_quantity > 0";
            
            // Thêm các tham số cho câu truy vấn
            $params = array_merge([$categoryId, $productId], $productTagsWildcards, [$productId]);
        
            // Trả về kết quả
            return $this->getProducts($condition, $params, 'views DESC', 0, 4);
        }                      

        public function getProductByName($name) {
            $sql = "SELECT * FROM products WHERE name = ?";
            return $this->db->get($sql, [$name]);
        }
        
        public function increaseProductViews($id) {
            $sql = "UPDATE products SET views = views + 1 WHERE id = ? AND status = 1 AND stock_quantity > 0";
            return $this->db->execute($sql, [$id]);
        }

        public function updateSoldOfProduct($product_name, $quantity) {
            $sql = "UPDATE products SET sold = sold + ? WHERE name = ? AND status = 1 AND stock_quantity > 0";
            return $this->db->execute($sql, [$quantity, $product_name]);
        }

        public function updateStockQuantityOfProduct($product_name, $quantity) {
            $sql = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE name = ? AND status = 1 AND stock_quantity > 0";
            return $this->db->execute($sql, [$quantity, $product_name]);
        }

        public function getProductOfFavorite($userId) {
            $sql = "SELECT p.* 
                    FROM products p
                    INNER JOIN favorite_products f ON p.id = f.product_id
                    WHERE f.user_id = ?";
            return $this->db->getAll($sql, [$userId]);    
        }

        public function updateRatingOfProduct($id, $rating) {
            $sql = "UPDATE products SET rating = ? WHERE id = ?";
            return $this->db->execute($sql, [$rating, $id]);
        }
    }
?>