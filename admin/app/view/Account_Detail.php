<!-- body Start -->
 <?php
 extract($data['accountDetail']);
 ?>
<div class="container-fluid py-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Chi Tiết Tài Khoản</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col -lg-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="img/meo.jpg" alt="" class="rounded-circle"
                                        style="width: 100px; height: 100px" />
                                    <h5 class="mt-3"><?php echo $full_name?></h5>
                                    <?php
                                    if($role_id==1){
                                       echo '<p class="text-muted">Admin</p>';
                                    }else{
                                        echo '<p class="text-muted">Người dùng</p>';
                                    }
                                    ?>
                                    <div class="d-flex justify-content-center">
                                        <a href="index.php?page=accounts" class="btn btn-primary me-2">Quay lại</a>
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
                                                <input type="text" class="form-control" id="name" value="<?php echo $full_name?>"
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    value="<?php echo $email?>" disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                                <input type="text" class="form-control" id="phone" value="<?php echo $phone?>"
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Địa Chỉ</label>
                                                <input type="text" class="form-control" id="address"
                                                    value="<?php echo $address?>"
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col -lg-6">
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Vai Trò</label>
                                                <?php
                                                if($role_id==1){
                                                    echo '<input type="text" class="form-control" id="role" value="Admin" disabled />';
                                                }else{
                                                    echo '<input type="text" class="form-control" id="role" value="Người dùng" disabled />';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col -lg-6">
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Trạng Thái</label>
                                                <?php
                                                if($status==1){
                                                    echo '<input type="text" class="form-control" id="role" value="Đang hoạt động" disabled />';
                                                }else{
                                                    echo '<input type="text" class="form-control" id="role" value="Đã tắt" disabled />';
                                                }
                                                ?>
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
<!-- body End -->