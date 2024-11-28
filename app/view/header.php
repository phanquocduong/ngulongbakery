<header>
    <div class="header-left">
        <div class="header-logo">
            <a href="index.php" class="header-logo__link">
                <img src="<?=$base_url?>/public/upload/logo/logo.png" alt="Logo Ngũ Long Bakery - Tiệm bánh truyền thống" class="header-logo__img" loading="lazy"/>
            </a>
        </div>
        <ul class="header-menu">
            <li class="header-menu__item">
                <a href="<?=$base_url?>" class="header-menu__item-link <?=empty($_GET['page']) ? 'header-menu__item-link--active' : ''?>">TRANG CHỦ</a>
            </li>
            <li class="header-menu__item">
                <a href="<?=$base_url?>/collection" class="header-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'collection') ? 'header-menu__item-link--active' : ''?>">
                    SẢN PHẨM
                    <i class="chevron-down-icon fa-solid fa-chevron-down"></i>
                </a>
                <ul class="header-sub-menu">
                    <?php foreach($categories as $category): ?>
                        <li class="header-sub-menu__item">
                            <a href="<?=$base_url?>/collection/<?=$category['id']?>" class="header-sub-menu__item-link"><?=$category['name']?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="header-menu__item">
                <a href="<?=$base_url?>/news" class="header-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'news') ? 'header-menu__item-link--active' : ''?>">TIN TỨC</a>
            </li>
        </ul>
    </div>

    <div class="header-search">
        <form method="GET">
            <input type="hidden" name="page" value="search">
            <input type="text" name="keyword" class="header-search__input" placeholder="Bạn đang tìm kiếm ..." value="<?=$_GET['keyword'] ?? ''?>" />
            <button type="submit" class="header-search__btn">
                <i class="search-icon fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <div class="header-right">
        <ul class="header-menu">
            <li class="header-menu__item">
                <a href="<?=$base_url?>/about" class="header-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'about') ? 'header-menu__item-link--active' : ''?>">GIỚI THIỆU</a>
            </li>
            <li class="header-menu__item">
                <a href="<?=$base_url?>/contact" class="header-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'contact') ? 'header-menu__item-link--active' : ''?>">LIÊN HỆ</a>
            </li>
        </ul>
        <button class="header-search__btn header-search__btn--mobile">
            <i class="search-icon fa-solid fa-magnifying-glass"></i>
        </button>
        <ul class="header-right__list">
            <li class="header-right__item">
                <?php if(isset($_SESSION['user']) && ($_SESSION['user']) != ""): ?>
                    <img class="user-avatar" src="<?=$base_url?>/public/upload/avatar/<?=$_SESSION['user']['avatar']?>" alt="<?=$_SESSION['user']['full_name']?>">
                    <div class="user-action">
                        <a href="<?=$base_url?>/account" class="user-action__link">Tài khoản</a>
                        <a href="<?=$base_url?>/logout" class="user-action__link">Đăng xuất</a>
                    </div>
                <?php else: ?>
                    <i class="user-icon fa-solid fa-user"></i>
                    <div class="user-action">
                        <a href="<?=$base_url?>/login" class="user-action__link">Đăng nhập</a>
                        <a href="<?=$base_url?>/register" class="user-action__link">Đăng ký</a>
                    </div>
                <?php endif; ?>
            </li>
            <li class="header-right__item">
                <a href="<?=$base_url?>/cart" class="header-right__item-link">
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
            <a href="index.php" class="header-menu__item-link <?=empty($_GET['page']) ? 'header-menu__item-link--active' : ''?>">TRANG CHỦ</a>
        </li>
        <li class="header-menu__item">
            <a id="menu-item-drop--tablet" class="header-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'collection') ? 'header-menu__item-link--active' : ''?>"
                >SẢN PHẨM
                <i class="chevron-down-icon fa-solid fa-chevron-down"></i>
            </a>
            <ul class="header-sub-menu">
                <li class="header-sub-menu__item">
                    <a href="<?=$base_url?>/collection" class="header-sub-menu__item-link">Tất cả</a>
                </li>
                <?php foreach($categories as $category): ?>
                    <li class="header-sub-menu__item">
                        <a href="<?=$base_url?>/collection/<?=$category['id']?>" class="header-sub-menu__item-link"><?=$category['name']?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li class="header-menu__item">
            <a href="<?=$base_url?>/news" class="header-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'news') ? 'header-menu__item-link--active' : ''?>">TIN TỨC</a>
        </li>
        <li class="header-menu__item">
            <a href="<?=$base_url?>/about" class="header-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'about') ? 'header-menu__item-link--active' : ''?>">GIỚI THIỆU</a>
        </li>
        <li class="header-menu__item">
            <a href="<?=$base_url?>/contact" class="header-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'contact') ? 'header-menu__item-link--active' : ''?>">LIÊN HỆ</a>
        </li>
    </ul>

    <div class="header-search--mobile">
        <form method="GET">
            <input type="hidden" name="page" value="search">
            <input type="text" name="keyword" class="header-search__input--mobile" placeholder="Bạn đang tìm kiếm ..." value="<?=$_GET['keyword'] ?? ''?>"/>
        </form>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Modal Menu -->
    <div class="modal-menu" id="modalMenu">
        <button class="close-btn" id="closeBtn">✖</button>
        <ul class="modal-menu__list">
            <li class="modal-menu__item"><a class="modal-menu__item-link <?=empty($_GET['page']) ? 'header-menu__item-link--active' : ''?>" href="index.php">Trang Chủ</a></li>
            <li class="modal-menu__item">
                <a id="menu-item-drop" class="modal-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'collection') ? 'header-menu__item-link--active' : ''?>"
                    >Sản Phẩm <i class="chevron-down-icon fa-solid fa-chevron-down"></i
                ></a>
                <ul class="modal-sub-menu__list modal-sub-menu__list--active">
                    <li class="header-sub-menu__item">
                        <a href="<?=$base_url?>/collection" class="header-sub-menu__item-link">Tất cả</a>  
                    </li> 
                    <?php foreach($categories as $category): ?>
                        <li class="header-sub-menu__item">
                            <a href="<?=$base_url?>/collection/<?=$category['id']?>" class="header-sub-menu__item-link"><?=$category['name']?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="modal-menu__item"><a class="modal-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'news') ? 'header-menu__item-link--active' : ''?>" href="<?=$base_url?>/news">Tin Tức</a></li>
            <li class="modal-menu__item"><a class="modal-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'about') ? 'header-menu__item-link--active' : ''?>" href="<?=$base_url?>/about">Giới Thiệu</a></li>
            <li class="modal-menu__item"><a class="modal-menu__item-link <?=(!empty($_GET['page']) && $_GET['page'] == 'contact') ? 'header-menu__item-link--active' : ''?>" href="<?=$base_url?>/contact">Liên Hệ</a></li>
        </ul>
    </div>
</header>
