<div class="contact_main">

    <div class="contact_main-box">
        <div class="row">
            <div class="contact_main-box-img col l-6 c-9 m-6">
                <form action="index.php?page=sumbit-getcontact" method="post">
                    <div class="contact_main-box-in-input" style="border-image-source: url(https://t4.ftcdn.net/jpg/08/44/76/91/360_F_844769159_YK4xuiJGP0fmBumMpXVUEk9I2LDEhAEX.jpghttps://as1.ftcdn.net/v2/jpg/06/44/71/32/1000_F_644713254_L42ARbrHjlRKNHnG3ryhwu1G2eZS12g0.jpg);">
                        <h1 style="color: rgb(240, 179, 81);">Liên hệ</h1>
                        <input type="email" name="email" rules="required|email" required id="usermail"
                            <?php /* kiem tra dang nhap  */

                            if (isset($_SESSION['user'])) {
                                echo 'value = ' . $_SESSION['user']['email'] . '';
                            } else {
                                echo 'disabled value= "vui lòng đăng nhập" style="color:red"';
                            } ?> placeholder="Nhập email">


                        <input type="number" name="name" required id="" placeholder="Nhập số điện thoại"
                            <?php /* kiem tra dang nhap  */

                            if (isset($_SESSION['user'])) {
                                echo 'value = ' . $_SESSION['user']['phone'] . '';
                            } else {
                                echo 'disabled value= "vui lòng đăng nhập" style="color:red"';
                            } ?>>
                        <select name="select-fix" id="" class="contact_main-box-in-input-select">
                            <option value="hotro">Hỗ trợ khách hàng</option>
                            <option value="hotro">Báo lỗi hệ thống</option>
                            <option value="hotro">Lỗi tài khoản</option>
                        </select>
                        <textarea id="comments" required name="comments" placeholder="nhập tin nhắn"></textarea>
                        <div class="contact_main-box-in-details-btn"> <input type="submit" value="gửi tin nhắn" class="buy-now-btn--bigger" style="color: #fff;" name="" id=""></div>
                    </div>
                </form>
            </div>
            <div class="contact_main-box-in col l-6 c-9 m-6">
                <ul class="contact_main-box-in-ul">

                    <li class="contact_main-box-in-ul-li">
                        Chi tiết về giờ phục vụ hàng ngày của chúng tôi
                    </li>
                </ul>
                <div class="contact_main-box-in-details">
                    Ngũ Long Bakery hoạt động hàng ngày từ 8:00 sáng đến 8:00 tối. Chúng tôi luôn sẵn sàng chào đón
                    bạn đến để thưởng thức những chiếc bánh chất lượng ưu việt.
                    <ul class="contact_main-box-in-details-ul">
                        <li class="contact_main-box-in-details-ul-li">
                            <p> – Email: ngulongbakery@gmail.com </p>
                        </li>
                        <li class="contact_main-box-in-details-ul-li">
                            <p> – Hotline: 0828283169 </p>
                        </li>
                    </ul>
                    <div class="contact_main-box-in-details-btn"> <button class="buy-now-btn--bigger"
                            style="border-radius: 0%;">XEM BẢN ĐỒ</button></div>
                </div>

            </div>
        </div>

    </div>
</div>