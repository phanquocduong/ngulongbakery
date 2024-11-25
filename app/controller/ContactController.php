<?php
    use PHPMailer\PHPMailer\PHPMailer;

    class ContactController {
        private $category;
        private $emailsend;
        private $mailController;

        function __construct() {
            $this->category = new CategoryModel();
            $this->emailsend = new GetlayoutEmail();
            $this->mailController = new MailController();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        public function viewContact($css, $js) {
            $this->renderView('contact', $css, $js);
        }

        public function handleContact() {
            $emailuser = $_POST['email'];
            $username = $_POST['name'];
            $optionuser = $_POST['select-fix'];
            $comments = $_POST['comments'];
            $this->mailController->sendContactEmailForCustomer($emailuser, $username, $optionuser, $comments);
            $_SESSION['success'] = "Chúng tôi sẽ cố gắng liên hệ lại với bạn trong thời gian sớm nhất!";
            header("Location: index.php?page=contact");
            exit;
        }
    }
?>
