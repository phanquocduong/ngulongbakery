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
                                <span onclick="openUserInformation(this)" class="sidebar-heading__edit-profile"
                                    ><i class="edit-icon fa-solid fa-pencil"></i>Sửa hồ sơ</span
                                >
                            </div>
                        </div>
                        <ul class="sidebar-menu">
                            <li
                                onclick="openUserInformation(this)"
                                class="sidebar-menu__item sidebar-menu__item--active"
                            >
                                <i class="sidebar-menu__item-icon fa-solid fa-user"></i>
                                Thông tin cá nhân
                            </li>
                            <li onclick="openOrderHistory(this)" class="sidebar-menu__item">
                                <i class="sidebar-menu__item-icon fa-solid fa-newspaper"></i>
                                Lịch sử đơn hàng
                            </li>
                            <li onclick="openFavoriteProducts(this)" class="sidebar-menu__item">
                                <i class="sidebar-menu__item-icon fa-solid fa-heart-circle-check"></i>
                                Sản phẩm yêu thích
                            </li>
                        </ul>
                    </div>
                    <div class="col l-10 m-9 c-12">
                        <!-- User-information -->
                        <div id="user-information" class="main-information main-information--active">
                            <h2 class="main-information__heading">Hồ sơ của tôi</h2>
                            <h4 class="main-information__sub-heading">Quản lý thông tin hồ sơ để bảo mật tài khoản</h4>
                            <div class="main-information-box">
                                <form action="handle-update-information" method="POST">
                                    <div class="row">
                                        <div class="col l-8 m-12 c-12">
                                            <div class="edit-avatar-box--mobile-tablet">
                                                <img
                                                    src="public/upload/avatar/<?=$_SESSION['user']['avatar']?>"
                                                    alt="<?=$_SESSION['user']['full_name']?>"
                                                    class="edit-avatar__img"
                                                />
                                                <input class="edit-avatar__input" type="file" />
                                            </div>
                                            <div class="row">
                                                <div class="user-information__label-box col l-3 m-3 c-4">
                                                    <span class="user-information__label">Họ và tên:</span>
                                                    <span class="user-information__label">Email:</span>
                                                    <span class="user-information__label">Mật khẩu:</span>
                                                    <span class="user-information__label">Số điện thoại:</span>
                                                    <span class="user-information__label">Địa chỉ:</span>
                                                </div>
                                                <div class="col l-9 m-9 c-8">
                                                    <div class="user-information__value">
                                                        <input
                                                            type="text"
                                                            class="user-information__value-input"
                                                            value="<?=$_SESSION['user']['full_name']?>"
                                                            readonly
                                                        />
                                                        <i class="edit-icon-blue fa-solid fa-pencil"></i>
                                                    </div>
                                                    <span class="user-information__value"
                                                        ><?=$_SESSION['user']['email']?>
                                                    </span>
                                                    <span class="user-information__value"
                                                        >******** <a href="index.php?page=chane-password" class="edit-link">Đổi mật khẩu</a></span
                                                    >
                                                    <div class="user-information__value">
                                                        <input
                                                            type="text"
                                                            class="user-information__value-input"
                                                            value="<?=$_SESSION['user']['phone']?>"
                                                            readonly
                                                        />
                                                        <i class="edit-icon-blue fa-solid fa-pencil"></i>
                                                    </div>
                                                    <div class="user-information__value">
                                                        <input
                                                            type="text"
                                                            class="user-information__value-input"
                                                            value="<?=$_SESSION['user']['address']?>"
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
                                                <input class="edit-avatar__input" type="file" />
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
                            <div class="main-information-box">
                                <div class="order-history-item">
                                    <div class="product-order-wrap">
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="delivery-status">
                                        <div class="delivery-status__line"></div>
                                        <span class="delivery-status__stt-wait"
                                            ><i class="status-icon fa-solid fa-hourglass-start"></i>Chờ xác nhận</span
                                        >
                                    </div>
                                    <div class="into-money">
                                        <span class="into-money__order-id">#7843</span>
                                        <div class="into-money__total">
                                            <span class="into-money__total-label">Thành tiền:</span>
                                            <span class="into-money__total-price">150.000đ</span>
                                        </div>
                                    </div>
                                    <button class="options-btn">Huỷ</button>
                                </div>
                                <div class="order-history-item">
                                    <div class="product-order-wrap">
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="delivery-status">
                                        <div class="delivery-status__line"></div>
                                        <span class="delivery-status__stt-wait"
                                            ><i class="status-icon fa-solid fa-hourglass-start"></i>Đã xác nhận</span
                                        >
                                    </div>
                                    <div class="into-money">
                                        <span class="into-money__order-id">#7843</span>
                                        <div class="into-money__total">
                                            <span class="into-money__total-label">Thành tiền:</span>
                                            <span class="into-money__total-price">150.000đ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-history-item">
                                    <div class="product-order-wrap">
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="delivery-status">
                                        <div class="delivery-status__line"></div>
                                        <span class="delivery-status__stt-delivery"
                                            ><i class="delivery-icon fa-solid fa-truck"></i>Đang giao hàng</span
                                        >
                                    </div>
                                    <div class="into-money">
                                        <span class="into-money__order-id">#7843</span>
                                        <div class="into-money__total">
                                            <span class="into-money__total-label">Thành tiền:</span>
                                            <span class="into-money__total-price">150.000đ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-history-item">
                                    <div class="product-order-wrap">
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="delivery-status">
                                        <div class="delivery-status__line"></div>
                                        <span class="delivery-status__stt-delivery"
                                            ><i class="delivery-icon fa-solid fa-truck"></i>Giao hàng thành công</span
                                        >
                                    </div>
                                    <div class="into-money">
                                        <span class="into-money__order-id">#7843</span>
                                        <div class="into-money__total">
                                            <span class="into-money__total-label">Thành tiền:</span>
                                            <span class="into-money__total-price">150.000đ</span>
                                        </div>
                                    </div>
                                    <button id="openPopupBtn" class="options-btn">Đánh giá</button>
                                </div>
                                <div class="order-history-item">
                                    <div class="product-order-wrap">
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                        <div class="product-order">
                                            <div class="product-info">
                                                <img
                                                    src="https://i.pinimg.com/736x/68/27/91/682791dd40d096019ba440bf4b4591d4.jpg"
                                                    alt=""
                                                    class="product-info__img"
                                                />
                                                <div class="product-info__right">
                                                    <h4 class="product-info__name">Bánh Bò Nướng Lá Dứa</h4>
                                                    <span class="product-info__type">Loại: Bánh bò</span>
                                                    <span class="product-info__quantity">x3</span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <span class="product-price__old">25.000đ</span>
                                                <span class="product-price__current">20.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="delivery-status">
                                        <div class="delivery-status__line"></div>
                                        <span class="delivery-status__stt-cancel"
                                            ><i class="cancel-icon fa-solid fa-ban"></i>Đã huỷ</span
                                        >
                                    </div>
                                    <div class="into-money">
                                        <span class="into-money__order-id">#7843</span>
                                        <div class="into-money__total">
                                            <span class="into-money__total-label">Thành tiền:</span>
                                            <span class="into-money__total-price">150.000đ</span>
                                        </div>
                                    </div>
                                    <button class="options-btn">Mua lại</button>
                                </div>
                                <div class="pagination">
                                    <a href="" class="pagination-link__icon-prev">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </a>
                                    <a href="" class="pagination-link pagination-link--active">1</a>
                                    <a href="" class="pagination-link">2</a>
                                    <a href="" class="pagination-link">3</a>
                                    <a href="" class="pagination-link">...</a>
                                    <a href="" class="pagination-link">11</a>
                                    <a href="" class="pagination-link__icon-next">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Popup Form -->
                        <div id="popup" class="popup">
                            <div class="popup-content">
                                <span id="closePopupBtn" class="close-btn">&times;</span>
                                <h2 class="popup-heading">Đánh giá sản phẩm</h2>
                                <form action="jskdvbksd.html" method="POST" id="ratingForm">
                                    <!-- Rating Stars -->
                                    <div class="rating">
                                        <input type="radio" name="rating" id="star1" value="1" />
                                        <label for="star1" class="star">&#9733;</label>

                                        <input type="radio" name="rating" id="star2" value="2" />
                                        <label for="star2" class="star">&#9733;</label>

                                        <input type="radio" name="rating" id="star3" value="3" />
                                        <label for="star3" class="star">&#9733;</label>

                                        <input type="radio" name="rating" id="star4" value="4" />
                                        <label for="star4" class="star">&#9733;</label>

                                        <input type="radio" name="rating" id="star5" value="5" />
                                        <label for="star5" class="star">&#9733;</label>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="image-upload">
                                        <label for="imageUpload">Chọn hình ảnh (tuỳ chọn):</label>
                                        <input type="file" id="imageUpload" name="imageUpload" accept="image/*" />
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

                                    <button type="submit">Gửi đánh giá</button>
                                </form>
                            </div>
                        </div>

                        <div id="favorite-products" class="main-information">
                            <h2 class="main-information__heading">Sản phẩm yêu thích</h2>
                            <h4 class="main-information__sub-heading">Theo dõi những sản phẩm đã bấm yêu thích</h4>
                            <div class="main-information-box">
                                <div class="row">
                                    <div class="col l-3 m-6 c-12">
                                        <div class="product-item">
                                            <a href="" class="product-item__img-link">
                                                <div
                                                    style="
                                                        background-image: url(https://i.pinimg.com/564x/2d/9f/c3/2d9fc349a1da5fa9c0cf517dafd96381.jpg);
                                                    "
                                                    class="product-item__img"
                                                ></div>
                                            </a>
                                            <a href="" class="product-item__title-link">
                                                <h4 class="product-item__name">Bánh Bông Lan Trứng Muối</h4>
                                            </a>
                                            <div class="product-item__rating">
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-regular fa-star"></i>
                                            </div>
                                            <div class="product-item__price">
                                                <span class="product-item__price-old">80.000đ</span>
                                                <span class="product-item__price-current">65.000đ</span>
                                            </div>
                                            <div class="product-item__sale-off">-18%</div>
                                            <div class="add-to-cart-box">
                                                <button class="add-to-cart-btn" onclick="showCheckedIcon(this)">
                                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col l-3 m-6 c-12">
                                        <div class="product-item">
                                            <a href="" class="product-item__img-link">
                                                <div
                                                    style="
                                                        background-image: url(https://i.pinimg.com/564x/2d/9f/c3/2d9fc349a1da5fa9c0cf517dafd96381.jpg);
                                                    "
                                                    class="product-item__img"
                                                ></div>
                                            </a>
                                            <a href="" class="product-item__title-link">
                                                <h4 class="product-item__name">Bánh Bông Lan Trứng Muối</h4>
                                            </a>
                                            <div class="product-item__rating">
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-regular fa-star"></i>
                                            </div>
                                            <div class="product-item__price">
                                                <span class="product-item__price-old">80.000đ</span>
                                                <span class="product-item__price-current">65.000đ</span>
                                            </div>
                                            <div class="product-item__sale-off">-18%</div>
                                            <div class="add-to-cart-box">
                                                <button class="add-to-cart-btn" onclick="showCheckedIcon(this)">
                                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col l-3 m-6 c-12">
                                        <div class="product-item">
                                            <a href="" class="product-item__img-link">
                                                <div
                                                    style="
                                                        background-image: url(https://i.pinimg.com/564x/2d/9f/c3/2d9fc349a1da5fa9c0cf517dafd96381.jpg);
                                                    "
                                                    class="product-item__img"
                                                ></div>
                                            </a>
                                            <a href="" class="product-item__title-link">
                                                <h4 class="product-item__name">Bánh Bông Lan Trứng Muối</h4>
                                            </a>
                                            <div class="product-item__rating">
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-solid fa-star"></i>
                                                <i class="star-icon fa-regular fa-star"></i>
                                            </div>
                                            <div class="product-item__price">
                                                <span class="product-item__price-old">80.000đ</span>
                                                <span class="product-item__price-current">65.000đ</span>
                                            </div>
                                            <div class="product-item__sale-off">-18%</div>
                                            <div class="add-to-cart-box">
                                                <button class="add-to-cart-btn" onclick="showCheckedIcon(this)">
                                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- End main -->