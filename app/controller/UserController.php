<?php

use PHPMailer\PHPMailer\PHPMailer;

class UserController
{
    private $category;
    private $user;
    private $order;
    private $favorite_products;
    private $emailsend;
    public function __construct()
    {
        $this->emailsend = new GetlayoutEmail();
        $this->category = new CategoryModel();
        $this->user = new UserModel();
        $this->order = new OrderModel();
        $this->favorite_products = new FavoriteProductsModel();
        $this->autoLogin();
    }

    private function renderView($view, $css, $js, $data = null, $numberPages = null)
    {
        $categories = $this->category->getCategories("WHERE type = 'Sản phẩm'", []);
        require_once 'app/view/header.php';
        $viewPath = 'app/view/' . $view . '.php';
        require_once $viewPath;
        require_once 'app/view/footer.php';
    }

    public function viewRegister($css, $js)
    {
        $this->renderView('register', $css, $js);
    }

    public function handleRegister($css, $js)
    {
        $fullname = $_POST['lastname'] . ' ' . $_POST['firstname'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $email = $_POST['email'];
        if ($password !== $repassword) {
            $_SESSION['error']['repassword'] = "Mật khẩu nhập lại không đúng!";
        }
        $checkMail = $this->user->checkMail($email);
        if ($checkMail) {
            $_SESSION['error']['email'] = "Email đã tồn tại, vui lòng nhập email khác!";
        }
        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            $this->renderView('register', $css, $js);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $verificationCode = bin2hex(random_bytes(32));
            $result = $this->user->register($fullname, $email, $hashedPassword, $verificationCode);
            if ($result) {
                $this->sendVerificationEmail($email, $verificationCode);
                echo '<script>alert("Đăng ký thành công, vui lòng check email để xác thực tài khoản.")</script>';
                echo '<script>window.location.href = "index.php?page=login";</script>';
            } else {
                $_SESSION['error']['unknown'] = "Có lỗi xảy ra. Vui lòng thử lại!";
                $this->renderView('register', $css, $js);
            }
        }
    }

