<!-- content start -->
<h2 class="text text-center text-padding">Chi Tiết Sản Phẩm</h2>
<div class="container-fluid pt-4 px-4">
  <div class="bg-light rounded p-4">
    <div class="table-responsive">
      <a href="index.php?page=products"><button class="btn btn-primary">Quay lại</button></a>
      <?php
      $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
      echo "<a href='index.php?page=edit_products&id=$product_id'><button class='btn btn-primary'>
          Sửa chi tiết sản phẩm
        </button></a>"
        ?>
      <a href=""><button class="btn btn-primary btn-danger">
          Xoá sản phẩm
        </button></a>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Giá</th>
            <th>Tên</th>
            <th>Giá giảm</th>
            <th>Hình ảnh</th>
            <th>Hình con</th>
            <th>Mô tả ngắn</th>
            <th>Mô tả chi tiết</th>
            <th>Số lượng hàng tồn kho</th>
            <th>Số lượt xem</th>
            <th>Thẻ</th>
            <th>Danh mục</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
          require_once './app/model/AdProductsModel.php';
          require_once './app/model/CategoryModel.php';

          $productsModel = new AdProductsModel();
          $cateModel = new CategoryModel();

          $product = $productsModel->getProductById($product_id);
          $listCate = $cateModel->getCate();

          // Tạo mảng ánh xạ từ ID danh mục sang tên danh mục
          $categoryMap = [];
          foreach ($listCate as $category) {
            $categoryMap[$category['id']] = $category['name'];
          }
          ?>
          <?php
          if ($product) {
            extract($product);
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$price</td>";
            echo "<td>$sale</td>";
            echo "<td><img src='../public/upload/product/$image' alt='' style='width: 50px; height: 50px' /></td>";
            // Tách chuỗi chứa tên các file ảnh thành mảng
            $imageArray = explode(',', $extra_image);
            echo "<td>";
            foreach ($imageArray as $image) {
              echo "<img src='../public/upload/product/$image' alt='' style='width: 50px; height: 50px' />";
            }
            echo "</td>";
            echo "<td>$short_description</td>";
            echo "<td>$detailed_description</td>";
            echo "<td>$stock_quantity</td>";
            echo "<td>$views</td>";
            echo "<td>$tags</td>";
            echo "<td>{$categoryMap[$category_id]}</td>";
            echo "</tr>";
          } else {
            echo "<tr><td colspan='12'>Không tìm thấy sản phẩm</td></tr>";
          }

          ?>
          <!-- <tr>
                    <td>1</td>
                    <td>Bánh mì thịt</td>
                    <td>100,000 VND</td>
                    <td>90,000 VND</td>
                    <td>
                      <img
                        src="img/products/banh-mi.jpg"
                        alt="Hình Sản Phẩm"
                        style="width: 50px; height: 50px"
                      />
                    </td>
                    <td>
                      <img
                        src="img/products/banhmi1.jpg"
                        alt="Hình Con"
                        style="width: 50px; height: 50px"
                      />
                      <img
                        src="img/products/banhmi2.jpg"
                        alt="Hình Con"
                        style="width: 50px; height: 50px"
                      />
                      <img
                        src="img/products/banhmi3.jpg"
                        alt="Hình Con"
                        style="width: 50px; height: 50px"
                      />
                    </td>
                    <td>Bánh mì ngon</td>
                    <td>Bánh mì ngon với hương vị đặc biệt</td>
                    <td>50</td>
                    <td>100</td>
                    <td>Bánh mì</td>
                    <td>Thực phẩm</td>
                  </tr> -->
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Product review -->
<h2 class="text text-center text-padding">Đánh Giá Sản Phẩm</h2>
<div class="container-fluid pt-4 px-4">
  <div class="bg-light rounded p-4">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên Người Dùng</th>
            <th>Đánh Giá Sao</th>
            <th>Nội Dung Đánh Giá</th>
            <th>Ngày</th>
            <th>Đánh Dấu</th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Con Mèo Ngu Ngốc</td>
            <td class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="bi bi-star"></i>
            </td>
            <td>Sản phẩm rất tốt</td>
            <td>08-11-2024</td>
            <td>
              <button class="btn toggle-star">
                <i class="fa fa-star"></i>
              </button>
            </td>
            <td><button class="btn btn-danger">Xoá</button></td>
          </tr>
          <tr>
            <td>2</td>
            <td>Tran Thi Đẹp</td>
            <td class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="bi bi-star"></i>
            </td>
            <td>Giá cả hợp lý</td>
            <td>08-11-2024</td>
            <td>
              <button class="btn toggle-star">
                <i class="fa fa-star"></i>
              </button>
            </td>
            <td><button class="btn btn-danger">Xoá</button></td>
          </tr>
          <tr>
            <td>3</td>
            <td>Con Sói Cô Độc</td>
            <td class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </td>
            <td>Chất lượng tuyệt vời</td>
            <td>07-11-2024</td>
            <td>
              <button class="btn toggle-star">
                <i class="fa fa-star"></i>
              </button>
            </td>
            <td><button class="btn btn-danger">Xoá</button></td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- content end -->