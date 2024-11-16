<!-- main -->
<!-- Danh Sách Đơn Hàng -->
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-sm-6 col-xl-3">
      <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
        <i class="fa fa-chart-bar fa-3x text-primary"></i>
        <div class="ms-3">
          <p class="mb-2">Tổng doanh thu</p>
          <h6 class="mb-0">3000đ</h6>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
        <i class="fa fa-chart-area fa-3x text-primary"></i>
        <div class="ms-3">
          <p class="mb-2">Doanh thu hôm nay</p>
          <h6 class="mb-0">2000đ</h6>
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
      <a href="">Hiện Tất Cả</a>
    </div>
    <div class="table-responsive">
      <table class="table text-start align-middle table-bordered table-hover mb-0">
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
          require_once './app/model/OrderModel.php';
          $order = new OrderModel();
          $viewOrder = $order->getOrder();
          ?>

          <?php
          foreach ($viewOrder as $key => $value) {
            extract($value);
            echo "<tr>";
            echo "<td>$id</td>";
            echo "
            <td>
              <a href='index.php?page=order_detail&id=$id'>$customer</a>
              </td>";
            echo "<td>$total_amount</td>";
            echo "<td>$created_at</td>";
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
      <a href="">Hiện Tất Cả</a>
    </div>
    <div class="table-responsive">
      <table class="table text-start align-middle table-bordered table-hover mb-0">
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
          require_once './app/controller/AdProductsController.php';
          require_once './app/controller/AdCategoriesController.php';
          $products = new AdProductsModel();
          $cate = new CategoryModel();
          $listCate = $cate->getCate();
          $listPro = $products->getProducts();
          ?>
          <?php
          $categoryMap = [];
          foreach ($listCate as $category) {
            $categoryMap[$category['id']] = $category['name'];
          }
          foreach ($listCate as $key => $value) {
            extract($value);
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            $count = 0;
            foreach ($listPro as $key => $value) {
              if ($value['category_id'] == $id) {
                $count++;
              }
            }
            echo "<td>$count</td>";
            echo "</tr>";
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
      <a href="">Hiện Tất Cả</a>
    </div>
    <div class="table-responsive">
      <table class="table text-start align-middle table-bordered table-hover mb-0">
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
          foreach ($viewOrderDetail as $key => $value) {
            extract($value);
            echo "<tr>";
            echo "<td>$id</td>";
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
      <a href="">Hiện Tất Cả</a>
    </div>
    <div class="table-responsive">
      <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
          <tr class="text-dark">
            <th scope="col">STT</th>
            <th scope="col">Tên Sản Phẩm</th>
            <th scope="col">Số Lượng Tồn Kho</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once './app/model/AdProductsModel.php';
          $stock_quantity = new AdProductsModel();
          $viewStock_quantity = $stock_quantity->stock_quantity();
          ?>
          <?php
          foreach ($viewStock_quantity as $key => $value) {
            extract($value);
            echo '<tr>';
            echo '<td>' . $id . '</td>';
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
<!-- End main -->