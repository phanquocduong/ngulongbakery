<!-- Content Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center mb-4">
            <a href="index.php?page=categories" class="btn nav-link" style="margin-right: 50px">Quay lại</a>
            <!-- <h4 class="mb-0">Danh Mục Bánh Bông Lan</h4> -->
            <?php
            require_once './app/model/CategoryModel.php';
            $categoryModel = new CategoryModel();

            // Lấy ID danh mục từ URL
            $categoryId = isset($_GET['id']) ? intval($_GET['id']) : 0;

            // Lấy thông tin danh mục theo ID
            $category = $categoryModel->getIdCate($categoryId);

            // Đếm số lượng sản phẩm theo ID danh mục
            $countProduct = $categoryModel->countProductsByCategoryId($categoryId);

            // Lấy danh sách sản phẩm theo ID danh mục
            $products = $categoryModel->getProductsByCategoryId($categoryId);

            if ($category) {
                extract($category);
                if ($countProduct > 0) {
                    echo '<h4 class="mb-0">Danh Sách Sản Phẩm Danh Mục ' . $name . '</h4>';
                } else {
                    echo '<h4 class="mb-0">Không có sản phẩm nào</h4>';
                }
            } else {
                echo '<h4 class="mb-0">Không tìm thấy danh mục</h4>';
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
                if ($countProduct > 0) {
                    foreach ($products as $index => $item) {
                        echo '<tr>';
                        echo '<td>' . ($index + 1) . '</td>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td>' . number_format($item['price'], 0, ',', '.') . ' VND</td>';
                        echo '<td>' . $item['stock_quantity'] . '</td>';
                        echo '<td>
                                <a class="btn btn-sm btn-primary" href="index.php?page=products_detail&id=' . $item['id'] . '">Xem chi tiết</a>
                                <a class="btn btn-sm btn-primary" href="index.php?page=edit_products&id=' . $item['id'] . '">Sửa</a>
                                <a class="btn btn-sm btn-danger" href="index.php?page=delete_products&id=' . $item['id'] . '">Xóa</a>
                            </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5" class="text-center">Không có sản phẩm nào</td></tr>';
                }
                ?>
                    <!-- <tr>
                        <td>1</td>
                        <td>Bánh Bông Lan Trứng Muối</td>
                        <td>20,000 VND</td>
                        <td>50</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="index.php?page=products_detail">Xem chi tiết</a>
                            <a class="btn btn-sm btn-primary" href="index.php?page=edit_products">Sửa</a>
                            <a class="btn btn-sm btn-danger" href="#">Xóa</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bánh Kem Bông Lan Trứng Muối</td>
                        <td>15,000 VND</td>
                        <td>30</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="">Xem chi tiết</a>
                            <a class="btn btn-sm btn-primary" href="#">Sửa</a>
                            <a class="btn btn-sm btn-danger" href="#">Xóa</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Bánh Bông Lan Khét</td>
                        <td>25,000 VND</td>
                        <td>40</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="">Xem chi tiết</a>
                            <a class="btn btn-sm btn-primary" href="#">Sửa</a>
                            <a class="btn btn-sm btn-danger" href="#">Xóa</a>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>