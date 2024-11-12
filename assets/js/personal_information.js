function showOrderHistory() {
    const fontBox = document.getElementById("main");

    // Thay đổi nội dung thành "Lịch Sử Đơn Hàng"
    fontBox.innerHTML = `
        <div class="grid wide">
                    <div  class="main_personal row">
                        <div class="main_list col l-3 m-4">
                            <div class="main_list_category">
                                <label>
                                    <div class="main_list_user">
                                        <img class="main_item_img" src="./assets/image/avatar/caophuoc.jpg" alt="Avatar">
                                        <p>Phước đẹp trai</p>
                                        <a href="#" class="edit_info">Sửa thông tin <i class="fa-solid fa-pencil"></i></a>
                                    </div>
                                    <div class="main_list_item">
                                        <i class="fa-solid fa-user"></i>
                                        <a href="javascript:void(0);" onclick="personalInformation()">Thông tin cá nhân</a>
                                    </div>
                                    <div class="main_list_item active">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <a href="javascript:void(0);" onclick="showOrderHistory()">Lịch sử đơn hàng</a>
                                    </div>
                                    <div class="main_list_item">
                                        <i class="fa-solid fa-star"></i>
                                        <a href="javascript:void(0);" onclick="favouriteProduct()">Sản phẩm yêu thích</a>
                                    </div>
                                </label>
                            </div>
                        </div>
                         
                        <div class="order_history col l-9 m-8 c-12">
                            <h1>Lịch sử đơn hàng</h1>
                            <p class="sub_heading">Xem lại đơn hàng đã mua và đánh giá sản phẩm</p>
                            <div class="order_item">
                                <div class="item_details">
                                    <img src="https://via.placeholder.com/80" alt="Bánh Bò Nướng Lá Dứa">
                                    <div class="product_info">
                                        <h3>Bánh Bò Nướng Lá Dứa</h3>
                                        <p>Loại: Bánh bò</p>
                                        <p>x3</p>
                                    </div>
                                    <p class="price">50.000đ</p>
                                </div>
                                <p class="total_price">Thành tiền: <span>150.000đ</span></p>
                                <button class="review_btn">Đánh giá</button>
                                <button class="reorder_btn">Mua lại</button>
                                <p class="status">🚚 Giao hàng thành công</p>
                            </div>
                    
                            <div class="order_item">
                                <div class="item_details">
                                    <img src="https://via.placeholder.com/80" alt="Xôi Xoài">
                                    <div class="product_info">
                                        <h3>Xôi Xoài</h3>
                                        <p>Loại: Xôi</p>
                                        <p>x2</p>
                                    </div>
                                    <p class="price"><del>25.000đ</del> 20.000đ</p>
                                </div>
                                <div class="item_details">
                                    <img src="https://via.placeholder.com/80" alt="Bánh Cupcake Vị Vanilla">
                                    <div class="product_info">
                                        <h3>Bánh Cupcake Vị Vanilla</h3>
                                        <p>Loại: Cupcake</p>
                                        <p>x1</p>
                                    </div>
                                    <p class="price">50.000đ</p>
                                </div>
                                <p class="total_price">Thành tiền: <span>90.000đ</span></p>
                                <button class="review_btn">Đánh giá</button>
                                <button class="reorder_btn">Mua lại</button>
                                <p class="status">🚚 Giao hàng thành công</p>
                            </div>
                    
                            <div class="order_item">
                                <div class="item_details">
                                    <img src="https://via.placeholder.com/80" alt="Bánh Quy Socola Chip">
                                    <div class="product_info">
                                        <h3>Bánh Quy Socola Chip</h3>
                                        <p>Loại: Bánh quy</p>
                                        <p>x5</p>
                                    </div>
                                    <p class="price"><del>25.000đ</del> 20.000đ</p>
                                </div>
                                <div class="item_details">
                                    <img src="https://via.placeholder.com/80" alt="Bánh Quy Hạnh Nhân">
                                    <div class="product_info">
                                        <h3>Bánh Quy Hạnh Nhân</h3>
                                        <p>Loại: Bánh quy</p>
                                        <p>x2</p>
                                    </div>
                                    <p class="price"><del>65.000đ</del> 60.000đ</p>
                                </div>
                                <p class="total_price">Thành tiền: <span>220.000đ</span></p>
                                <button class="reorder_btn">Mua lại</button>
                                <p class="status cancelled">❌ Đã hủy</p>
                            </div>
                        </div>
                    </div>
        </div>
    `;
}
function personalInformation(){
    const personal = document.getElementById("main");
    personal.innerHTML = `
        <div class="grid wide">
                    <div  class="main_personal row">
                        <div class="main_list col l-3 m-4">
                            <div class="main_list_category">
                                <label>
                                    <div class="main_list_user">
                                        <img class="main_item_img" src="./assets/image/avatar/caophuoc.jpg" alt="Avatar">
                                        <p>Phước đẹp trai</p>
                                        <a href="#" class="edit_info">Sửa thông tin <i class="fa-solid fa-pencil"></i></a>
                                    </div>
                                    <div class="main_list_item active">
                                        <i class="fa-solid fa-user"></i>
                                        <a href="javascript:void(0);" onclick="personalInformation()">Thông tin cá nhân</a>
                                    </div>
                                    <div class="main_list_item">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <a href="javascript:void(0);" onclick="showOrderHistory()">Lịch sử đơn hàng</a>
                                    </div>
                                    <div class="main_list_item">
                                        <i class="fa-solid fa-star"></i>
                                        <a href="javascript:void(0);" onclick="favouriteProduct()">Sản phẩm yêu thích</a>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="main_content l-9 m-8 c-12">
                            <div class="profile_container">
                                <div class="profile_header">
                                    <h1>Hồ Sơ Của Tôi</h1>
                                    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                                </div>
                            
                                <div class="profile_content">
                                    <!-- Thông tin cá nhân bên trái -->
                                    <div class="profile_info">
                                        <div class="profile_row">
                                            <label>Họ và tên:</label>
                                            <span>Nguyen Cao Phuoc</span>
                                            <button class="edit_button">Chỉnh sửa</button>
                                        </div>
                                        <div class="profile_row">
                                            <label>Email:</label>
                                            <span>phuocncps38249@gmail.com</span>
                                            <button class="edit_button">Chỉnh sửa</button>
                                        </div>
                                        <div class="profile_row">
                                            <label>Số điện thoại:</label>
                                            <span>0367337461</span>
                                            <button class="edit_button">Chỉnh sửa</button>
                                        </div>
                                        <div class="profile_row">
                                            <label>Mật khẩu:</label>
                                            <span>*********</span>
                                            <button class="edit_button">Chỉnh sửa</button>
                                        </div>
                                        <div class="profile_info_button">
                                            <button class="upload_button">Thay đổi Avatar</button>
                                            <button class="upload_button_edit">Lưu</button>
                                        </div>
                                    </div>
                            
                                    <!-- Avatar bên phải -->
                                    <div class="profile_avatar">
                                        <img src="./assets/image/avatar/caophuoc.jpg" alt="Avatar" class="avatar_img">
                                        <div class="profile_info_button">
                                            <button class="upload_button">Thay đổi Avatar</button>
                                            <button class="upload_button_edit">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    `;
}
function favouriteProduct() {
    const favourite = document.getElementById("main");

    // Thay đổi nội dung thành "Sản Phẩm Yêu Thích"
    favourite.innerHTML = `
      <div class="grid wide">
                    <div class="main_personal row favorite">
                        <div class="main_list col l-3 m-4">
                            <div class="main_list_category">
                                <label>
                                    <div class="main_list_user">
                                        <img class="main_item_img" src="./assets/image/avatar/caophuoc.jpg" alt="Avatar">
                                        <p>Phước đẹp trai</p>
                                        <a href="#" class="edit_info">Sửa thông tin <i class="fa-solid fa-pencil"></i></a>
                                    </div>
                                    <div class="main_list_item">
                                        <i class="fa-solid fa-user"></i>
                                        <a href="javascript:void(0);" onclick="personalInformation()">Thông tin cá nhân</a>
                                    </div>
                                    <div class="main_list_item">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <a href="javascript:void(0);" onclick="showOrderHistory()">Lịch sử đơn hàng</a>
                                    </div>
                                    <div class="main_list_item active">
                                        <i class="fa-solid fa-star"></i>
                                        <a href="javascript:void(0);" onclick="favouriteProduct()">Sản phẩm yêu thích</a>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="main_product col l-9 m-8 c-12">
                            <div class="main_product_detail">
                                <h1>Sản phẩm yêu thích</h1>
                                <hr>
                            </div>
                            <div class="row">
                            <div class="col l-3 m-6 c-10 c-offset-1">
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
                                        <h4 class="product-item__name item_name">Bánh Bông Lan Trứng Muối</h4>
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
                                        <button class="add-to-cart-btn btn_product_favourite" onclick="showCheckedIcon(this)">
                                            THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-3 m-6 c-10 c-offset-1">
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
                                        <h4 class="product-item__name item_name">Bánh Bông Lan Trứng Muối</h4>
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
                                        <button class="add-to-cart-btn btn_product_favourite" onclick="showCheckedIcon(this)">
                                            THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-3 m-6 c-10 c-offset-1">
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
                                        <h4 class="product-item__name item_name">Bánh Bông Lan Trứng Muối</h4>
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
                                        <button class="add-to-cart-btn btn_product_favourite" onclick="showCheckedIcon(this)">
                                            THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-3 m-6 c-10 c-offset-1">
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
                                        <h4 class="product-item__name item_name">Bánh Bông Lan Trứng Muối</h4>
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
                                        <button class="add-to-cart-btn btn_product_favourite" onclick="showCheckedIcon(this)">
                                            THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
         </div>
    `;
}
