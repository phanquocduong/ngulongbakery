<main>
    <form action="<?=$base_url?>/handle-change-password" method="POST" class="change-password-form <?=(isset($_GET['page']) && ($_GET['page'] == 'change-password' || $_GET['page'] == 'handle-change-password')) ? 'active' : '' ?>">
        <h4 class="change-password-title">Đổi mật khẩu</h4>
        <?php if(isset($_SESSION['change-error'])): ?>
            <div class="errors">
                <ul>
                    <li><?=$_SESSION['change-error']?></li>
                </ul>
            </div>
        <?php 
            unset($_SESSION['change-error']);
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
                    value="<?=isset($_POST['currentPassword']) ? $_POST['currentPassword'] : ''?>"
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
                    value="<?=isset($_POST['newPassword']) ? $_POST['newPassword'] : ''?>"
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
                    id="confirmNewPassword"
                    name="confirmNewPassword"
                    rules="required"
                    class="form-control"
                    placeholder="Nhập lại mật khẩu mới"
                    value="<?=isset($_POST['confirmNewPassword']) ? $_POST['confirmNewPassword'] : ''?>"
                />
                <button type="button" class="toggle-password" onclick="togglePassword('confirmNewPassword', this)"><i class="fa-solid fa-eye-slash"></i></button>
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
    <form action="<?=$base_url?>/handle-reset-password" method="POST" class="reset-password-form <?=(isset($_GET['page']) && ($_GET['page'] == 'reset-password' || $_GET['page'] == 'handle-reset-password')) ? 'active' : '' ?>">
        <h4 class="reset-password-title">Đặt lại mật khẩu</h4>
        <?php if(isset($_SESSION['reset-error'])): ?>
            <div class="errors">
                <ul>
                    <li><?=$_SESSION['reset-error']?></li>
                </ul>
            </div>
        <?php 
            unset($_SESSION['reset-error']);
            endif; 
        ?>
        <input type="hidden" name="resetCode" value="<?= (isset($_GET['code'])) ? $_GET['code'] : $data['resetCode'] ?>" />
        <div class="form-group new-password-form">
            <label for="newPassword" class="form-label">MẬT KHẨU MỚI</label>
            <div class="password-wrapper">
                <input
                    type="password"
                    id="resetPassword"
                    name="resetPassword"
                    rules="required|min:8|passwordComplexity"
                    class="form-control"
                    placeholder="Nhập mật khẩu mới"
                    value="<?=isset($_POST['resetPassword']) ? $_POST['resetPassword'] : ''?>"
                />
                <button type="button" class="toggle-password" onclick="togglePassword('resetPassword', this)"><i class="fa-solid fa-eye-slash"></i></button>
            </div>
            <div class="form-message"></div>
        </div>
        <div class="form-group confirm-password-form">
            <label for="confirmPassword" class="form-label">XÁC NHẬN MẬT KHẨU</label>
            <div class="password-wrapper">
                <input
                    type="password"
                    id="confirmResetPassword"
                    name="confirmResetPassword"
                    rules="required"
                    class="form-control"
                    placeholder="Nhập lại mật khẩu"
                    value="<?=isset($_POST['confirmResetPassword']) ? $_POST['confirmResetPassword'] : ''?>"
                />
                <button type="button" class="toggle-password" onclick="togglePassword('confirmResetPassword', this)"><i class="fa-solid fa-eye-slash"></i></button>
            </div>
            <div class="form-message"></div>
        </div>
        <div class="update-action">
            <button class="update-btn">Lưu</button>
        </div>
    </form>
</main>