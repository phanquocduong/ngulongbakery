<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="public/upload/logo/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="public/css/grid.css" />
    <link rel="stylesheet" href="public/css/base.css" />
    <link rel="stylesheet" href="public/fonts/fontawesome-free-6.6.0-web/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Aclonica&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 1.2rem;
            color: #3a3a3a;
        }

        .mail-contact {
            padding: 10px;
            max-width: 500px;
            border: 1px solid rgb(145, 145, 145);
            height: auto;
            margin: auto;
            border-radius: 10px;
        }

        .mail-contact-top {

            align-items: center;
            text-align: center;
            width: 100%;
            justify-content: center;
            border-bottom: 1px solid rgb(145, 145, 145);
            padding: 10px 0;
        }

        .mail-contact-main {
            margin-top: 10px;

            padding-bottom: 10px;
            font-size: 1.5rem;
            text-align: center;
            color: rgb(71, 71, 71);
        }

        .mail-contact-main label {
            color: #d09a40;

        }

        .mail-contact-checkuser {
            margin: 5px 0;
            color: #3a3a3a;
            font-size: 1.5rem;
        }

        .mail-contact-pull {


            /*  text-align: center; */
            color: #d09a40;

        }

        .mail-contact-pull h1 {
            font-size: 3rem;
            color: #d09a40;
            text-align: center;

        }

        .mail-contact-pull-details {

            font-size: 1.1rem;
            color: #5e5e5e;
        }

        .mail-contact-pull-btn-box {
            width: 100%;
            text-align: center;
        }

        .btn-mail {
            padding: 10px 20px;
            background-color: #d09a40;
            color: #fff;
            margin: 20px;
            border: 1px solid rgb(144, 124, 36);
            border-radius: 10px;
            text-align: center;
        }

        @media (max-width: 740px) {
            .mail-contact-checkuser {
                margin: 5px 0;
                color: #3a3a3a;
                font-size: 1.2rem;
            }
        }
    </style>

</head>



<body>
    <html>


    <body>
        <?php if ($Send_user == 'user_register') : ?>
            <div class="mail-contact">
                <div class="mail-contact-top">
                    <h2>Register your account</h2>
                </div>
                <div class="mail-contact-main">
                    Đây là mã xác minh đăng ký
                </div>
                <div class="mail-contact-pull-btn-box"><a href="localhost/ngulongbakery/index.php?page=verify&code=<?= $code ?>"><button class="btn-mail">Đăng ký ngay</button></a>
                </div>
                <div class="mail-contact-pull" style="border: none; padding: 10px 0;">
                    <div class="mail-contact-pull-details">- Cảm ơn bạn vì đã đăng ký trang web chúng tôi, hãy ấn nút bên
                        dưới
                        nút bên dưới để tạo tài khoản nhanh</div>

                    <div class="mail-contact-pull-details" style="margin-top: 20px;">- Mã chỉ có thể sử dụng 30 phút kể từ
                        lúc
                        gửi nếu không được xui lòng xác minh lần nữa</div>

                    <div class="mail-contact-pull-btn-box"><a href="localhost/ngulongbakery/index.php?" style="text-decoration: none;">
                            <div class="mail-contact-pull-details" style="margin-top: 20px;"> - Ngũ Long bakery -</div>

                    </div>
                </div>
            <?php elseif ($Send_user == 'user_forgot'): ?>
                <div class="mail-contact">
                    <div class="mail-contact-top">
                        <h2>Reset your password</h2>
                    </div>
                    <div class="mail-contact-main">
                       Tạo mới mật khẩu
                    </div>
                    <div class="mail-contact-pull-btn-box"><a href="localhost/ngulongbakery/index.php?page=verify&code=<?= $code ?>"><button class="btn-mail">Đăng ký ngay</button></a>
                    </div>
                    <div class="mail-contact-pull" style="border: none; padding: 10px 0;">
                        <div class="mail-contact-pull-details">- vui lòng không cung cấp các thông tin có các thiết bị lạ</div>

                        <div class="mail-contact-pull-details" style="margin-top: 20px;">- Mã chỉ có thể sử dụng 30 phút kể từ
                            lúc
                            gửi nếu không được xui lòng xác minh lần nữa</div>

                        <div class="mail-contact-pull-btn-box"><a href="localhost/ngulongbakery/index.php?" style="text-decoration: none;">
                                <div class="mail-contact-pull-details" style="margin-top: 20px;"> - Ngũ Long bakery -</div>

                        </div>
                    </div>
                <?php endif ?>


    </body>

    </html>
</body>

</html>