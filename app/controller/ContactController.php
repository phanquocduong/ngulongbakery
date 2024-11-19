    z<?php

        use PHPMailer\PHPMailer\PHPMailer;

        class Contactcontroller
        {

            function __construct() {}

            private function renderView($view, $css, $js, $data = [])
            {
                require_once 'app/view/header.php';
                $viewPath = 'app/view/' . $view . '.php';
                require_once $viewPath;
                require_once 'app/view/footer.php';
            }

            public function viewContact($css, $js)
            {
                $this->renderView('contact', $css, $js, []);
                var_dump($_SESSION['user']);
            }
            public function getfromct($css, $js)
            {
                if (isset($_SESSION['user'])) {
                    $emailuser = $_POST['email'];
                    $username = $_POST['name'];
                    $optionuser = $_POST['select-fix'];
                    $comments = $_POST['comments'];



                    $mail = new PHPMailer(true);
                    /*       $mail->SMTPDebug = 2; */
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

                        // Người gửi
                        $mail->setFrom('ngulongbakery@gmail.com');

                        // Người nhận
                        $mail->addAddress($emailuser); // Gửi đến email người dùng
                        $mail->isHTML(true);
                        $mail->Subject = "Cảm ơn bạn đã liên hệ!";
                        $mail->Body    = "Xin chào,$emailuser Cảm ơn bạn đã liên hệ với Ngũ Long Bakery. Chúng tôi sẽ phản hồi sớm nhất có thể!";
                        $mail->send();


                        /* gui mail admin */
                        $mail->clearAddresses(); // Xóa địa chỉ email trước đó
                        $mail->addAddress('ngulongbakery@gmail.com'); // Gửi đến quản trị viên
                        $mail->Subject = "Thông báo từ form liên hệ [ $optionuser ]";
                        $mail->Body    = "Có một yêu cầu mới từ người dùng:Email: $emailuser Nội dung: $comments";
                        $mail->send();




                        echo '<script>alert("Cảm ơn bạn đã liên hệ, vui lòng kiểm tra Gmail!");</script>';
                        echo '<script>window.location.href = "index.php";</script>';
                    } catch (Exception $e) {
                        echo "Lỗi khi gửi email: {$mail->ErrorInfo}";
                    }
                } else {
                    echo '<script>alert("Vui lòng đăng nhập");</script>';
                    echo '<script>window.location.href = "index.php?page=login";</script>';
                }
                /*     $this->renderView('contact', $css, $js, []); */
            }
        }
