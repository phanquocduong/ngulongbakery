<!-- Start main -->
        <main>
            <form action="index.php?page=handle-reset-password" method="POST" class="reset-password-form">
                <h4 class="reset-password-title">Đặt lại mật khẩu</h4>
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
                <input type="hidden" name="resetCode" value="<?= $_GET['code'] ?>" />
                <div class="form-group new-password-form">
                    <label for="newPassword" class="form-label">MẬT KHẨU MỚI</label>
                    <input
                        type="password"
                        id="newPassword"
                        name="newPassword"
                        rules="required|min:8|passwordComplexity"
                        class="form-control"
                        placeholder="Nhập mật khẩu mới"
                    />
                    <div class="form-message"></div>
                </div>
                <div class="form-group confirm-password-form">
                    <label for="confirmPassword" class="form-label">XÁC NHẬN MẬT KHẨU</label>
                    <input
                        type="password"
                        id="confirmPassword"
                        name="confirmPassword"
                        rules="required|min:8|passwordComplexity"
                        class="form-control"
                        placeholder="Nhập lại mật khẩu"
                    />
                    <div class="form-message"></div>
                </div>
                <div class="update-action">
                    <button class="update-btn">Lưu</button>
                </div>
            </form>
        </main>
        <!-- End main -->