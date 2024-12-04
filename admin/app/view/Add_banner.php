<!-- Add Banner Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Chỉnh sửa Banner</h6>
                <form action="index.php?page=add_banner" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="bannerImage" class="form-label">Hình ảnh</label>
                        <input class="form-control" type="file" id="bannerImage" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="bannerStatus" class="form-label">Trạng thái</label>
                        <select class="form-select" id="bannerStatus" name="status">
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bannerTag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="bannerTag" name="tag"
                            placeholder="Nhập tag cho banner">
                    </div>
                    <a href="index.php?page=banner" class="btn btn-danger">Quay lại</a>
                    <button type="submit" name="submit" class="btn btn-primary">Thêm banner</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Banner Form End -->