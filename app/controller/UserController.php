<?php
    class UserController {
        private $user;
        private $category;

        function __construct() {
            $this->user = new UserModel();
            $this->category = new CategoryModel();
        }

        private function renderView($view, $css, $js, $data = null) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm'", [], 'display_order ASC');
            require_once 'app/view/header.php';
            $viewPath = 'app/view/' . $view . '.php';
            require_once $viewPath;
            require_once 'app/view/footer.php';
        }

        public function viewRegister($css, $js) {
            $this->renderView('register', $css, $js);
        }

        public function handleRegister($css, $js) {
            $fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
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
                $result = $this->user->register($fullname, $email, $hashedPassword);
                if ($result) {
                    echo '<script>alert("Đăng ký thành công")</script>';
                    echo '<script>window.location.href = "index.php";</script>';
                } else {
                    $_SESSION['error']['unknown'] = "Có lỗi xảy ra. Vui lòng thử lại!";
                    $this->renderView('register', $css, $js);
                }
            }
        }
    }
?>