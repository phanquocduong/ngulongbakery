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
            max-width: 600px;
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
            border-bottom: 1px solid rgb(145, 145, 145);
            padding-bottom: 10px;

        }

        .mail-contact-main label {
            color: #d09a40;
            /* ont-size: 2rem; */
        }

        .mail-contact-checkuser {
            margin: 5px 0;
            color: #3a3a3a;
            font-size: 1.5rem;
        }

        .mail-contact-pull {
            border-bottom: 1px solid rgb(145, 145, 145);
            padding-bottom: 10px;


        }

        .mail-contact-pull h3 {
            font-size: 1.5rem;
            color: #d09a40;

        }

        .mail-contact-pull-details {
            font-size: 1.1rem;
            color: #3a3a3a;
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
        <?php if ($Send_user == 'user') : ?>
            <div class="mail-contact">
                <div class="mail-contact-top"><img src="cid:logo_cid" width="100px" alt=""></div>
                <div class="mail-contact-main">
                    <label for="">Họ và tên:</label><br>
                    <div class="mail-contact-checkuser"><?= $username ?></div>
                    <label for="">Email:</label><br>
                    <div class="mail-contact-checkuser"><?= $email ?></div>
                </div>
                <div class="mail-contact-pull">
                    <h3 style="margin: 10px 0;"><?= $option ?></h3>
                    <label for="">Nội dung:</label><br>
                    <div class="mail-contact-pull-details"><?= $comments ?></div>
                </div>
                <div class="mail-contact-pull" style="border: none; padding: 10px 0;">
                    <div class="mail-contact-pull-details">chúng tôi đã nhận được phản hồi của bạn. Đội ngũ hỗ trợ khách hàng sẽ xem xét và liên hệ với bạn trong thời gian sớm nhất
                        sẽ phản hồi sớm nhất có thể</div>
                </div>
            </div>
        <?php elseif ($Send_user == 'admin'): ?>
            <div class="mail-contact">
                <div class="mail-contact-top"><img src="cid:logo_cid" width="100px" alt=""></div>
                <div class="mail-contact-main">
                    <label for="">Họ và tên:</label><br>
                    <div class="mail-contact-checkuser"><?= $username ?></div>
                    <label for="">Email:</label><br>
                    <div class="mail-contact-checkuser"><?= $email ?></div>
                </div>
                <div class="mail-contact-pull">
                    <h3 style="margin: 10px 0;"><?= $option ?></h3>
                    <label for="">Nội dung:</label><br>
                    <div class="mail-contact-pull-details"><?= $comments ?></div>
                </div>
                <div class="mail-contact-pull" style="border: none; padding: 10px 0;">
                    <div class="mail-contact-pull-details">chúng tôi đã nhận được phản hồi của bạn. Đội ngũ hỗ trợ khách hàng sẽ xem xét và liên hệ với bạn trong thời gian sớm nhất
                        sẽ phản hồi sớm nhất có thể</div>
                </div>
            </div>
        <?php endif ?>

    </body>

    </html>
</body>

</html>