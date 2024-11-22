<?php
    use PHPMailer\PHPMailer\PHPMailer;

    class PaymentController{
        private $category;
        private $location;
        private $discount;
        private $order;

        function __construct() {
            $this->category = new CategoryModel();
            $this->location = new LocationModel();
            $this->discount = new DiscountModel();
            $this->order = new OrderModel();
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

                    echo json_encode([
                        'success' => true,
                        'message' => "Áp dụng thành công! Bạn được giảm " . $discountValue . "%.",
                        'newTotal' => $newTotal,
                        'discountId' => $coupon['id']
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => "Mã giảm giá không hợp lệ hoặc đã hết hạn!"
                    ]);
                }
            }
        }

        public function handlePayment() {
            $idClient = $_SESSION['user']['id'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $ward = $this->location->getWard($_POST['ward']);
            $district = $this->location->getDistrict($_POST['district']);
            $province = $this->location->getProvince($_POST['province']);
            $address = $_POST['address'] . ', ' . $ward['name'] . ', ' . $district['name'] . ', ' . $province['name'];
            $method = $_POST['method'];
            $total = $_POST['total'];
            $note = $_POST['note'] ?? "";
            $discount = $this->discount->getDiscount($_POST['discount-id']);
            $transportFee = $_POST['transport-fee'];
            $orderId = $this->order->createOrder($idClient, $fullname, $email, $phone, $address, $total, $method, $note, $discount['id']);
        
            if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
                $orderDetails = ""; // Chuỗi để tạo thông tin sản phẩm trong hóa đơn
                foreach ($_SESSION['cart'] as $item) {
                    $this->order->createOrderDetails($orderId, $item['price'], $item['quantity'], $item['name'], $item['image']);
                    $lineTotal = $item['price'] * $item['quantity'];
                    $orderDetails .= "
                        <tr>
                            <td>{$item['name']}</td>
                            <td>{$item['quantity']}</td>
                            <td>" . number_format($item['price']) . "đ</td>
                            <td>" . number_format($lineTotal) . "đ</td>
                        </tr>
                    ";
                }
        
                // Gửi email hóa đơn
                $this->sendEmailOrder($fullname, $email, $address, $phone, $method, $total, $discount['discount_value'], $transportFee, $note, $orderDetails);
        
                unset($_SESSION['cart']);
                if (isset($_SESSION['discount_applied'])) {
                    unset($_SESSION['discount_applied']);
                }
        
                echo '<script>alert("Đặt hàng thành công, vui lòng kiểm tra email!")</script>';
                // echo '<script>window.location.href = "index.php";</script>';
            }
        }
        
        public function sendEmailOrder($fullname, $email, $address, $phone, $method, $total, $discount, $transportFee, $note, $orderDetails) {
            $adminEmail = 'ngulongbakery@gmail.com';
            $subject = "Hóa đơn đặt hàng từ Ngũ Long Bakery";
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
        
            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username = 'ngulongbakery@gmail.com';
                $mail->Password = 'guca wcef owki vocr';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
        
                // Nội dung email cho khách hàng
                $htmlContent = "
                    <h2>Hóa đơn đặt hàng từ Ngũ Long Bakery</h2>
                    <p>Xin chào <strong>$fullname</strong>,</p>
                    <p>Cảm ơn bạn đã đặt hàng tại Ngũ Long Bakery. Dưới đây là thông tin đơn hàng của bạn:</p>
                    <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            $orderDetails
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='3' style='text-align: right;'><strong>Phí vận chuyển:</strong></td>
                                <td><strong>" . $transportFee . "</strong></td>
                            </tr>
                            <tr>
                                <td colspan='3' style='text-align: right;'><strong>Giảm giá:</strong></td>
                                <td><strong>" . ($discount ? $discount . '%' : '') . "</strong></td>
                            </tr>
                            <tr>
                                <td colspan='3' style='text-align: right;'><strong>Tổng cộng:</strong></td>
                                <td><strong>" . number_format($total) . "đ</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <p><strong>Địa chỉ giao hàng:</strong> $address</p>
                    <p><strong>Số điện thoại:</strong> $phone</p>
                    <p><strong>Phương thức thanh toán:</strong> $method</p>
                    " . ($note ? "<p><strong>Ghi chú:</strong> $note</p>" : "") . "
                    <p>Cảm ơn bạn đã tin tưởng chúng tôi!</p>
                ";
        
                // Gửi email cho khách hàng
                $mail->setFrom('ngulongbakery@gmail.com', 'Ngũ Long Bakery');
                $mail->addAddress($email); // Email khách hàng
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $htmlContent;
                $mail->send();
        
                // Gửi email cho admin
                $mail->clearAddresses();
                $mail->addAddress($adminEmail); // Email admin
                $mail->Subject = "Thông báo đơn hàng mới từ Ngũ Long Bakery";
                $mail->Body    = "
                    <h2>Thông báo đơn hàng mới</h2>
                    <p>Có đơn hàng mới từ khách hàng:</p>
                    <p><strong>Tên:</strong> $fullname</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Số điện thoại:</strong> $phone</p>
                    <p><strong>Địa chỉ:</strong> $address</p>
                    <p><strong>Phương thức thanh toán:</strong> $method</p>
                    <p><strong>Tổng cộng:</strong> " . number_format($total) . "đ</p>
                    <h3>Chi tiết đơn hàng:</h3>
                    $htmlContent
                ";
                $mail->send();
        
            } catch (Exception $e) {
                echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
            }
        }        
        
    }
?>