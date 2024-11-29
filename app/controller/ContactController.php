<?php
    use PHPMailer\PHPMailer\PHPMailer;

    class ContactController {
        private $category;  
        private $mailController;

        function __construct() {
            $this->category = new CategoryModel();
            $this->mailController = new MailController();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        public function viewContact($css, $js) {
            $this->renderView('contact', $css, $js);
        }

        public function handleContact($base_url) {
            $emailuser = $_POST['email'];
            $username = $_POST['name'];
            $optionuser = $_POST['select-fix'];
            $comments = $_POST['comments'];
            $this->mailController->sendContactEmail($emailuser, $username, $optionuser, $comments);
            $_SESSION['success'] = "Chúng tôi sẽ cố gắng liên hệ lại với bạn trong thời gian sớm nhất!";
            header("Location: $base_url/contact");
            exit;
        }
    }
?>
