<!-- Bảng danh mục sản phẩm -->
<style>
    /* lọc danh mục */
    #category-filter {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
        font-size: 16px;
        width: 200px;
        margin: 10px 0 0 25px;
        color: #757575;
        background-color: white;
    }

    #category-filter:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }
</style>
<?php
require_once './app/controller/AdCategoriesController.php';
require_once './app/model/CategoryModel.php';

$categoriesController = new AdCategoriesController();
$productsModel = new CategoryModel();

$type = isset($_GET['type']) ? $_GET['type'] : 0;

if ($type == 1) {
    // Lọc danh mục sản phẩm
    $listCate = $categoriesController->getCategoriesByType('Sản phẩm');
} elseif ($type == 2) {
    // Lọc danh mục tin tức
    $listCate = $categoriesController->getCategoriesByType('Tin tức');
} else {
    // Hiển thị tất cả danh mục
    $listCate = $productsModel->getCate();
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Quản lí danh Mục</h6>
                    <a href="index.php?page=addCategories" class="btn btn-primary">Thêm Mới</a>
                </div>
                <!-- form search -->
                <form class="d-none d-md-flex ms-4" method="POST">
                    <div class="input-group">
                        <input class="form-control border-0" type="search" placeholder="Tìm kiếm danh mục"
                            name="search_category" />
                        <button class="btn" name="button_category">
                            <span class="input-group-text bg-transparent border-0">
                                <a href="index.php?page=search_category"><i class="fa fa-search"></i></a>
                            </span>
                        </button>
                    </div>
                </form>
                <!-- lọc danh mục -->
                <form action="index.php" method="GET">
                    <select name="type" id="category-filter" onchange="this.form.submit()">
                        <option value="0" <?php echo ($type == 0) ? 'selected' : ''; ?>>Tất cả</option>
                        <option value="1" <?php echo ($type == 1) ? 'selected' : ''; ?>>Danh mục sản phẩm</option>
                        <option value="2" <?php echo ($type == 2) ? 'selected' : ''; ?>>Danh mục tin tức</option>
                    </select>
                </form>

                <script>
                    document.getElementById('category-filter').addEventListener('change', function () {
                        this.form.submit();
                    });
                </script>
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
                <?php
                require_once './app/controller/AdCategoriesController.php';
                require_once './app/model/CategoryModel.php';

                $categoriesController = new AdCategoriesController();
                $productsModel = new CategoryModel();

                $type = isset($_GET['type']) ? $_GET['type'] : 0;

                if ($type == 1) {
                    // Lọc danh mục sản phẩm
                    $listCate = $categoriesController->getCategoriesByType('Sản phẩm');
                } elseif ($type == 2) {
                    // Lọc danh mục tin tức
                    $listCate = $categoriesController->getCategoriesByType('Tin tức');
                } else {
                    // Hiển thị tất cả danh mục
                    $listCate = $productsModel->getCate();
                }
                ?>



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
                            if (!empty($listCate)) {
                                foreach ($listCate as $index => $category) {
                                    echo '<tr>';
                                    echo '<td>' . ($index + 1) . '</td>';
                                    echo '<td>' . $category['name'] . '</td>';
                                    if ($category['image'] != '') {
                                        echo '<td><img src="../public/upload/category/' . $category['image'] . '" alt="" style="width: 50px; height: 50px"></td>';
                                    } else {
                                        echo ' <td><i class="fas fa-pen fa-3x"></i></td>';
                                    }
                                    echo '<td>' . $category['type'] . '</td>';
                                    if ($category['status'] == 1) {
                                        echo '<td><span class="badge bg-success">Hiển thị</span></td>';
                                    } else {
                                        echo '<td><span class="badge bg-danger">Ẩn</span></td>';
                                    }
                                    echo '<td>
                            <a href="index.php?page=view_categories&id=' . $category['id'] . '" class="btn btn-sm btn-primary">Xem</a>
                            <a href="index.php?page=edit_categories&id=' . $category['id'] . '" class="btn btn-sm btn-primary">Sửa</a>
                            <a href="javascript:void(0);" onclick="confirmDelete(' . $category['id'] . ')" class="btn btn-danger btn-sm">Xóa</a>
                          </td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6">Không có danh mục nào.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Lọc danh mục
    document.getElementById('category-filter').addEventListener('change', function () {
        var value = this.value;
        var url = 'index.php?page=categories';
        if (value == 1) {
            url = 'index.php?page=categories&type=1';
        } else if (value == 2) {
            url = 'index.php?page=categories&type=2';
        }
        window.location.href = url;
    });

    // Xác nhận xóa
    function confirmDelete(id) {
        if (confirm('Bạn có chắc chắn muốn xóa danh mục này không?')) {
            window.location.href = 'index.php?page=delete_categories&id=' + id;
        }
    }
</script>