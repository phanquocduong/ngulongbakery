<?php
    use PHPMailer\PHPMailer\PHPMailer;

    class UserController {
        private $category;
        private $user;
        private $order;
        private $product;
        private $mailController;

        public function __construct() {
            $this->category = new CategoryModel();
            $this->user = new UserModel();
            $this->order = new OrderModel();
            $this->product = new ProductModel();
            $this->mailController = new MailController();
        }

        private function renderView($view, $css, $js, $data = null, $numberPages = null) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1");
            require_once 'app/view/template.php';
        }

        public function viewRegister($css, $js) {
            $this->renderView('register', $css, $js);
        }

        public function handleRegister($base_url, $css, $js) {
            $fullname = trim($_POST['lastname']) . ' ' . trim($_POST['firstname']);
            $password = trim($_POST['password']);
            $repassword = trim($_POST['repassword']);
            $email = trim($_POST['email']);

            $errors = [];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ!";
            }
            if ($password !== $repassword) {
                $errors['repassword'] = "Mật khẩu nhập lại không đúng!";
            }
            if ($this->user->getUserByEmail($email)) {
                $errors['email'] = "Tài khoản đã tồn tại, vui lòng nhập email khác!";
            }
            if (!empty($errors)) {
                $_SESSION['register-error'] = $errors;
                $this->renderView('register', $css, $js);
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Tạo chuỗi mã ngẫu nhiên
            $verificationCode = bin2hex(random_bytes(32)); 

            $result = $this->user->register($fullname, $email, $hashedPassword, $verificationCode);

            if ($result) {
                $this->mailController->sendVerificationEmail($email, $verificationCode);
                $_SESSION['info'] = "Vui lòng kiểm tra email để xác thực tài khoản";
                header("Location: $base_url/login");
                exit;
            } else {
                $_SESSION['error']['unknown'] = "Có lỗi xảy ra. Vui lòng thử lại!";
                $this->renderView('register', $css, $js);
            }
        }   

        public function verify($base_url) {
            $code = $_GET['code'] ?? '';
            if ($this->user->verify($code)) {
                $_SESSION['success'] = "Đăng ký thành công!";
                header("Location: $base_url/login");
                exit;
            } else {
                echo "Liên kết xác minh không hợp lệ hoặc đã hết hạn.";
            }
        }

        public function viewLogin($base_url, $css, $js) {
            $this->autoLogin($base_url);
            $this->renderView('login', $css, $js);
        }

        public function handleLogin($base_url, $css, $js) {
            $email = trim($_POST['customerEmail']);
            $password = trim($_POST['customerPassword']);
            $rememberMe = isset($_POST['rememberMe']) ? true : false;
            
            $user = $this->user->getUserByEmail($email);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;

                if ($rememberMe) {
                    // Tạo chuỗi dữ liệu lưu trữ trong cookie
                    $cookieValue = base64_encode(json_encode(['email' => $email, 'password' => $password]));
                    // Thiết lập cookie, hạn 30 ngày
                    setcookie('rememberMe', $cookieValue, time() + (30 * 24 * 60 * 60), "/");
                }

                if (isset($_SESSION['redirectto'])){
                    header("Location: $_SESSION[redirectto]");
                    unset($_SESSION['redirectto']);
                } else {
                    if ($_SESSION['user']['role_id'] == 1) {
                        header("Location: $base_url/admin");
                        exit;
                    } else {
                        header("Location: $base_url");
                        exit;
                    }
                }
            } else {
                $_SESSION['login-error'] = "Thông tin đăng nhập không hợp lệ.";
                $this->renderView('login', $css, $js);
            }
        }

        public function autoLogin($base_url) {
            if (isset($_COOKIE['rememberMe'])) {
                // Giải mã dữ liệu cookie
                $cookieData = json_decode(base64_decode($_COOKIE['rememberMe']), true);
        
                $email = $cookieData['email'];
                $password = $cookieData['password'];
        
                $user = $this->user->getUserByEmail($email);
        
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    if (isset($_SESSION['redirectto'])){
                        header("Location: $_SESSION[redirectto]");
                        unset($_SESSION['redirectto']);
                    } else {
                        if ($_SESSION['user']['role_id'] == 1) {
                            header("Location: $base_url/admin");
                            exit;
                        } else {
                            header("Location: $base_url");
                            exit;
                        }
                    }
                }
            }
        }

        public function handleForgotPassword($base_url, $css, $js) {
            $email = trim($_POST['email']);
            $user = $this->user->getUserByEmail($email);

            if ($user) {
                $resetCode = bin2hex(random_bytes(32));
                $this->user->saveResetCode($email, $resetCode);
                $this->mailController->sendResetPasswordEmail($email, $resetCode);

                $_SESSION['info'] = "Vui lòng kiểm tra email của bạn để đặt lại mật khẩu.";
                header("Location: $base_url/login");
                exit;
            } else {
                $_SESSION['forgot-error'] = "Thông tin tài khoản không hợp lệ.";
                $this->renderView('login', $css, $js);
            }
        }

        public function viewResetPassword($css, $js) {
            $this->renderView('change-password', $css, $js);
        }

        public function handleResetPassword($base_url, $css, $js) {
            $resetCode = $_POST['resetCode'];
            $newPassword = trim($_POST['resetPassword']);
            $confirmPassword = trim($_POST['confirmResetPassword']);
        
            if ($newPassword !== $confirmPassword) {
                $data['resetCode'] = $resetCode;
                $_SESSION['reset-error'] = "Mật khẩu không khớp!";
                $this->renderView('change-password', $css, $js, $data);
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                if ($this->user->resetPassword($resetCode, $hashedPassword)) {
                    $_SESSION['success'] = "Mật khẩu đã được đặt lại thành công!";
                    header("Location: $base_url/login");
                    exit;
                } else {
                    $_SESSION['reset-error'] = "Mã xác thực không hợp lệ hoặc đã hết hạn.";
                    $this->renderView('change-password', $css, $js);
                }
            }
        }        

        public function logout($base_url) {
            unset($_SESSION['user']);
            setcookie('rememberMe', '', time() - 3600, '/');
            header("Location: $base_url");
            exit;
        }

        public function viewAccount($css, $js) {
            $userId = $_SESSION['user']['id'];
            $data['favorite'] = $this->product->getProductOfFavorite($userId);
            $this->renderView('account', $css, $js, $data);
        }

        public function handleUpdateInformation($base_url) {
            $fullname = trim($_POST['fullname']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);

            if ($_FILES['avatar']['name'] != '') {
                $avatar = time() . '_' . $_FILES['avatar']['name'];
                $targetFilePath = './public/upload/avatar/' . $avatar;
                // Kiểm tra loại file và kích thước
                $allowedTypes = ['image/jpeg', 'image/png'];
                if (!in_array($_FILES['avatar']['type'], $allowedTypes)) {
                    $_SESSION['error'] = "Chỉ hỗ trợ file ảnh PNG và JPEG!";
                    header("Location: $base_url/account");
                    exit;
                }
                if ($_FILES['avatar']['size'] > 5000000) {  // 5MB
                    $_SESSION['error'] = "Kích thước file quá lớn! Vui lòng chọn ảnh nhỏ hơn 5MB.";
                    header("Location: $base_url/account");
                    exit;
                }
            } else {
                $avatar = time() . '_' . $_SESSION['user']['avatar'];
            }

            $result = $this->user->updateInformation($_SESSION['user']['id'], $fullname, $phone, $address, $avatar);

            // Xử lý upload ảnh
            if ($result) {
                $uploadSuccess = true;
                if ($_FILES['avatar']['name'] != '') {
                    $uploadSuccess &= move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath);
                    if ($_SESSION['user']['avatar'] != 'default-avatar.jpg') {
                        $oldAvatarFile = './public/upload/avatar/'.$_SESSION['user']['avatar'];
                        $uploadSuccess &= unlink($oldAvatarFile);
                    }
                }
                if ($uploadSuccess) {
                    // Cập nhật lại thông tin của session user
                    $_SESSION['user']['full_name'] = $fullname;
                    $_SESSION['user']['phone'] = $phone;
                    $_SESSION['user']['address'] = $address;
                    $_SESSION['user']['avatar'] = $avatar;

                    $_SESSION['success'] = "Cập nhật thông tin thành công";
                    header("Location: $base_url/account");
                    exit;
                } else {
                    $_SESSION['error'] = "Có lỗi khi tải lên hình ảnh. Vui lòng thử lại sau!";
                    header("Location: $base_url/account");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Có lỗi không mong muốn xảy ra. Vui lòng thử lại sau!";
                header("Location: $base_url/account");
                exit;
            }
        }

        public function viewChangePassword($css, $js) {
            $this->renderView('change-password', $css, $js);
        }

        public function handleChangePassword($base_url, $css, $js) {
            $currentPassword = trim($_POST['currentPassword']);

            if (password_verify($currentPassword, $_SESSION['user']['password'])) {
                $newPassword = trim($_POST['newPassword']);
                $confirmPassword = trim($_POST['confirmNewPassword']);

                if ($newPassword != $confirmPassword) {
                    $_SESSION['change-error'] = "Mật khẩu nhập lại không khớp!";
                    $this->renderView('change-password', $css, $js);
                } else {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    
                    if ($this->user->changePassword($_SESSION['user']['id'], $hashedPassword)) {
                        $_SESSION['success'] = "Mật khẩu đã được cập nhật thành công!";
                        header("Location: $base_url/account");
                        exit;
                    } else {
                        $_SESSION['change-error'] = "Có lỗi xảy ra, vui lòng thử lại";
                        $this->renderView('change-password', $css, $js);
                    }
                }
            } else {
                $_SESSION['change-error'] = "Mật khẩu hiện tại không đúng!";
                $this->renderView('change-password', $css, $js);
            }
        }        
    }
?>