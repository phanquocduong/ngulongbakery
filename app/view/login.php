<!-- Start main -->
        <main>
            <form action="index.php?page=handle-login" method="POST" id="loginForm" class="login-form <?= (isset($_SESSION['error']) && $_SESSION['error'] == 'Email không tồn tại.') ? '' : 'login-form--active' ?>">
                <h4 class="login-title">Đăng nhập</h4>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="errors">
                        <ul>
                            <li><?=$_SESSION['error']?></li>
                        </ul>
                    </div>
                <?php 
                    endif; 
                ?>
                <div class="form-group email-form">
                    <label for="customerEmail" class="form-label">EMAIL</label>
                    <input
                        type="email"
                        id="customerEmail"
                        name="customerEmail"
                        rules="required|email"
                        class="form-control"
                        placeholder="Nhập Email của bạn"
                    />
                    <div class="form-message"></div>
                </div>
                <div class="form-group password-form">
                    <label for="customerPassword" class="form-label">MẬT KHẨU</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="customerPassword"
                            name="customerPassword"
                            rules="required"
                            class="form-control"
                            placeholder="Nhập Mật khẩu"
                        />
                        <button type="button" class="toggle-password" onclick="togglePassword('customerPassword', this)"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                    <div class="form-message"></div>
                </div>
                <div class="remember-me-box">
                    <input name="rememberMe" id="rememberMe" type="checkbox" class="remember-me__check-box" />
                    <label for="rememberMe" class="remember-me__label">Nhớ mật khẩu?</label>
                </div>
                <div class="login-action">
                    <button class="login-btn">Đăng nhập</button>
                    <div class="register-title">
                        Bạn chưa có tài khoản?
                        <a href="index.php?page=register" class="register-title__link">Đăng ký ngay</a>
                    </div>
                    <span class="forgot-pass__link" onclick="openForgotPassForm()">Quên mật khẩu?</span>
                </div>
            </form>

            <form action="index.php?page=handle-forgot-pass" method="POST" id="forgotPassForm" class="forgot-pass-form <?= (isset($_SESSION['error']) && $_SESSION['error'] == 'Email không tồn tại.') ? 'forgot-pass-form--active' : '' ?>">
                <h4 class="forgot-pass-title">Quên mật khẩu</h4>
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
                <div class="form-group email-form">
                    <label for="email" class="form-label">EMAIL</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        rules="required|email"
                        class="form-control"
                        placeholder="Nhập Email của bạn"
                    />
                    <div id="email-form-message" class="form-message"></div>
                </div>
                <div class="submit-action">
                    <button class="submit-btn">Gửi</button>
                    <div class="back-login-title">
                        Trở lại
                        <span class="back-login-title__link" onclick="openLoginForm()">Đăng nhập</span>
                    </div>
                </div>
            </form>
        </main>
        <!-- End main -->