<?php

use PHPMailer\PHPMailer\PHPMailer;

class AdMailController
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->CharSet = 'UTF-8';
        $this->configureSMTP();
    }

    private function configureSMTP()
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'ngulongbakery@gmail.com'; // Thay bằng email thật
        $this->mailer->Password = 'guca wcef owki vocr'; // Thay bằng mật khẩu ứng dụng
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;
    }

    private function renderEmailView($view, $data)
    {

        ob_start();
        include "app/view/email/$view.php";
        return ob_get_clean();
    }

    public function statusPr($checkt, $email, $status)
    {
        echo $checkt;
        echo $status;
        echo $email;
        try {
            $this->mailer->setFrom('ngulongbakery@gmail.com');
            $this->mailer->addAddress($email);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = "Đơn hàng của bạn $status";

            $body = $this->renderEmailView($checkt, ['data' => $status]);
            if (empty($body)) {
                throw new Exception('Nội dung email trống');
            }
            $this->mailer->Body = $body;
            $this->mailer->send();
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi gửi thư: {$e}";
        }
    }
}
