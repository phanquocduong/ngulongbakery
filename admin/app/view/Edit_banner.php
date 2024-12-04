

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Chỉnh sửa Banner</h6>
                <form action="index.php?page=edit_banner" method="post" enctype="multipart/form-data">
                <?php
                    require_once './app/model/BannerModel.php';
                    $bannerModel = new BannerModel();
                    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                    $banner = $bannerModel->getIdBanner($id);

                    if (!$banner) {
                        echo '<script>alert("Không tìm thấy banner!"); location.href="index.php?page=banner";</script>';
                        exit;
                    }

                    $id = $banner['id'];
                    $image = $banner['image'];
                    $status = $banner['status'];
                    $tag = $banner['tag'];
                ?>
                <form action="index.php?page=edit_banner" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($image) ?>">

                    <div class="mb-3">
                        <label for="bannerImage" class="form-label">Hình ảnh</label> <br>
                        <img src="../public/upload/banner/<?= htmlspecialchars($image) ?>" alt="" width="300px"> <br><br>
                        <input class="form-control" type="file" id="bannerImage" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="bannerStatus" class="form-label">Trạng thái</label>
                        <select class="form-select" id="bannerStatus" name="status">
                            <option value="1" <?= ($status === 1 || $status === '1') ? 'selected' : '' ?>>Hiện</option>
                            <option value="0" <?= ($status === 0 || $status === '0') ? 'selected' : '' ?>>Ẩn</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bannerTag" class="form-label">Tag</label>
                        <input type="text" class="form-control" id="bannerTag" name="tag" value="<?= htmlspecialchars($tag) ?>" placeholder="Nhập tag cho banner">
                    </div>

                    <a href="index.php?page=banner" class="btn btn-danger">Quay lại</a>
                    <button type="submit" name="submit" class="btn btn-primary">Cập nhật banner</button>
                </form>
            </div>
        </div>
    </div>
</div>