    private function sendVerificationEmail($email, $code)
    {
        $mail = new PHPMailer(true);
        /*   dang ky  */
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ngulongbakery@gmail.com';
            $mail->Password = 'guca wcef owki vocr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('ngulongbakery@gmail.com', 'Ngu Long Bakery');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Verify your email';
            /*  lấy layout gửi về mail */
            $mail->Body = $this->emailsend->emailcheckout(
                'regitster-fogot-mail',
                [
                    'Send_user' => 'user_register',
                    'code' => $code
                ]
            );
            $mail->send();
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi gửi thư: {$mail->ErrorInfo}";
        }
    }

    public function verify()
    {
        $code = $_GET['code'] ?? '';

        if ($this->user->verify($code)) {
            echo '<script>alert("Email đã được xác minh thành công.")</script>';
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            echo "Liên kết xác minh không hợp lệ hoặc đã hết hạn.";
        }
    }

    public function viewLogin($css, $js)
    {
        $this->renderView('login', $css, $js);
    }

    public function handleLogin($css, $js)
    {
        $email = $_POST['customerEmail'];
        $password = $_POST['customerPassword'];
        $rememberMe = isset($_POST['rememberMe']) ? true : false;

        // Lấy thông tin người dùng từ cơ sở dữ liệu theo email
        $user = $this->user->getUserByEmail($email);

        // Kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            echo '<script>alert("Đăng nhập thành công")</script>';
            $_SESSION['user'] = $user;
            // Nếu chọn "Nhớ mật khẩu"
            if ($rememberMe) {
                // Tạo chuỗi dữ liệu lưu trữ trong cookie
                $cookieValue = base64_encode(json_encode(['email' => $email, 'password' => $password]));
                // Thiết lập cookie, hạn 30 ngày
                setcookie('rememberMe', $cookieValue, time() + (30 * 24 * 60 * 60), "/");
            }
            if (isset($_SESSION['redirectto'])) {
                header("Location: $_SESSION[redirectto]");
                unset($_SESSION['redirectto']);
            } else {
                if ($_SESSION['user']['role_id'] == 1) {
                    echo '<script>window.location.href = "admin/index.php";</script>';
                } else {
                    echo '<script>window.location.href = "index.php";</script>';
                }
            }
        } else {
            $_SESSION['error'] = "Thông tin đăng nhập không hợp lệ.";
            $this->renderView('login', $css, $js);
        }
    }

    public function autoLogin()
    {
        if (isset($_COOKIE['rememberMe'])) {
            // Giải mã dữ liệu cookie
            $cookieData = json_decode(base64_decode($_COOKIE['rememberMe']), true);

            $email = $cookieData['email'];
            $password = $cookieData['password'];

            // Lấy thông tin người dùng từ cơ sở dữ liệu
            $user = $this->user->getUserByEmail($email);

            // Kiểm tra mật khẩu
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                // Điều hướng đến trang phù hợp
                if ($_SESSION['user']['role_id'] == 1) {
                    echo '<script>window.location.href = "admin/index.php";</script>';
                } else {
                    echo '<script>window.location.href = "index.php";</script>';
                }
            }
        }
    }

    public function handleForgotPassword($css, $js)
    {
        $email = $_POST['email'];
        // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
        $user = $this->user->getUserByEmail($email);
        if ($user) {
            // Tạo mã xác thực để đặt lại mật khẩu
            $resetCode = bin2hex(random_bytes(32));
            // Lưu mã xác thực vào cơ sở dữ liệu (có thể trong bảng users)
            $this->user->saveResetCode($email, $resetCode);
            // Gửi email đặt lại mật khẩu
            $this->sendResetPasswordEmail($email, $resetCode);
            echo '<script>alert("Vui lòng kiểm tra email của bạn để đặt lại mật khẩu.")</script>';
            echo '<script>window.location.href = "index.php?page=login";</script>';
        } else {
            $_SESSION['error'] = "Email không tồn tại.";
            $this->renderView('login', $css, $js);
        }
    }

    private function sendResetPasswordEmail($email, $resetCode)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ngulongbakery@gmail.com';
            $mail->Password = 'guca wcef owki vocr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('ngulongbakery@gmail.com', 'Ngu Long Bakery');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset password';
            $mail->Body = "Click <a href='localhost/ngulongbakery/index.php?page=reset-password&code=$resetCode'>here</a> to reset your password.";
            /*  lấy layout gửi về mail */
            $mail->Body = $this->emailsend->emailcheckout(
                'regitster-fogot-mail',
                [
                    'Send_user' => 'user_forgot',
                    'code' => $resetCode
                ]
            );
            $mail->send();
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi gửi thư: {$mail->ErrorInfo}";
        }
    }

    public function viewResetPassword($css, $js)
    {
        $this->renderView('reset-password', $css, $js);
    }

    public function handleResetPassword($css, $js)
    {
        $resetCode = $_POST['resetCode'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = "Mật khẩu không khớp!";
            $this->renderView('reset-password', $css, $js);
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            if ($this->user->resetPassword($resetCode, $hashedPassword)) {
                echo '<script>alert("Mật khẩu đã được cập nhật thành công.")</script>';
                echo '<script>window.location.href = "index.php?page=login";</script>';
            } else {
                $_SESSION['error'] = "Mã xác thực không hợp lệ hoặc đã hết hạn.";
                $this->renderView('reset-password', $css, $js);
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        setcookie('rememberMe', '', time() - 3600, '/');
        echo '<script>window.location.href = "index.php";</script>';
    }

    public function viewAccount($css, $js)
    {
        $userId = $_SESSION['user']['id'];
        $num = $_GET['num'] ?? 1;
        $start = ($num - 1) * 5;
        $data['orders'] = $this->order->getOrders('WHERE user_id = ?', [$userId], 'id DESC', $start, 5);

        foreach ($data['orders'] as &$item) { // Dùng tham chiếu (&) để thay đổi trực tiếp trong mảng
            $item['details'] = $this->order->getOrderDetails($item['id']);
        }

        $quantity = $this->order->getOrderCount('WHERE user_id = ?', [$userId]);
        $numberPages = ceil($quantity / 5);

        $data['favorite'] = $this->favorite_products->getProductOfFavorite($userId);

        $this->renderView('account', $css, $js, $data, $numberPages);
    }

    public function handleUpdateInformation()
    {
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        if ($_FILES['avatar']['name'] != '') {
            $avatar = time() . '_' . $_FILES['avatar']['name'];
            $targetFilePath = './public/upload/avatar/' . $avatar;
            // Kiểm tra loại file và kích thước
            $allowedTypes = ['image/jpeg', 'image/png'];
            if (!in_array($_FILES['avatar']['type'], $allowedTypes)) {
                echo '<script>alert("Chỉ hỗ trợ file ảnh PNG và JPEG!")</script>';
                return;
            }
            if ($_FILES['avatar']['size'] > 5000000) {  // 5MB
                echo '<script>alert("Kích thước file quá lớn! Vui lòng chọn ảnh nhỏ hơn 5MB.")</script>';
                return;
            }
        } else {
            $avatar = $_SESSION['user']['avatar'];
        }
        $result = $this->user->updateInformation($_SESSION['user']['id'], $fullname, $phone, $address, $avatar);
        if ($result) {
            $uploadSuccess = true;
            if ($_FILES['avatar']['name'] != '') {
                $uploadSuccess &= move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath);
                $oldAvatarFile = './public/upload/avatar/' . $_SESSION['user']['avatar'];
                $uploadSuccess &= unlink($oldAvatarFile);
            }
            if ($uploadSuccess) {
                $_SESSION['user']['full_name'] = $fullname;
                $_SESSION['user']['phone'] = $phone;
                $_SESSION['user']['address'] = $address;
                $_SESSION['user']['avatar'] = $avatar;
                echo '<script>alert("Cập nhật thông tin thành công")</script>';
                echo '<script>window.location.href = "index.php?page=account";</script>';
            } else {
                echo '<script>alert("Có lỗi khi tải lên hình ảnh. Vui lòng thử lại sau!")</script>';
                echo '<script>window.location.href = "index.php?page=account";</script>';
            }
        } else {
            echo '<script>alert("Có lỗi không mong muốn xảy ra. Vui lòng thử lại sau!")</script>';
            echo '<script>window.location.href = "index.php?page=account";</script>';
        }
    }

    public function viewChangePassword($css, $js)
    {
        $this->renderView('change-password', $css, $js);
    }

    public function handleChangePassword($css, $js)
    {
        $currentPassword = $_POST['currentPassword'];
        if (password_verify($currentPassword, $_SESSION['user']['password'])) {
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Mật khẩu không khớp!";
                $this->renderView('change-password', $css, $js);
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                if ($this->user->changePassword($_SESSION['user']['id'], $hashedPassword)) {
                    echo '<script>alert("Mật khẩu đã được cập nhật thành công.")</script>';
                    echo '<script>window.location.href = "index.php?page=account";</script>';
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại";
                    $this->renderView('change-password', $css, $js);
                }
            }
        } else {
            $_SESSION['error'] = "Mật khẩu hiện tại không đúng!";
            $this->renderView('change-password', $css, $js);
        }
    }
}
