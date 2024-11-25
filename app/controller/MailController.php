<?php
    use PHPMailer\PHPMailer\PHPMailer;

    class MailController {
        private $mailer;

        public function __construct() {
            $this->mailer = new PHPMailer(true);
            $this->mailer->CharSet = 'UTF-8';
            $this->configureSMTP();
        }

        private function configureSMTP() {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.gmail.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'ngulongbakery@gmail.com'; // Thay bằng email thật
            $this->mailer->Password = 'guca wcef owki vocr'; // Thay bằng mật khẩu ứng dụng
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = 587;
        }

        private function renderEmailView($view, $data) {
            extract($data);
            ob_start();
            include "app/view/emails/$view.php";
            return ob_get_clean();
        }

        public function sendVerificationEmail($email, $code) {
            try {
                $this->mailer->setFrom('ngulongbakery@gmail.com', 'Ngũ Long Bakery');
                $this->mailer->addAddress($email);
                $this->mailer->isHTML(true);
                $this->mailer->Subject = "Xác thực Email của bạn";

                $this->mailer->Body = $this->renderEmailView('email-verification', compact('code'));

                $this->mailer->send();
            } catch (Exception $e) {
                echo "Không thể gửi email. Lỗi gửi thư: {$mail->ErrorInfo}";
            }
        }

        public function sendResetPasswordEmail($email, $resetCode) {
            try {
                $this->mailer->setFrom('ngulongbakery@gmail.com', 'Ngũ Long Bakery');
                $this->mailer->addAddress($email);
                $this->mailer->isHTML(true);
                $this->mailer->Subject = "Yêu cầu đặt lại mật khẩu";

                $this->mailer->Body = $this->renderEmailView('reset-password', compact('resetCode'));

                $this->mailer->send();
            } catch (Exception $e) {
                echo "Không thể gửi email. Lỗi gửi thư: {$mail->ErrorInfo}";
            }
        }

        public function sendContactEmailForCustomer($email, $username, $option, $comments) {
            try {
                $this->mailer->setFrom('ngulongbakery@gmail.com', 'Ngũ Long Bakery');
                $this->mailer->addAddress($email);
                $this->mailer->isHTML(true);
                $this->mailer->Subject = "[ Ngũ long bakery ] Cảm ơn bạn đã liên hệ!";

                $this->mailer->AddEmbeddedImage('public/upload/logo/logo.png', 'logo_cid');
                $this->mailer->Body = $this->renderEmailView('contact-email-for-customer', compact('email', 'username', 'option', 'comments'));

                $this->mailer->send();
            } catch (Exception $e) {
                echo "Không thể gửi email. Lỗi gửi thư: {$mail->ErrorInfo}";
            }
        }

        public function sendCustomerEmailOfOrder($fullname, $email, $address, $phone, $method, $total, $discount, $transportFee, $note, $orderDetails) {
            try {
                $this->mailer->setFrom('ngulongbakery@gmail.com', 'Ngũ Long Bakery');
                $this->mailer->addAddress($email); // Gửi tới email khách hàng
                $this->mailer->isHTML(true);
                $this->mailer->Subject = "Hóa đơn đặt hàng từ Ngũ Long Bakery";
    
                $this->mailer->Body = $this->renderEmailView('success-order-for-customer', compact(
                    'fullname', 'address', 'phone', 'method', 'total', 'discount', 'transportFee', 'note', 'orderDetails'
                ));        
    
                $this->mailer->send();
            } catch (Exception $e) {
                echo "Lỗi khi gửi email cho khách hàng: {$this->mailer->ErrorInfo}";
            }
        }

        public function sendAdminEmailOfOrder($fullname, $email, $address, $phone, $method, $total, $discount, $transportFee, $note, $orderDetails) {
            try {
                $this->mailer->clearAddresses();
                $this->mailer->addAddress('ngulongbakery@gmail.com'); // Gửi tới admin
                $this->mailer->isHTML(true);
                $this->mailer->Subject = "Thông báo đơn hàng mới từ Ngũ Long Bakery";
    
                $this->mailer->Body = $this->renderEmailView('success-order-for-admin', compact(
                    'fullname', 'email', 'address', 'phone', 'method', 'total', 'discount', 'transportFee', 'note', 'orderDetails'
                ));  
    
                $this->mailer->send();
            } catch (Exception $e) {
                echo "Lỗi khi gửi email cho admin: {$this->mailer->ErrorInfo}";
            }
        }
    }
?>