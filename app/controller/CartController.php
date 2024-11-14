<?php
    class CartController {
        private function renderView($view) {
            $viewPath = 'app/view/' . $view . '.php';
            require_once $viewPath;
        }

        public function handleAddToCart() {
            if (empty($_SESSION['cart'])) {
                $_SESSION['cart'] = [];  // Khởi tạo giỏ hàng nếu chưa có
            }
            
            $productData = json_decode(file_get_contents('php://input'), true);
            $productId = $productData['id'];
            
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$productId])) {
                // Nếu sản phẩm đã có, tăng số lượng lên
                $_SESSION['cart'][$productId]['quantity']++;
            } else {
                // Nếu chưa có, thêm mới với số lượng = 1
                $_SESSION['cart'][$productId] = [
                    'name' => $productData['name'],
                    'price' => $productData['price'],
                    'image' => $productData['image'],
                    'quantity' => 1,
                ];
            }
            
            // Tính số lượng sản phẩm trong giỏ hàng
            $cartQuantity = count($_SESSION['cart']);
            
            // Phản hồi về số lượng giỏ hàng mới
            echo json_encode(['success' => true, 'cartQuantity' => $cartQuantity]);
        }            
    }       
?>