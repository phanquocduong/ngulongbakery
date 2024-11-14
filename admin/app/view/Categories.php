<!-- Bảng danh mục sản phẩm có nút thêm, sửa, xoá, xem, tìm kiếm -->
<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Danh Mục Sản Phẩm</h6>
                    <a href="addCategories.html" class="btn btn-primary">Thêm Mới</a>
                </div>
                <!-- form search -->
                <form class="d-none d-md-flex ms-4">
                    <div class="input-group">
                        <input class="form-control border-0" type="search" placeholder="Tìm kiếm danh mục" />
                        <button class="btn">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fa fa-search"></i>
                            </span>
                        </button>
                    </div>
                </form>
                <br />
                <!-- form search end -->
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Danh Mục</th>
                                <th>Ảnh</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Bánh Bông Lan</td>
                                <td>
                                    <img src="img/products/banhkem-bong-lan.webp" alt=""
                                        style="width: 40px; height: 40px" />
                                </td>
                                <td>
                                    <a href="edit_categories.html" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="#" class="btn btn-sm btn-danger">Xoá</a>
                                    <a href="view_categories.html" class="btn btn-sm btn-success">Xem</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Bánh Bò</td>
                                <td>
                                    <img src="img/products/banh-bo.webp" alt="" style="width: 40px; height: 40px" />
                                </td>
                                <td>
                                    <a href="edit-category.html" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="#" class="btn btn-sm btn-danger">Xoá</a>
                                    <a href="view-category.html" class="btn btn-sm btn-success">Xem</a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Bánh Mì</td>
                                <td>
                                    <img src="img/products/banh-mi.jpg" alt="" style="width: 40px; height: 40px" />
                                </td>
                                <td>
                                    <a href="edit-category.html" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="#" class="btn btn-sm btn-danger">Xoá</a>
                                    <a href="view-category.html" class="btn btn-sm btn-success">Xem</a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Bánh Trung Thu</td>
                                <td>
                                    <img src="img/products/banh_trung_thu_nhan_dau_xanh-300x300.webp" alt=""
                                        style="width: 40px; height: 40px" />
                                </td>
                                <td>
                                    <a href="edit-category.html" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="#" class="btn btn-sm btn-danger">Xoá</a>
                                    <a href="view-category.html" class="btn btn-sm btn-success">Xem</a>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Bánh Da Lợn</td>
                                <td>
                                    <img src="img/products/banh-da-lon.jpg" alt="" style="width: 40px; height: 40px" />
                                </td>
                                <td>
                                    <a href="edit-category.html" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="#" class="btn btn-sm btn-danger">Xoá</a>
                                    <a href="view-category.html" class="btn btn-sm btn-success">Xem</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>