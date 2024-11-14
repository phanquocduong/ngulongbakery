<!-- form edit category -->
<div class="container-fluid py-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h2 class="mb-4">
                        Sửa
                        <span class="text-primary">Danh Mục</span>
                    </h2>
                    <form action="">
                        <div class="container-fluid px-4">
                            <div class="row">
                                <div class="col-12 col -lg-6">
                                    <div class="card card-body">
                                        <!-- <h5 class="mb-4">Thêm Danh Mục</h5> -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên Danh Mục</label>
                                            <input type="text" class="form-control" id="name" value="Bánh Mì" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Hình Ảnh</label>
                                            <input class="form-control" type="file" id="image" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Mô Tả</label>
                                            <textarea class="form-control" id="description" rows="3"
                                                placeholder="Nhập mô tả">Danh mục cho sản phẩm và bài viết liên quan tới bánh mì.</textarea>
                                        </div>
                                        <di class="mb-3">
                                            <label for="parent" class="form-label">Loại danh mục</label>
                                            <select class="form-select" id="parent">
                                                <option selected>Chọn danh mục</option>
                                                <option value="1">Danh Mục Bài Viết</option>
                                                <option value="2" selected>Danh Mục Sản Phẩm</option>
                                            </select>
                                        </di>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Trạng Thái</label>
                                            <select class="form-select" id="status">
                                                <option selected>Chọn trạng thái</option>
                                                <option value="1" selected>Kích Hoạt</option>
                                                <option value="0">Không Kích Hoạt</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            Thêm
                                        </button>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <a href="categories.html" class="btn btn-custom">
                        Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- form edit category end -->