<?php
    class CartController {
        private $category;
        private $product;

        function __construct() {
            $this->category = new CategoryModel();
            $this->product = new ProductModel();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1");
            require_once 'app/view/template.php';
        }

        public function handleAddToCart() {
            if (empty($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $productData = json_decode(file_get_contents('php://input'), true);
            $productId = $productData['id'];
            $quantity = $productData['quantity'];
        
            $product = $this->product->getProduct($productId);
        
            if (!$product) {
                echo json_encode(['success' => false]);
                return;
            }
        
            if (isset($_SESSION['cart'][$productId])) {
                $newQuantity = min($_SESSION['cart'][$productId]['quantity'] + $quantity, $_SESSION['cart'][$productId]['stock']);
                $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
            } else {
                $_SESSION['cart'][$productId] = [
                    'id' => $productId,
                    'name' => $product['name'],
                    'price' => $product['sale'] ?? $product['price'],
                    'image' => $product['image'],
                    'quantity' => min($quantity, $product['stock_quantity']),
                    'stock' => $product['stock_quantity']
                ];
            }
        
            $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
        
            echo json_encode(['success' => true, 'cartQuantity' => $cartQuantity]);
        }
        

        public function viewCart($css, $js) {
            $this->renderView('cart', $css, $js, []);
        }

        public function handleUpdateCart() {
            $productData = json_decode(file_get_contents('php://input'), true);
            $index = $productData['index'];
            $quantity = $productData['quantity'];

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

        public function handleDeleteCart($base_url) {
            if (isset($_GET['index'])) {
                $index = $_GET['index'];
                
                if (isset($_SESSION['cart'][$index])) {
                    unset($_SESSION['cart'][$index]);
                }
                
                $_SESSION['success'] = "Xoá sản phẩm khỏi giỏ hàng thành công";
                header("Location: $base_url/cart");
                exit;
            }
        }        
    }
?>
