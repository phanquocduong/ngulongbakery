<?php
    class CartController {
        private $category;
        private $product;

        function __construct() {
            $this->category = new CategoryModel();
            $this->product = new ProductModel();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        public function handleAddToCart() {
            if (empty($_SESSION['cart'])) {
                $_SESSION['cart'] = [];  // Khởi tạo giỏ hàng nếu chưa có
            }
        
            // Lấy dữ liệu từ yêu cầu POST
            $productData = json_decode(file_get_contents('php://input'), true);
            $productId = $productData['id'];
            $quantity = $productData['quantity'];
        
            // Truy vấn thông tin sản phẩm từ cơ sở dữ liệu
            $product = $this->product->getProduct($productId);
        
            if (!$product) {
                echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại.']);
                return;
            }
        
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$productId])) {
                $newQuantity = $_SESSION['cart'][$productId]['quantity'] + $quantity;
                if ($newQuantity <= $_SESSION['cart'][$productId]['stock']) {
                    $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
                } else {
                    $_SESSION['cart'][$productId]['quantity'] = $_SESSION['cart'][$productId]['stock'];
                }
            } else {
                if ($quantity <= $product['stock_quantity']) {
                    $_SESSION['cart'][$productId] = [
                        'id' => $productId,
                        'name' => $product['name'],
                        'price' => $product['sale'] ?? $product['price'],
                        'image' => $product['image'],
                        'quantity' => $quantity,
                        'stock' => $product['stock_quantity']
                    ];
                } else {
                    $_SESSION['cart'][$productId] = [
                        'id' => $productId,
                        'name' => $product['name'],
                        'price' => $product['sale'] ?? $product['price'],
                        'image' => $product['image'],
                        'quantity' => $product['stock_quantity'],
                        'stock' => $product['stock_quantity']
                    ];
                }
                
            }
        
            // Tính số lượng sản phẩm trong giỏ hàng
            $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
        
            // Phản hồi về số lượng giỏ hàng mới
            echo json_encode(['success' => true, 'cartQuantity' => $cartQuantity]);
        }
        

        public function viewCart($css, $js) {
            $this->renderView('cart', $css, $js, []);
        }

        public function handleUpdateCart() {
            $productData = json_decode(file_get_contents('php://input'), true);
            $index = $productData['index'];
            $quantity = $productData['quantity'];

            // Cập nhật lại số lượng
            if ($quantity > 0 && isset($_SESSION['cart'][$index])) {
                $_SESSION['cart'][$index]['quantity'] = $quantity;
            }

            $cart = $_SESSION['cart'];

            // Tính lại thành tiền
            $itemTotal = $cart[$index]['quantity'] * $cart[$index]['price'];

            // Tính lại tổng tiền
            $grandTotal = array_reduce($cart, function($total, $item) {
                return $total + ($item['quantity'] * $item['price']);
            }, 0);

            // Lấy số lượng sản phẩm có trong giỏ hàng
            $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));

            // Phản hồi dữ liệu về cho frontend
            echo json_encode([
                'itemTotal' => $itemTotal,
                'grandTotal' => $grandTotal,
                'cartQuantity' => $cartQuantity
            ]);
        }

        public function handleDeleteCart() {
            if (isset($_GET['index'])) {
                $index = $_GET['index'];
                
                // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
                if (isset($_SESSION['cart'][$index])) {
                    unset($_SESSION['cart'][$index]); // Xóa sản phẩm khỏi giỏ hàng
                }
                
                // Chuyển hướng lại trang giỏ hàng
                echo '<script>window.location.href = "index.php?page=cart";</script>';
            }
        }        
    }
?>
