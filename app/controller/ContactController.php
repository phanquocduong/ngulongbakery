<?php

use PHPMailer\PHPMailer\PHPMailer;

class ContactController
{
    private $category;
    private $email;

    function __construct()
    {
        $this->category = new CategoryModel();
        $this->email = new GetlayoutEmail();
    }

    private function renderView($view, $css, $js, $data = [])
    {
        $categories = $this->category->getCategories("WHERE type = 'Sản phẩm'", []);
        require_once 'app/view/header.php';
        $viewPath = 'app/view/' . $view . '.php';
        require_once $viewPath;
        require_once 'app/view/footer.php';
    }


    public function viewContact($css, $js)
    {
        $this->renderView('contact', $css, $js);
    }

    public function handleContact($css, $js)
    {

        $emailuser = $_POST['email'];
        $username = $_POST['name'];
        $optionuser = $_POST['select-fix'];
        $comments = $_POST['comments'];

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $this->email->emailcheckout(
                        'layoutmail',
                        [
                            'Send_user' => 'contact_mail',
                            'email' =>  $emailuser,
                            'username' => $username,
                            'option' => $optionuser,
                            'comments' => $comments
                        ]);
        // try {

        //     $mail->isSMTP();
        //     $mail->Host = 'smtp.gmail.com';
        //     $mail->SMTPAuth   = true;
        //     $mail->Username = 'ngulongbakery@gmail.com';
        //     $mail->Password = 'guca wcef owki vocr';
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //     $mail->Port = 587;


        //     $mail->setFrom('ngulongbakery@gmail.com');


        //     $mail->addAddress($emailuser);


        //     $mail->isHTML(true);
        //     $mail->Subject = "Cảm ơn bạn đã liên hệ!";
        //     /*   $mail->Body    = "Xin chào, $username. Cảm ơn bạn đã liên hệ với Ngũ Long Bakery. Chúng tôi sẽ phản hồi sớm nhất có thể!"; */
        //     $mail->Body = $this->email->emailcheckout(
        //             'layoutmail',
        //             [
        //                 'Send_user' => 'contact_mail',
        //                 'email' =>  $emailuser,
        //                 'username' => $username,
        //                 'option' => $optionuser,
        //                 'comments' => $comments
        //             ]
        //         );


        //     $mail->send();

        //     $mail->clearAddresses(); // Xóa địa chỉ email trước đó
        //     $mail->addAddress('ngulongbakery@gmail.com'); // Gửi đến quản trị viên
        //     $mail->Subject = "Thông báo từ form liên hệ [ $optionuser ]";
        //     $mail->Body    = "Có một yêu cầu mới từ người dùng: [Email: $emailuser] [Loại: $optionuser] [Nội dung: $comments]";
        //     $mail->send();
        //   /*   echo '<script>alert("Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể!")</script>';
        //     echo '<script>window.location.href = "index.php?page=contact";</script>'; */
        // } catch (Exception $e) {
        //     echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
        // }
    }
}
