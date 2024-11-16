<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ngũ Long Bakery - Hương vị truyền thống, lan toả yêu thương</title>
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
        <!-- Start Header -->
        <header>
            <div class="header-left">
                <div class="header-logo">
                    <a href="index.php" class="header-logo__link">
                        <img src="public/upload/logo/logo.png" alt="Ngũ Long Bakery" class="header-logo__img" />
                    </a>
                </div>
                <ul class="header-menu">
                    <li class="header-menu__item">
                        <a href="index.php" class="header-menu__item-link">TRANG CHỦ</a>
                    </li>
                    <li class="header-menu__item">
                        <a href="index.php?page=collection" class="header-menu__item-link">SẢN PHẨM</a>
                    </li>
                    <li class="header-menu__item">
                        <a href="" class="header-menu__item-link">TIN TỨC</a>
                    </li>
                </ul>
            </div>

            <div class="header-search">
                <input type="text" class="header-search__input" placeholder="Bạn đang tìm kiếm ..." />
                <button class="header-search__btn">
                    <i class="search-icon fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <div class="header-right">
                <ul class="header-menu">
                    <li class="header-menu__item">
                        <a href="" class="header-menu__item-link">GIỚI THIỆU</a>
                    </li>
                    <li class="header-menu__item">
                        <a href="" class="header-menu__item-link">LIÊN HỆ</a>
                    </li>
                </ul>
                <button class="header-search__btn header-search__btn--mobile">
                    <i class="search-icon fa-solid fa-magnifying-glass"></i>
                </button>
                <ul class="header-right__list">
                    <li class="header-right__item">
                        <i class="user-icon fa-solid fa-user"></i>
                        <div class="user-action">
                            <a href="" class="user-action__link">Đăng nhập</a>
                            <a href="index.php?page=register" class="user-action__link">Đăng ký</a>
                        </div>
                    </li>
                    <li class="header-right__item">
                        <a href="index.php?page=cart" class="header-right__item-link">
                            <i class="cart-icon fa-solid fa-basket-shopping"></i>
                            <span id="cart-quantity" class="cart-quantity">
                                <?php
                                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                        $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
                                        echo $cartQuantity;
                                    } else {
                                        echo 0;
                                    }
                                ?>
                            </span>
                        </a>
                    </li>
                </ul>
                <div class="menu-bars">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>

            <ul class="header-menu header-menu--tablet">
                <li class="header-menu__item">
                    <a href="" class="header-menu__item-link">TRANG CHỦ</a>
                </li>
                <li class="header-menu__item">
                    <a href="" class="header-menu__item-link">SẢN PHẨM</a>
                </li>
                <li class="header-menu__item">
                    <a href="" class="header-menu__item-link">TIN TỨC</a>
                </li>
                <li class="header-menu__item">
                    <a href="" class="header-menu__item-link">GIỚI THIỆU</a>
                </li>
                <li class="header-menu__item">
                    <a href="" class="header-menu__item-link">LIÊN HỆ</a>
                </li>
            </ul>
            <input type="text" class="header-search__input--mobile" placeholder="Bạn đang tìm kiếm ..." />

            <!-- Overlay -->
            <div class="overlay" id="overlay"></div>

            <!-- Modal Menu -->
            <div class="modal-menu" id="modalMenu">
                <button class="close-btn" id="closeBtn">✖</button>
                <ul class="modal-menu__list">
                    <li class="modal-menu__item"><a class="modal-menu__item-link" href="#">Trang Chủ</a></li>
                    <li class="modal-menu__item"><a class="modal-menu__item-link" href="#">Sản Phẩm</a></li>
                    <li class="modal-menu__item"><a class="modal-menu__item-link" href="#">Tin Tức</a></li>
                    <li class="modal-menu__item"><a class="modal-menu__item-link" href="#">Giới Thiệu</a></li>
                    <li class="modal-menu__item"><a class="modal-menu__item-link" href="#">Liên Hệ</a></li>
                </ul>
            </div>
        </header>
        <!-- End Header -->