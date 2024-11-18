<!-- Bảng danh mục sản phẩm có nút thêm, sửa, xoá, xem, tìm kiếm -->
<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Danh Mục Sản Phẩm</h6>
                    <a href="index.php?page=addCategories" class="btn btn-primary">Thêm Mới</a>
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
                            <?php
                            foreach ($data['cate'] as $item) {
                                extract($item);
                                echo '<tr>
                                <td>' . $id . '</td>
                                <td>' . $name . '</td>
                                <td>
                                    <img src="../public/upload/category/' . $image . '" alt=""
                                        style="width: 40px; height: 40px" />
                                </td>
                                <td>
                                    <a href="index.php?page=edit_categories&id='.$id.'" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="index.php?page=delete_categories&id='.$id.'" class="btn btn-sm btn-danger">Xoá</a>
                                    <a href="index.php?page=view_categories&id='.$id.'" class="btn btn-sm btn-success">Xem</a>
                                </td>
                            </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>