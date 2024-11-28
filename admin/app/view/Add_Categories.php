<!-- content start -->
<!-- form add categories -->
<form action="index.php?page=addCate" method="POST" enctype="multipart/form-data">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12 col -lg-6">
                <div class="card card-body">
                    <h5 class="mb-4">Thêm Danh Mục</h5>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Danh Mục</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục" required />
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình Ảnh</label>
                        <input class="form-control" name="image" type="file" id="image" required/>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Nhập mô tả" required></textarea>
                    </div>
                    <di class="mb-3">
                        <label for="parent" class="form-label">Loại danh mục</label>
                        <select class="form-select" name="type" id="type" required>
                            <option selected>Chọn danh mục</option>
                            <option value="Tin tức">Danh Mục Bài Viết</option>
                            <option value="Sản phẩm">Danh Mục Sản Phẩm</option>
                        </select>
                    </di>
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select class="form-select" name="status" id="status" required>
                            <option selected>Chọn trạng thái</option>
                            <option value="1">Kích Hoạt</option>
                            <option value="0">Không Kích Hoạt</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
                    <br />
                </div>
            </div>
        </div>
    </div>
</form>
<a href="index.php?page=categories" class="btn btn-custom">
    Quay lại
</a>
<!-- conttent end -->