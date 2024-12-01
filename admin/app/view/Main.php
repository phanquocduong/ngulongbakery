<!-- main -->
<?php
require_once './app/model/OrderModel.php';
use App\Model\OrderModel;
$order = new OrderModel();
$total_amount = $order->getTotalAmount();
$total_fee = $order->getTotalFee();

$totalToday = isset($total_fee['totalToday']) ? $total_fee['totalToday'] : 0;

?>
<!-- Danh Sách Đơn Hàng -->
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
<!-- Kết thúc danh sách đơn hàng -->

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
  <div class="bg-light text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h6 class="mb-0">Danh Sách Đơn Hàng</h6>
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
          // require_once './app/model/OrderModel.php';
          // use App\Model\OrderModel;
          $order = new OrderModel();
          $viewOrder = $order->getOrder();
          ?>

          <?php
          $stt = 1;
          foreach ($viewOrder as $key => $value) {
            extract($value);
            if (strtotime($created_at) !== false) {
              // Tạo đối tượng DateTime trực tiếp với múi giờ Việt Nam
              $date = new DateTime($created_at, new DateTimeZone('Asia/Ho_Chi_Minh'));

              // Định dạng lại thời gian
              $vn_format = $date->format('d/m/Y');
            } else {
              $vn_format = "Invalid date";
            }
            echo "<tr class='product-row'>";
            echo "<td>" . $stt++ . "</td>";
            echo "
            <td>
              <a href='index.php?page=order_detail&id=$id'>$customer</a>
              </td>";
            echo "<td>" . number_format($total_amount, 0) . " VNĐ</td>";
            echo "<td>$vn_format</td>";
            echo "<td>$status</td>";
            echo "<td> <a href='index.php?page=order_detail&id=$id'><button class='btn btn-sm btn-primary'>Xem Chi Tiết</button></a></td>";
            echo "</tr>";
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
          require_once './app/model/AdProductsModel.php';
          $orderDetail = new AdProductsModel();
          $viewOrderDetail = $orderDetail->getBestSell();
          ?>
          <?php
          $stt = 1;
          foreach ($viewOrderDetail as $key => $value) {
            extract($value);
            echo "<tr class='product-row'>";
            echo "<td>" . $stt++ . "</td>";
            echo "<td>$name</td>";
            echo "<td>$sold</td>";
            echo "</tr>";
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
    <div class="col-sm-12 col-md-6 col-xl-4">
      <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h6 class="mb-0">Danh Sách Công Việc</h6>
          <a href="">Xem Tất Cả</a>
        </div>
        <div class="d-flex mb-2">
          <input class="form-control bg-transparent" type="text" placeholder="Nhập Công Việc" />
          <button type="button" class="btn btn-primary ms-2">
            Thêm
          </button>
        </div>
        <div class="d-flex align-items-center border-bottom py-2">
          <input class="form-check-input m-0" type="checkbox" />
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
        </div>
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