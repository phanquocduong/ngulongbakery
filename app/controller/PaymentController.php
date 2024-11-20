<?php
    class PaymentController{
        private $category;
        private $location;
        private $discount;

        function __construct() {
            $this->category = new CategoryModel();
            $this->location = new LocationModel();
            $this->discount = new DiscountModel();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm'", []);
            require_once 'app/view/header.php';
            $viewPath = 'app/view/' . $view . '.php';
            require_once $viewPath;
            require_once 'app/view/footer.php';
        }

        public function viewPayment($css, $js) {
            if (!isset($_SESSION['user'])) {
                $_SESSION['redirectto'] = $_SERVER['REQUEST_URI'];
                header("Location: index.php?page=login");
            } else {
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
            if (isset($_POST['code'])) {
                $code = $_POST['code'];
                $grandTotal = $_POST['total'];
                $currentDate = date('Y-m-d');

                if (isset($_SESSION['discount_applied']) && $_SESSION['discount_applied'] === true) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Mã giảm giá đã được áp dụng. Không thể nhập lại!'
                    ]);
                    return;
                }        

                $coupon = $this->discount->validateCoupon($code, $grandTotal, $currentDate);
        
                if ($coupon) {
                    $discountValue = $coupon['discount_value'];
                    $newTotal = $grandTotal - ($grandTotal * $discountValue / 100);

                    // Lưu trạng thái vào session
                    $_SESSION['discount_applied'] = true;
                    $_SESSION['discount_amount'] = $discountAmount;

                    echo json_encode([
                        'success' => true,
                        'message' => "Áp dụng thành công! Bạn được giảm " . $discountValue . "%.",
                        'newTotal' => $newTotal
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => "Mã giảm giá không hợp lệ hoặc đã hết hạn!"
                    ]);
                }
            }
        }
        
    }
?>