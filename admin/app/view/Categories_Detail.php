<!-- Content Start -->

<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center mb-4">
            <a href="categories.html" class="btn nav-link" style="margin-right: 50px">Quay lại</a>
            <h4 class="mb-0">Danh Mục Bánh Bông Lan</h4>
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
                    $stt=1;
                    foreach ($data['procate'] as $item){
                        extract($item);
                        echo '<tr>
                        <td>'.$stt++.'</td>
                        <td>'.$name.'</td>
                        <td>'.$price.'VND</td>
                        <td>'.$stock_quantity.'</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="index.php?page=products_detail">Xem chi tiết</a>
                            <a class="btn btn-sm btn-primary" href="index.php?page=edit_products">Sửa</a>
                            <a class="btn btn-sm btn-danger" href="#">Xóa</a>
                        </td>
                    </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Content End -->