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
                <form class="d-none d-md-flex ms-4" method="POST">
                    <div class="input-group">
                        <input class="form-control border-0" type="search" placeholder="Tìm kiếm danh mục" name="search_category"/>
                        <button class="btn" name="button_category">
                            <span class="input-group-text bg-transparent border-0">
                                <a href="index.php?page=search_category"><i class="fa fa-search"></i></a>
                            </span>                            
                        </button>
                    </div>
                </form>
                <br />
                <?php
                    require_once './app/controller/AdCategoriesController.php';
                    require_once './app/model/CategoryModel.php';
                    $categoriesController = new AdCategoriesController();
                    $productsModel = new CategoryModel();
                    if (isset($_POST['button_category']) && !empty($_POST['search_category'])) {
                    $listCate = $categoriesController->searchCategories($_POST['search_category']);
                    } else {
                    // Fetch all products if no search term is provided
                    $listCate = $productsModel->getCate();
                    }
                ?>

                <!-- form search end -->
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Danh Mục</th>
                                <th>Ảnh</th>
                                <th>Loại danh mục</th>
                                <th>Trạng thái</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            foreach ($listCate as $key => $value) {
                                extract($value);
                                echo '<tr>
                                <td>' . $stt++ . '</td>
                                <td>' . $name . '</td>
                                <td>
                                    <img src="../public/upload/category/' . $image . '" alt=""
                                        style="width: 40px; height: 40px" />
                                </td>
                                <td>' . $type . '</td>';
                                if($status == 1){
                                    echo '<td><span class="badge bg-success">Hiển Thị</span></td>';
                                }else{
                                    echo '<td><span class="badge bg-danger">Không hiển thị</span></td>';
                                };
                                echo'<td>
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