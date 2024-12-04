<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ngũ Long Bakery - Hương vị truyền thống, lan toả yêu thương</title>
    <meta name="description" content="Ngũ Long Bakery - Tiệm bánh truyền thống với đa dạng các loại bánh như bánh da lợn, bánh bò, bánh bông lan trứng muối. Thưởng thức hương vị ngọt ngào từ chúng tôi!">
    <link rel="icon" href="public/upload/logo/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="public/css/grid.css" />
    <link rel="stylesheet" href="public/css/base.css" />
    <link rel="stylesheet" href="public/css/<?=$css?>" />
    <link rel="stylesheet" href="public/fonts/fontawesome-free-6.6.0-web/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Aclonica&family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet"
    />
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include $view . '.php'; ?>
    <?php include 'footer.php'; ?>

    <script src="public/js/base.js"></script>
    <script src="public/js/validator.js"></script>
    <script src="public/js/<?=$js?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($_SESSION['success'])): ?>
        <script>
            Swal.fire({
                title: '<?= $_SESSION['success'] ?>',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            })
        </script>
    <?php unset($_SESSION['success']); endif; ?>
    <?php if (isset($_SESSION['info'])): ?>
        <script>
            Swal.fire({
                title: '<?= $_SESSION['info'] ?>',
                icon: 'info',
                showConfirmButton: true
            })
        </script>
    <?php unset($_SESSION['info']); endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <script>
            Swal.fire({
                title: '<?= $_SESSION['error'] ?>',
                icon: 'error',
                showConfirmButton: true
            })
        </script>
    <?php unset($_SESSION['error']); endif; ?>
</body>
</html>
