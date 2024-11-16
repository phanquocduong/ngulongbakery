<!-- Content Start -->
<?php
require_once './app/model/CategoryModel.php';
$categoryModel = new CategoryModel();

// Lấy ID danh mục từ URL
$categoryId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category = $categoryModel->getCategoryById($categoryId);

// Lấy danh sách sản phẩm theo ID danh mục
$products = $categoryModel->getProductsByCategoryId($categoryId);

// Đếm số lượng sản phẩm theo ID danh mục (nếu cần)
$countProduct = $categoryModel->countProductsByCategoryId($categoryId);
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center mb-4">
            <a href="index.php?page=categories" class="btn nav-link" style="margin-right: 50px">Quay lại</a>
            <!-- <h4 class="mb-0">Danh Mục Bánh Bông Lan</h4> -->
             <?php
             extract($category);
            if ($countProduct > 0) {
                echo '<h4 class="mb-0">Danh Sách Sản Phẩm Danh Mục '. $name.'</h4>';
            } else {
                echo '<h4 class="mb-0">Không có sản phẩm nào</h4>';
            }
            ?>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">STT</th>
                        <th scope="col">Tên Sản Phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach ($products as $item) {
                        extract($item);
                        echo '<tr>
                            <td>' . $id . '</td>
                            <td>' . $name . '</td>
                            <td>' . $price . ' VND</td>
                            <td>' . $stock_quantity . '</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="index.php?page=products_detail&id=' . $item['id'] . '">Xem chi tiết</a>
                                <a class="btn btn-sm btn-primary" href="index.php?page=edit_products&id=' . $item['id'] . '">Sửa</a>
                                <a class="btn btn-sm btn-danger" href="index.php?page=del_products&id=' . $item['id'] . '">Xóa</a>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>