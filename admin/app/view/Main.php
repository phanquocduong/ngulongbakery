<!-- main -->
<?php
require_once './app/model/OrderModel.php';
use App\Model\OrderModel;
$order = new OrderModel();
$total_amount = $order->getTotalAmount();
$total_fee = $order->getTotalFee();

$totalToday = isset($total_fee['totalToday']) ? $total_fee['totalToday'] : 0;

?>
<style>
  .form-filter {
    border: 1px solid wheat;
    width: 200px;
  }

  .form-filter:focus {
    border: 1px solid white;
  }

  /* comment */
  .comment-container {
    flex-direction: column;
    background-color: #fff;
    transition: all 0.3s ease;
}

.comment-container:hover {
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.comment-content {
    word-wrap: break-word;
    min-height: 50px;
    border-left: 3px solid #0d6efd;
}

@media (max-width: 768px) {
    .comment-container {
        margin: 10px 0;
    }
}
</style>
<!-- Thống kê doanh thu -->
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-sm-6 col-xl-3">
      <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
        <i class="fa fa-chart-bar fa-3x text-primary"></i>
        <div class="ms-3">
          <p class="mb-2">Tổng doanh thu</p>
          <h6 class="mb-0"><?= number_format($total_amount['total'], 0); ?> VNĐ</h6>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
        <i class="fa fa-chart-area fa-3x text-primary"></i>
        <div class="ms-3">
          <p class="mb-2">Doanh thu hôm nay</p>
          <h6 class="mb-0"><?= number_format($totalToday, 0) ?> VNĐ</h6>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Kết thúc doanh thu -->

<?php
require_once './app/model/OrderModel.php';
$orderModel = new OrderModel();
// $viewOrder = $orderModel->getOrder();
$day = isset($_GET['day']) ? $_GET['day'] : 0;

if ($day == 1) {
  $getOrder = $orderModel->getOrderToday();
} elseif ($day == 2) {
  $getOrder = $orderModel->getOrderInWeek();
} else {
  $getOrder = $orderModel->getOrder();
}

?>
<!-- Thống kê đơn hàng -->
<div class="container-fluid pt-4 px-4">
  <div class="bg-light text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h6 class="mb-0">Danh Sách Đơn Hàng</h6>
      <form action="index.php" method="GET">
        <select name="day" id="order-filter" onchange="this.form.submit()" class="form-filter">
          <option value="0" <?php echo ($day == 0) ? 'selected' : ''; ?>>Tất cả</option>
          <!-- <option value="1" <?php echo ($day == 1) ? 'selected' : ''; ?>>Hôm nay</option> -->
          <option value="2" <?php echo ($day == 2) ? 'selected' : ''; ?>>Tuần này</option>
        </select>
      </form>
      <script>
        document.getElementById('order-filter').addEventListener('change', function () {
          this.form.submit();
        });
      </script>
      <a href="javascript:void(0);" class="toggleButton">Hiện Tất Cả</a>
    </div>
    <div class="table-responsive">
      <table class="table text-start align-middle table-bordered table-hover mb-0 productTable">
        <thead>
          <tr class="text-dark">
            <th scope="col">STT</th>
            <th scope="col">Tên Khách Hàng</th>
            <th scope="col">Tổng Tiền</th>
            <th scope="col">Ngày Đặt</th>
            <th scope="col">Trạng Thái</th>
            <th scope="col">Hành Động</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stt = 1;
          if ($getOrder == null) {
            echo '<tr>  
            <td>
           <h6>Không có dữ liệu</h6>
            </td>
            </tr>';
          } else {
            foreach ($getOrder as $value) {
              // extract($value);
              // if (strtotime($value['created_at']) !== false) {
                // Tạo đối tượng DateTime trực tiếp với múi giờ Việt Nam
                $date = new DateTime($value['created_at'], new DateTimeZone('Asia/Ho_Chi_Minh'));
                // Định dạng lại thời gian
                $vn_format = $date->format('d/m/Y');
              // } else {
                // $vn_format = "Invalid date";
              // }
              echo "<tr class='product-row'>";
              echo "<td>" . $stt++ . "</td>";
              echo "
            <td>
              <a href='index.php?page=order_detail&id=".$value['id']."'>".$value['customer']."</a>
              </td>";
              echo "<td>" . number_format($value['total_amount'], 0) . " VNĐ</td>";
              echo "<td>$vn_format</td>";
              echo "<td>" . $value['status'] . "</td>";
              echo "<td> <a href='index.php?page=order_detail&id=".$value['id']."'><button class='btn btn-sm btn-primary'>Xem Chi Tiết</button></a></td>";
              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
      </table>
    </div>
  </div>
</div>
<!-- Kết thúc danh sách đơn hàng -->

<!-- Bảng số lượng sản phẩm từng danh mục -->
<div class="container-fluid pt-4 px-4">
  <div class="bg-light text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h6 class="mb-0">Số Lượng Sản Phẩm Từng Danh Mục</h6>
      <a href="javascript:void(0);" class="toggleButton">Hiện Tất Cả</a>
    </div>
    <div class="table-responsive">
      <table class="table text-start align-middle table-bordered table-hover mb-0 productTable">
        <thead>
          <tr class="text-dark">
            <th scope="col">STT</th>
            <th scope="col">Tên Danh Mục</th>
            <th scope="col">Số Lượng Sản Phẩm</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once './app/model/CategoryModel.php';
          require_once './app/model/AdProductsModel.php';

          $products = new AdProductsModel();
          $cate = new CategoryModel();
          $listCate = $cate->getCate();
          $productCounts = $products->getProductsCount();

          // Create product count mapping
          $categoryProductCount = [];
          foreach ($productCounts as $count) {
            $categoryProductCount[$count['category_id']] = $count['product_count'];
          }

          // Display categories and product counts
          $stt = 1;
          if (!empty($listCate)) {
            foreach ($listCate as $category) {
              $count = isset($categoryProductCount[$category['id']]) ? $categoryProductCount[$category['id']] : 0;
              ?>
              <tr class="product-row">
                <td><?php echo $stt++; ?></td>
                <td><?php echo htmlspecialchars($category['name']); ?></td>
                <td><?php echo $count; ?></td>
              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Kết thúc bảng số lượng sản phẩm từng danh mục -->

<!-- Bảng số lượng sản phẩm bán chạy -->
<div class="container-fluid pt-4 px-4">
  <div class="bg-light text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h6 class="mb-0">Số Lượng Sản Phẩm Bán Chạy</h6>
      <a href="javascript:void(0);" class="toggleButton">Hiện Tất Cả</a>
    </div>
    <div class="table-responsive">
      <table class="table text-start align-middle table-bordered table-hover mb-0 productTable">
        <thead>
          <tr class="text-dark">
            <th scope="col">STT</th>
            <th scope="col">Tên Sản Phẩm</th>
            <th scope="col">Số Lượng Bán</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $getSell = new AdProductsModel();
          $getProductSell = $getSell->getBestSell();
          ?>
          <?php
          $stt = 1;
          if (empty($getProductSell)) {
            echo '<tr>
            <td>
            <h6>Không có dữ liệu</h6>
            <td>
            </tr>';
          } else {
            foreach ($getProductSell as $key => $value) {
              extract($value);
              echo "<tr class='product-row'>";
              echo "<td>" . $stt++ . "</td>";
              echo "<td>$name</td>";
              echo "<td>$sold</td>";
              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Kết thúc bảng số lượng sản phẩm bán chạy -->

<!-- Bảng số lượng sản phẩm tồn kho -->
<div class="container-fluid pt-4 px-4">
  <div class="bg-light text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h6 class="mb-0">Số Lượng Sản Phẩm Tồn Kho</h6>
      <a href="javascript:void(0);" class="toggleButton">Hiện Tất Cả</a>
    </div>
    <div class="table-responsive" id="productTable">
      <table class="table text-start align-middle table-bordered table-hover mb-0 productTable">
        <thead>
          <tr class="text-dark">
            <th scope="col">STT</th>
            <th scope="col">Tên Sản Phẩm</th>
            <th scope="col">Số Lượng Tồn Kho</th>
          </tr>
        </thead>
        <tbody id="productBody">
          <?php
          require_once './app/model/AdProductsModel.php';
          $stock_quantity = new AdProductsModel();
          $viewStock_quantity = $stock_quantity->stock_quantity();
          $stt = 1;
          foreach ($viewStock_quantity as $key => $value) {
            extract($value);
            echo '<tr class="product-row">';
            echo '<td>' . $stt++ . '</td>';
            echo '<td>' . $name . '</td>';
            echo '<td>' . $stock_quantity . '</td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<!-- Widgets Start -->
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-sm-12 col-md-6 col-xl-4">
      <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h6 class="mb-0">Lịch Vạn Niên</h6>
          <a href="">Xem Tất Cả</a>
        </div>
        <div id="calender"></div>
      </div>
    </div>


    <?php
$reviewNew = new AdProductsModel();
    $reviewToday = $reviewNew->getReviewsToday();

    ?>
    <div class="col-sm-12 col-md-6 col-xl-6">
      <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h6 class="mb-0">Những Bình Luận Mới Nhất</h6>
          <a href="">Xem Tất Cả</a>
        </div>
        <?php
        if(empty( $reviewToday)) {
          echo '<h5>Không có dữ liệu</h5>';
        } else {
          foreach ($reviewToday as $key => $value) {
            extract($value);
            ?>
                       <div class="comment-container d-flex mb-3 p-3 border rounded">
                <div class="comment-header mb-2">
                    <div class="user-comment">
                        Người dùng <span class="fw-bold text-primary"><?php echo $username; ?></span> 
                        đã đánh giá sản phẩm
                        <span class="fw-bold text-secondary"><?php echo $name; ?></span> <span><?= $rating; ?></span> sao với nội dung:
                    </div>
                </div>
                <div class="comment-content mt-2 ms-3 p-2 bg-light rounded">
                    <?php echo $contents; ?>
                </div>
            </div>
            <?php
          }
        }
        ?>
        <!-- <div class="d-flex mb-2">
          <div>Người dùng <b>A</b> đã bình luận trong sản phẩm <b>B</b>:</div>
          <div style="margin-left:5px;">Bánh rất ngon nhaaa</div>
        </div> -->
        <!-- <div class="d-flex align-items-center border-bottom py-2">
          <input class="form-check-input m-0" day="checkbox" />
          <div class="w-100 ms-3">
            <div class="d-flex w-100 align-items-center justify-content-between">
              <span>Bán 1 tỷ gói mè trong ngày...</span>
              <button class="btn btn-sm">
                <i class="fa fa-times"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center border-bottom py-2">
          <input class="form-check-input m-0" type="checkbox" />
          <div class="w-100 ms-3">
            <div class="d-flex w-100 align-items-center justify-content-between">
              <span>Nhập thêm sản phẩm mới...</span>
              <button class="btn btn-sm">
                <i class="fa fa-times"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center border-bottom py-2">
          <input class="form-check-input m-0" type="checkbox" checked />
          <div class="w-100 ms-3">
            <div class="d-flex w-100 align-items-center justify-content-between">
              <span><del>Giao đơn về Thủ Đức...</del></span>
              <button class="btn btn-sm text-primary">
                <i class="fa fa-times"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center pt-2">
          <input class="form-check-input m-0" type="checkbox" />
          <div class="w-100 ms-3">
            <div class="d-flex w-100 align-items-center justify-content-between">
              <span>Cập nhật mã giảm giá...</span>
              <button class="btn btn-sm">
                <i class="fa fa-times"></i>
              </button>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
<!-- Widgets End -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các nút toggle và bảng liên quan
    const toggleButtons = document.querySelectorAll('.toggleButton');
    const tables = document.querySelectorAll('.productTable');

    // Lặp qua các nút và bảng
    toggleButtons.forEach((button, index) => {
      const table = tables[index]; // Kết nối từng nút với bảng tương ứng
      const rows = table.querySelectorAll('.product-row');
      const defaultVisible = 5;

      // Ẩn tất cả các hàng sau sản phẩm thứ 5
      rows.forEach((row, i) => {
        if (i >= defaultVisible) {
          row.style.display = 'none';
        }
      });

      // Thêm sự kiện click cho từng nút
      button.addEventListener('click', function () {
        const isExpanded = button.textContent === 'Thu Gọn';

        if (isExpanded) {
          // Thu gọn: chỉ hiển thị 5 hàng
          rows.forEach((row, i) => {
            row.style.display = i < defaultVisible ? '' : 'none';
          });
          button.textContent = 'Hiện Tất Cả';
        } else {
          // Hiện tất cả: hiển thị toàn bộ hàng
          rows.forEach(row => row.style.display = '');
          button.textContent = 'Thu Gọn';
        }
      });
    });
  });
</script>



<!-- End main -->