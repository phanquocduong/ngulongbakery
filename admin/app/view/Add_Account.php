<!-- body start -->
<form action="" class="form-label">
    <div class="container-fluid py-4 px-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">Thêm Tài Khoản</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col -lg-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img id="profile-image" src="img/user1.jpg" alt="Tải lên Hình Ảnh"
                                            class="rounded-circle" style="
                                width: 100px;
                                height: 100px;
                                cursor: pointer;
                              " />
                                        <input type="file" id="image-upload" style="display: none" accept="image/*" />
                                        <h5 class="mt-3">Tải Lên Hình Ảnh</h5>
                                        <p class="text-muted"></p>
                                        <div class="d-flex justify-content-center">
                                            <a href="accounts_manage.html" class="btn btn-primary">Quay lại</a>
                                            <button class="btn btn-danger ms-2">Thêm Tài Khoản</button>
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
                                                    <input type="text" class="form-control" id="name" value="" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" value="" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                                    <input type="text" class="form-control" id="phone" value="" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Địa Chỉ</label>
                                                    <input type="text" class="form-control" id="address" value="" />
                                                </div>
                                            </div>
                                            <div class="col-12 col -lg-6">
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Vai Trò</label>
                                                    <select class="form-select" id="role">
                                                        <option selected>Chọn vai trò</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col -lg-6">
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Trạng thái</label>
                                                    <select class="form-select" id="role" disabled>
                                                        <option selected>Thiết lập trạng thái</option>
                                                        <option value="0" selected>Đang Hoạt động</option>
                                                        <option value="1">Đã tắt</option>
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