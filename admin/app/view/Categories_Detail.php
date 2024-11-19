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

            // Đếm số lượng sản phẩm và bài viết theo ID danh mục
            $countProducts = $categoryModel->countProductsByCategoryId($categoryId);
            $countPosts = $categoryModel->countPostsByCategoryId($categoryId);

            // Lấy danh sách sản phẩm và bài viết theo ID danh mục
            $products = $categoryModel->getProductsByCategoryId($categoryId);
            $posts = $categoryModel->getPostsByCategoryId($categoryId);

            ?>

        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                
                <?php
                if ($countProducts < 0 && $countPosts < 0) {
                    echo '<thead>
                            <tr class="text-dark">
                                <th scope="col">STT</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Hành Động</th>
                            </tr>
                          </thead>
                          <tbody>';
                    echo '<tr><td colspan="5" class="text-center">Không có sản phẩm nào</td></tr>';
                } 
                
                elseif ($countProducts > 0) {
                    echo '<thead>
                            <tr class="text-dark">
                                <th scope="col">STT</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>';
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
                }elseif ($countPosts > 0) {
                    echo '<thead>
                            <tr class="text-dark">
                                <th scope="col">STT</th>
                                <th scope="col">Tên Bài viết</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col">Tác giả</th>
                                <th scope="col">Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>';
                    foreach ($posts as $index => $item) {
                        extract($item);
                        
                        echo '<tr>';
                        echo '<td>' . ($index + 1) . '</td>';
                        echo '<td>' . $title . '</td>';
                        echo '<td>' . $category_name. '</td>';
                        echo '<td>' . $author_name. '</td>';
                        echo '<td>
                                <a class="btn btn-sm btn-primary" href="index.php?page=post_detail&id=' . $item['id'] . '">Xem chi tiết</a>
                                <a class="btn btn-sm btn-primary" href="index.php?page=edit_post&id=' . $item['id'] . '">Sửa</a>
                                <a class="btn btn-sm btn-danger" href="index.php?page=delete_posts&id=' . $item['id'] . '">Xóa</a>
                            </td>';
                        echo '</tr>';
                    }
                }else {
                    
                }
                ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>