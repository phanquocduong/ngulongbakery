<!-- content start -->
<h2 class="text text-center text-padding">Chi Tiết Sản Phẩm</h2>
<div class="container-fluid pt-4 px-4">
  <div class="bg-light rounded p-4">
    <div class="table-responsive">
      <a href="index.php?page=products"><button class="btn btn-primary">Quay lại</button></a>
      <?php
      $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
      echo "<a href='index.php?page=viewEdit_products&id=$product_id'><button class='btn btn-primary'>
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
            echo "<td>" . number_format($price, 0, ',', '.') . " VNĐ</td>";
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
            <th>Ảnh đánh giá từ người dùng</th>
            <th>Ngày</th>
            <th>Đánh Dấu</th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_GET['id'])) {
          $id = intval($_GET['id']); // Bảo vệ giá trị đầu vào
          $reviews = $productsModel->getReviews(); // Lấy danh sách đánh giá
          $stt = 1;
          $hasReview = false;

          if ($reviews) {
            foreach ($reviews as $review) {
              extract($review);
              if ($id == $product_id) { // So sánh với product_id
                $hasReview = true;
                echo "<tr>";
                echo "<td>" . $stt++ . "</td>";
                echo "<td>" . htmlspecialchars($username) . "</td>"; // Escaping output
                echo "<td class='rating'>";
                for ($i = 0; $i < $rating; $i++) {
                  echo "<i class='fa fa-star'></i>";
                }
                echo "</td>";
                echo "<td style='width:300px;'>" . htmlspecialchars($contents) . "</td>";
                echo "<td style='text-align:center;'><img src='../public/upload/review/$img' alt='' style='width: 50px; height: 50px' /></td>";
                echo "<td>" . htmlspecialchars($date_comments) . "</td>";
                echo "<td>";
                if ($status == 1) {
                  echo "<button class='btn toggle-star'><i class='fa fa-star'></i></button>";
                } else {
                  echo "<button class='btn toggle-star'><i class='bi bi-star'></i></button>";
                }
                echo "</td>";
                echo "<td><button class='btn btn-danger'>Xoá</button></td>";
                echo "</tr>";
              }
            }
          }
          if (!$hasReview) {
            echo "<tr><td colspan='7'><h6>Chưa có đánh giá nào</h6></td></tr>";
          }
        } else {
          echo "<tr><td colspan='7'>Không có ID sản phẩm được cung cấp</td></tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- content end -->