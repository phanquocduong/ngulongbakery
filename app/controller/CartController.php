<?php
    class CartController {
        private $category;

        function __construct() {
            $this->category = new CategoryModel();
        }

        // Đảm bảo tham số không bắt buộc được khai báo sau tham số bắt buộc
        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm'", []);
            require_once 'app/view/header.php';
            $viewPath = 'app/view/' . $view . '.php';
            require_once $viewPath;
            require_once 'app/view/footer.php';
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
                $_SESSION['cart'][$productId]['quantity'] += $productData['quantity'];
            } else {
                $_SESSION['cart'][$productId] = [
                    'id' => $productId,
                    'name' => $productData['name'],
                    'price' => $productData['price'],
                    'image' => $productData['image'],
                    'quantity' => $productData['quantity'],
                ];
            }
            
            // Tính số lượng sản phẩm trong giỏ hàng
            $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
            
            // Phản hồi về số lượng giỏ hàng mới
            echo json_encode(['success' => true, 'cartQuantity' => $cartQuantity]);
        }

        public function viewCart($css, $js) {
            // Thêm tham số đúng thứ tự
            $this->renderView('cart', $css, $js, []);
        }

        public function handleUpdateCart() {
            if (isset($_POST['index']) && isset($_POST['quantity'])) {
                $index = (int)$_POST['index'];
                $quantity = (int)$_POST['quantity'];
                if ($quantity > 0 && isset($_SESSION['cart'][$index])) {
                    $_SESSION['cart'][$index]['quantity'] = $quantity;
                }

                $cart = $_SESSION['cart'];
                $itemTotal = $cart[$index]['quantity'] * $cart[$index]['price'];
                $grandTotal = array_reduce($cart, function($total, $item) {
                    return $total + ($item['quantity'] * $item['price']);
                }, 0);
                $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));

                echo json_encode([
                    'itemTotal' => $itemTotal,
                    'grandTotal' => $grandTotal,
                    'cartQuantity' => $cartQuantity
                ]);
            }
            exit;
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
