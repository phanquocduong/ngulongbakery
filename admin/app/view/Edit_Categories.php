<!-- form edit category -->
<?php
extract($data['editcate']);
?>
<div class="container-fluid py-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h2 class="mb-4">
                        Sửa
                        <span class="text-primary">Danh Mục</span>
                    </h2>
                    <form action="index.php?page=editcate" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="hidden" name="existing_image" value="<?= $image ?>">
                        <div class="container-fluid px-4">
                            <div class="row">

                                <div class="col-12 col -lg-6">
                                    <?php
                                    require_once './app/model/CategoryModel.php';
                                    $categoryModel = new CategoryModel();
                                    $cateId = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                    $cate = $categoryModel->getIdCate($cateId);
                                    ?>
                                    <?php

                                    extract($cate);
                                    echo '<div class="card card-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên Danh Mục</label>
                                            <input type="text" class="form-control" name="name" id="name" value="' . $name . '" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" name="image" class="form-label">Hình Ảnh</label><br />
                                            <img src="../public/upload/category/' . $image . '" alt=""
                                                style="width: 100px; height: 100px" /><br />
                                            <input class="form-control" name="image" type="file" id="image" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Mô Tả</label>
                                            <textarea class="form-control" name="description" id="description" rows="3"
                                                placeholder="Nhập mô tả">' . $description . '</textarea>
                                        </div>';
                                    ?>
                                    <div class="mb-3">
                                        <label for="parent" class="form-label">Loại danh mục</label>
                                        <select class="form-select" name="type" id="parent">
                                            <!-- <option selected>Chọn danh mục</option> -->
                                            <option value="Bài viết" <?= ($type == 'Tin tức' ? ' selected' : '')  ?>>Danh Mục Bài Viết</option>
                                            <option value="Sản phẩm" <?= ($type == 'Sản phẩm' ? ' selected' : '') ?>>Danh Mục Sản Phẩm</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select class="form-select" name="status" id="status">
                                            <option selected>Chọn trạng thái</option>
                                            <option value="1" <?= ($status == 1 ? ' selected' : '') ?>>Kích Hoạt</option>
                                            <option value="0" <?= ($status == 0 ? ' selected' : '') ?>>Không Kích Hoạt</option>
                                        </select>
                                    </div>
                                    <div class="" style="display: flex;">
                                        <a href="index.php?page=categories" style="width: 150px;;background: red; border: none; margin: 0;" class="btn btn-custom">
                                            Quay lại
                                        </a>
                                        <button type="submit" style="width: 150px;;margin: 0 10px; border: none;" name="submit" class="btn btn-primary">
                                            Sửa
                                        </button>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
<!-- form edit category end -->