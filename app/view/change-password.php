<!-- Start main -->
        <main>
            <form action="<?=$base_url?>/handle-change-password" method="POST" class="change-password-form">
                <h4 class="change-password-title">Đổi mật khẩu</h4>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="errors">
                        <ul>
                            <li><?=$_SESSION['error']?></li>
                        </ul>
                    </div>
                <?php 
                    unset($_SESSION['error']);
                    endif; 
                ?>
                <div class="form-group current-password-form">
                    <label for="currentPassword" class="form-label">MẬT KHẨU HIỆN TẠI</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="currentPassword"
                            name="currentPassword"
                            rules="required"
                            class="form-control"
                            placeholder="Nhập mật khẩu hiện tại"
                        />
                        <button type="button" class="toggle-password" onclick="togglePassword('currentPassword', this)"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                    <div class="form-message"></div>
                </div>
                <div class="form-group new-password-form">
                    <label for="newPassword" class="form-label">MẬT KHẨU MỚI</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="newPassword"
                            name="newPassword"
                            rules="required|min:8|passwordComplexity"
                            class="form-control"
                            placeholder="Nhập mật khẩu mới"
                        />
                        <button type="button" class="toggle-password" onclick="togglePassword('newPassword', this)"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                    <div class="form-message"></div>
                </div>
                <div class="form-group confirm-password-form">
                    <label for="confirmPassword" class="form-label">XÁC NHẬN MẬT KHẨU</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="confirmPassword"
                            name="confirmPassword"
                            rules="required"
                            class="form-control"
                            placeholder="Nhập lại mật khẩu mới"
                        />
                        <button type="button" class="toggle-password" onclick="togglePassword('confirmPassword', this)"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                    <div class="form-message"></div>
                </div>
                <div class="update-action">
                    <button class="update-btn">Lưu</button>
                    <div class="back-account-title">
                        Trở lại
                        <span class="back-account-title__link"><a href="<?=$base_url?>/account">Tài khoản</a></span>
                    </div>
                </div>
            </form>
        </main>
        <!-- End main -->