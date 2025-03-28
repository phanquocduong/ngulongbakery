<?php
    class PaymentController{
        private $category;
        private $location;
        private $discount;
        private $order;
        private $product;
        private $mailController;

        function __construct() {
            $this->category = new CategoryModel();
            $this->location = new LocationModel();
            $this->discount = new DiscountModel();
            $this->order = new OrderModel();
            $this->product = new ProductModel();
            $this->mailController = new MailController();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1");
            require_once 'app/view/template.php';
        }

        public function viewPayment($base_url, $css, $js) {
            if (!isset($_SESSION['user'])) {
                $_SESSION['redirectto'] = $_SERVER['REQUEST_URI'];
                header("Location: $base_url/login");
            } else {
                if (isset($_SESSION['discount_applied'])) {
                    unset($_SESSION['discount_applied']);
                }
                $data['provinces'] = $this->location->getProvinces();
                $this->renderView('payment', $css, $js, $data);
            }
        }

        public function handleGetDistricts() {
            if (isset($_GET['province_id'])) {
                echo json_encode($this->location->getDistricts($_GET['province_id']));
            }
        }

        public function handleGetWards() {
            if (isset($_GET['district_id'])) {
                echo json_encode($this->location->getWards($_GET['district_id']));
            }
        }

        public function handleApplyDiscount() {
            $inputData = json_decode(file_get_contents("php://input"), true);
        
            $code = isset($inputData['code']) ? trim($inputData['code']) : null;
            $provisionalPrice = isset($inputData['provisional']) ? $inputData['provisional'] : null;
        
            if (!$code || !$provisionalPrice) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ. Vui lòng thử lại!'
                ]);
                return;
            }
        
            $currentDate = date('Y-m-d');
        
            if (isset($_SESSION['discount_applied']) && $_SESSION['discount_applied'] == true) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Mã giảm giá đã được áp dụng. Không thể nhập lại!'
                ]);
                return;
            }
        
            $coupon = $this->discount->validateCoupon($code, $provisionalPrice, $currentDate);
        
            if ($coupon) {
                $discountValue = $coupon['discount_value'];
                $newProvisionalPrice = round($provisionalPrice - ($provisionalPrice * $discountValue / 100));
        
                $_SESSION['discount_applied'] = true;
        
                echo json_encode([
                    'success' => true,
                    'message' => "Áp dụng thành công! Bạn được giảm " . $discountValue . "%.",
                    'newProvisionalPrice' => $newProvisionalPrice,
                    'discountId' => $coupon['id']
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => "Mã giảm giá không hợp lệ hoặc đã hết hạn!"
                ]);
            }
        }
        

        public function handlePayment($base_url) {
            $idClient = $_SESSION['user']['id'];
            $fullname = trim($_POST['fullname']);
            $email = trim($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email không hợp lệ";
                header("Location: $base_url/payment");
                exit;
            }
            $phone = preg_replace('/\D/', '', trim($_POST['phone']));
            if (strlen($phone) < 10 || strlen($phone) > 11 || !ctype_digit($phone) || !preg_match('/^(03|05|07|08|09)\d+$/', $phone)) {
                $_SESSION['error'] = "Số điện thoại không hợp lệ";
                header("Location: $base_url/payment");
                exit;
            }
            $ward = $this->location->getWard($_POST['ward']);
            $district = $this->location->getDistrict($_POST['district']);
            $province = $this->location->getProvince($_POST['province']);
            $address = trim($_POST['address']) . ', ' . $ward['name'] . ', ' . $district['name'] . ', ' . $province['name'];
            $method = $_POST['method'];
            $total = $_POST['total'];
            $note = trim($_POST['note']) ?? "";
            $discount = $this->discount->getDiscount($_POST['discount-id']);
            $transportFee = $_POST['transport-fee'];
            
            $orderId = $this->order->createOrder($idClient, $fullname, $email, $phone, $address, $total, $method, $note, $discount['id']);
        
            if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
                $orderDetails = "";
                foreach ($_SESSION['cart'] as $item) {
                    $this->order->createOrderDetails($orderId, $item['price'], $item['quantity'], $item['name'], $item['image']);
                    $lineTotal = $item['price'] * $item['quantity'];
                    $orderDetails .= "
                        <tr>
                            <td style='text-align: left; padding: 10px; border: 1px solid #ddd;'>".$item['name']."</td>
                            <td style='text-align: center; padding: 10px; border: 1px solid #ddd;'>".$item['quantity']."</td>
                            <td style='text-align: right; padding: 10px; border: 1px solid #ddd;'>" . number_format($item['price'], 0, ',', '.') . "đ</td>
                            <td style='text-align: right; padding: 10px; border: 1px solid #ddd;'>" . number_format($lineTotal, 0, ',', '.') . "đ</td>
                        </tr>
                    ";
                    $this->product->updateSoldOfProduct($item['name'], $item['quantity']);
                    $this->product->updateStockQuantityOfProduct($item['name'], $item['quantity']);
                    if ($discount['usage_limit'] != null) {
                        $this->discount->updateUsageLimitOfDiscount($discount['id']);
                    }
                }
        
                // Gửi email hóa đơn
                $this->mailController->sendCustomerEmailOfOrder($fullname, $email, $address, $phone, $method, $total, $discount['discount_value'], $transportFee, $note, $orderDetails);
                $this->mailController->sendAdminEmailOfOrder($fullname, $email, $address, $phone, $method, $total, $discount['discount_value'], $transportFee, $note, $orderDetails);
        
                unset($_SESSION['cart']);
                if (isset($_SESSION['discount_applied'])) {
                    unset($_SESSION['discount_applied']);
                }
        
                $_SESSION['success'] = "Đặt hàng thành công, vui lòng kiểm tra email!";
                header("Location: $base_url");
                exit;
            }
        }
    }
?>