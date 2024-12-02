    <!-- Edit Banner Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Chỉnh sửa Banner</h6>
                    <form action="update_banner.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="bannerImage" class="form-label">Hình ảnh</label> <br>
                            <img src="../public/upload/banner/banner-collection.png" alt="" width="300px"> <br><br>
                            <input class="form-control" type="file" id="bannerImage" name="bannerImage">
                        </div>
                        <div class="mb-3">
                            <label for="bannerStatus" class="form-label">Trạng thái</label>
                            <select class="form-select" id="bannerStatus" name="bannerStatus">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bannerTag" class="form-label">Tag</label>
                            <input type="text" class="form-control" id="bannerTag" name="bannerTag" placeholder="Nhập tag cho banner">
                        </div>
                        <a href="index.php?page=banner" class="btn btn-danger" >Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật banner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Banner Form End -->