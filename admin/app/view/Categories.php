<!-- Bảng danh mục sản phẩm -->
<style>
    /* lọc danh mục */
    #category-filter {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: white;
        font-size: 16px;
        width: 200px;
        margin: 10px 0 0 25px;
        color: #757575;
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
$searchTerm = isset($_POST['search_category']) ? trim($_POST['search_category']) : '';

if (!empty($searchTerm)) {
    // Tìm kiếm danh mục
    $listCate = $categoriesController->searchCategories($searchTerm);
} elseif ($type == 1) {
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
                    <h6 class="mb-0">Quản lí danh mục</h6>
                    <a href="index.php?page=addCategories" class="btn btn-primary">Thêm Mới</a>
                </div>

                <!-- Form tìm kiếm -->
                <form class="d-flex" method="POST">
                    <div class="input-group">
                        <input class="form-control border-0" type="search" placeholder="Tìm kiếm danh mục"
                            name="search_category" value="<?php echo htmlspecialchars($searchTerm); ?>" />
                        <button class="btn btn-primary" type="submit" name="button_category">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Lọc danh mục -->
               <form action="index.php" method="GET">
                <input type="hidden" name="page" value="categories" >
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
                                echo '<td><span class="badge ' . ($status == 1 ? 'bg-success' : 'bg-danger') . '">' . ($status == 1 ? 'Hiển Thị' : 'Không hiển thị') . '</span></td>';
                                echo '<td>
                                    <a href="index.php?page=edit_categories&id=' . $id . '" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="javascript:confirmDelete(' . $id . ');" class="btn btn-sm btn-danger">Xoá</a>
                                    <a href="index.php?page=view_categories&id=' . $id . '" class="btn btn-sm btn-success">Xem</a>
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

<script>
    // Xác nhận xóa
    function confirmDelete(id) {
        if (confirm('Bạn có chắc chắn muốn xóa danh mục này không?')) {
            window.location.href = 'index.php?page=delete_categories&id=' + id;
        }
    }
</script>