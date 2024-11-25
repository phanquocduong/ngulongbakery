<!-- Start main -->
    <main>
        <div class="grid wide">
            <div class="row">
            <div class="col l-2 m-3 c-12">
                    <div class="sidebar-heading">
                        <img
                            src="public/upload/avatar/<?=$_SESSION['user']['avatar']?>"
                            alt="<?=$_SESSION['user']['full_name']?>"
                            class="sidebar-heading__avatar"
                        />
                        <div class="sidebar-heading__right">
                            <h4 class="sidebar-heading__username"><?=$_SESSION['user']['full_name']?></h4>
                            <!-- <span onclick="openUserInformation(this)" class="sidebar-heading__edit-profile">
                                <i class="edit-icon fa-solid fa-pencil"></i>Sửa hồ sơ
                            </span> -->
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li onclick="openUserInformation(this)" class="sidebar-menu__item sidebar-menu__item--active">
                            <i class="sidebar-menu__item-icon fa-solid fa-user"></i>
                            Thông tin cá nhân
                        </li>
                        <li onclick="openOrderHistory(this)" class="sidebar-menu__item">
                            <i class="sidebar-menu__item-icon fa-solid fa-newspaper"></i>
                            Đơn hàng
                        </li>
                        <li onclick="openFavoriteProducts(this)" class="sidebar-menu__item">
                            <i class="sidebar-menu__item-icon fa-solid fa-heart-circle-check"></i>
                            Yêu thích
                        </li>
                    </ul>
            </div>

                <div class="col l-10 m-9 c-12">
                    <!-- User-information -->
                    <div id="user-information" class="main-information main-information--active">
                        <h2 class="main-information__heading">Hồ sơ của tôi</h2>
                        <h4 class="main-information__sub-heading">Quản lý thông tin hồ sơ để bảo mật tài khoản</h4>
                        <div class="main-information-box">
                            <form action="index.php?page=handle-update-information" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col l-8 m-12 c-12">
                                        <div class="edit-avatar-box--mobile-tablet">
                                            <img
                                                src="public/upload/avatar/<?=$_SESSION['user']['avatar']?>"
                                                alt="<?=$_SESSION['user']['full_name']?>"
                                                class="edit-avatar__img"
                                            />
                                            <input name="avatar" class="edit-avatar__input" type="file" />
                                        </div>
                                        <div class="row">
                                            <div class="col l-11 m-12 c-12">
                                                <div class="user-information__value form-group">
                                                    <span class="user-information__label">Họ và tên:</span>
                                                    <input
                                                        type="text"
                                                        class="user-information__value-input"
                                                        value="<?=$_SESSION['user']['full_name']?>"
                                                        name="fullname"
                                                        readonly
                                                    />
                                                    <i class="edit-icon-blue fa-solid fa-pencil"></i>
                                                </div>
                                                <div class="form-group">
                                                    <label class="user-information__label">Email:</label>
                                                    <span class="user-information__value"
                                                        ><?=$_SESSION['user']['email']?>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="user-information__label">Mật khẩu:</label>
                                                    <div class="user-information__value">
                                                        <span>********</span>
                                                        <a href="index.php?page=change-password" class="edit-link">Đổi mật khẩu</a>
                                                    </div>
                                                </div>
                                                <div class="user-information__value form-group">
                                                    <span class="user-information__label">Số điện thoại:</span>
                                                    <input
                                                        type="text"
                                                        class="user-information__value-input"
                                                        value="<?=$_SESSION['user']['phone']?>"
                                                        name="phone"
                                                        readonly
                                                    />
                                                    <i class="edit-icon-blue fa-solid fa-pencil"></i>
                                                </div>
                                                <div class="user-information__value form-group">
                                                    <span class="user-information__label">Địa chỉ:</span>
                                                    <input
                                                        type="text"
                                                        class="user-information__value-input"
                                                        value="<?=$_SESSION['user']['address']?>"
                                                        name="address"
                                                        readonly
                                                    />
                                                    <i class="edit-icon-blue fa-solid fa-pencil"></i>
                                                </div>
                                                <button class="save-btn">Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit-avatar-wrap col l-4 m-12 c-12">
                                        <div class="edit-avatar-box">
                                            <img
                                                src="public/upload/avatar/<?=$_SESSION['user']['avatar']?>"
                                                alt="<?=$_SESSION['user']['full_name']?>"
                                                class="edit-avatar__img"
                                            />
                                            <input name="avatar" class="edit-avatar__input" type="file" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Order history -->
                    <div id="order-history" class="main-information">
                        <h2 class="main-information__heading">Lịch sử đơn hàng</h2>
                        <h4 class="main-information__sub-heading">
                            Xem lại lịch sử đơn hàng và các tuỳ chọn cần thiết
                        </h4>
                        <div id="orders" class="main-information-box"></div>
                    </div>

                    <!-- Popup Form -->
                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <span id="closePopupBtn" class="close-popup-btn">&times;</span>
                            <h2 class="popup-heading">Đánh giá sản phẩm</h2>
                            <form action="index.php?page=review" method="POST" id="ratingForm" enctype="multipart/form-data">
                                <input class="order-id" type="hidden" name="orderId">
                                <!-- Rating Stars -->
                                <div class="rating">
                                    <input type="radio" name="rating" id="star1" value="5" />
                                    <label for="star1" class="star">&#9733;</label>

                                    <input type="radio" name="rating" id="star2" value="4" />
                                    <label for="star2" class="star">&#9733;</label>

                                    <input type="radio" name="rating" id="star3" value="3" />
                                    <label for="star3" class="star">&#9733;</label>

                                    <input type="radio" name="rating" id="star4" value="2" />
                                    <label for="star4" class="star">&#9733;</label>

                                    <input type="radio" name="rating" id="star5" value="1" />
                                    <label for="star5" class="star">&#9733;</label>
                                </div>

                                <!-- Image Upload -->
                                <div class="image-upload">
                                    <label for="imageUpload">Chọn hình ảnh (tuỳ chọn):</label>
                                    <input type="file" id="imageUpload" name="imageUpload[]" multiple accept="image/*" />
                                    <small class="note">Bạn có thể chọn tối đa 3 ảnh.</small>
                                </div>


                                <!-- Comment Box -->
                                <div class="comment-box">
                                    <label for="comment">Nhập nhận xét:</label>
                                    <textarea
                                        id="comment"
                                        name="comment"
                                        rows="7"
                                        placeholder="Chia sẻ ý kiến của bạn..."
                                    ></textarea>
                                </div>

                                <button class="modal-btn" type="submit">Gửi đánh giá</button>
                            </form>
                        </div>
                    </div>

                    <!-- Favorite products -->
                    <div id="favorite-products" class="main-information">
                        <h2 class="main-information__heading">Sản phẩm yêu thích</h2>
                        <h4 class="main-information__sub-heading">Theo dõi những sản phẩm đã bấm yêu thích</h4>
                        <div class="main-information-box">
                            <div id="favorite-list" class="row">
                                <?php 
                                    if($data['favorite']): 
                                        foreach($data['favorite'] as $item): ?>
                                    <div class="col l-3 m-6 c-10 c-offset-1">
                                        <div class="product-item">
                                            <a href="index.php?page=product-details&id=<?=$item['id']?>" class="product-item__img-link">
                                                <div class="product-item__img" style="background-image: url(public/upload/product/<?= $item['image'] ?>);"></div>
                                            </a>
                                            <a href="index.php?page=product-details&id=<?=$item['id']?>" class="product-item__title-link">
                                                <h4 class="product-item__name"><?= $item['name'] ?></h4>
                                            </a>
                                            <div class="product-item__rating">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="star-icon fa-<?= $i <= $item['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="product-item__price">
                                                <?php if ($item['sale']): ?>
                                                    <span class="product-item__price-old"><?= number_format($item['price']) ?>đ</span>
                                                    <span class="product-item__price-current"><?= number_format($item['sale']) ?>đ</span>
                                                <?php else: ?>
                                                    <span class="product-item__price-current"><?= number_format($item['price']) ?>đ</span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($item['sale']): ?>
                                                <?php $percentDiscount = round(($item['price'] - $item['sale']) / $item['price'] * 100); ?>
                                                <div class="product-item__sale-off">-<?= $percentDiscount ?>%</div>
                                            <?php endif; ?>
                                            <div class="add-to-cart-box">
                                                <button 
                                                    class="add-to-cart-btn" 
                                                    onclick="addToCart(this, <?= $item['id'] ?>, '<?= $item['name'] ?>', <?= $item['sale'] ? $item['sale'] : $item['price'] ?>, '<?= $item['image'] ?>')"
                                                >
                                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php   endforeach;
                                    endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End main -->