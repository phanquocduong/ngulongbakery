<!-- body start -->
<?php
 require_once './app/model/UserModel.php';
 $userModel = new UserModel();
 $userId = isset($_GET['id']) ? intval($_GET['id']) : 0;
 $user = $userModel->getIdUser($userId);
 print_r($userId);
extract($data['editaccountDetail']);
?>
<form action="index.php?page=editaccount" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">  
    <div class="container-fluid py-4 px-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">Sửa Chi Tiết Tài Khoản</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col -lg-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img id="profile-image" name="image" src="../public/upload/avatar/<?=$avatar?>" alt="Profile Image"
                                            class="rounded-circle" style="
                                width: 100px;
                                height: 100px;
                                cursor: pointer;
                              " />
                                        <input type="file" id="image-upload" style="display: none" accept="image/*" />
                                        <h5 class="mt-3"><?php echo $full_name?></h5>
                                        <?php
                                        if($role_id==1){
                                        echo '<p class="text-muted">Admin</p>';
                                        }else{
                                            echo '<p class="text-muted">Người dùng</p>';
                                        }
                                        ?>
                                        <div class="d-flex justify-content-center">
                                            <a href="index.php?page=accounts" class="btn btn-primary">Quay lại</a>
                                            <button type="submit" name="submit" class="btn btn-danger ms-2">Lưu thông tin</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col -lg-8">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Thông Tin</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Họ và Tên</label>
                                                    <input type="text" class="form-control" id="name" name="full_name"
                                                        value="<?php echo $full_name?>" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="<?php echo $email?>" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        value="<?php echo $phone?>" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Địa Chỉ</label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        value="<?php echo $address?>" />
                                                </div>
                                            </div>
                                            <div class="col-12 col -lg-6">
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Vai Trò</label>
                                                    <select class="form-select" name="role_id" id="role">
                                                        <option value="1" <?= ($role_id == '1' ? ' selected' : '')  ?> >Admin</option>
                                                        <option value="0" <?= ($role_id == '0' ? ' selected' : '') ?> >Nguời dùng</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col -lg-6">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Trạng thái</label>
                                                    <select class="form-select" name="status" id="status">
                                                        <option value="1" <?= ($status == '1' ? ' selected' : '')  ?> >Đang hoạt động</option>
                                                        <option value="0" <?= ($status == '0' ? ' selected' : '') ?> >Đã tắt</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- body end -->