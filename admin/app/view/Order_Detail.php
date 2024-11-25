<!-- body start -->
<?php
require_once './app/model/OrderModel.php';
$orderModel = new OrderModel();

// Lấy ID đơn hàng từ URL
$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy chi tiết đơn hàng theo ID đơn hàng
$orderDetails = $orderModel->getOrderDetailByOrderId($orderId);

// Lấy thông tin mã giảm giá theo ID từ thông tin đơn hàng
$order = $orderModel->getOrderById($orderId);
$discount = $orderModel->getDiscountById($order['discount_id']);
$discountName = $discount ? $discount['code'] : 'Không có mã giảm giá';
?>

<div class="container-fluid px-4">
  <div class="row">
    <div class="col-12">
      <div class="card card-body">
        <a href="index.php?page=order" class="nav nav-link">Quay lại</a>
        <h4 class="card-title text-center text-primary fw-bold mb-4 mt-2">
          Chi Tiết Đơn Hàng
        </h4>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Tên Sản Phẩm</th>
                <th class="text-center">Hình Ảnh</th>
                <th class="text-center">Số Lượng</th>
                <th class="text-center">Giá</th>
                <th class="text-center">Thành Tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!$orderDetails) {
                echo "<tr><td colspan='6' class='text-center'>Không có dữ liệu</td></tr>";
              } else {
                foreach ($orderDetails as $key => $value) {
                  extract($value);
                  echo "<tr>";
                  echo "<td class='text-center'>$order_id</td>";
                  echo "<td class='text-center'>$product_name</td>";
                  echo "<td class='text-center'><img src='../public/upload/product/$product_image' alt='' width='50px' height='50' /></td>";
                  echo "<td class='text-center'>$quantity</td>";
                  echo "<td class='text-center'>$unit_price</td>";
                  echo "<td class='text-center'>" . ($quantity * $unit_price) . "</td>";
                  echo "</tr>";
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-12 col -md-6">
            <div class="card card-body">
              <h4 class="card-title text-center text-primary fw-bold mb-4 mt-2">
                Thông Tin Khách Hàng
              </h4>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">Tên Khách Hàng</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Số Điện Thoại</th>
                      <th class="text-center">Địa Chỉ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require_once '../app/model/OrderModel.php';
                    $orderModel = new OrderModel();
                    // Lấy ID đơn hàng từ URL hoặc từ một nguồn khác
                    $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
                    // Gọi phương thức getUserDetail với ID đơn hàng
                    $userDetail = $orderModel->getUserDetail($orderId);
                    ?>
                    <!-- Hiển thị chi tiết đơn hàng -->
                    <?php
                    if ($userDetail): ?>
                      <?php
                      echo '<tr>';
                      echo '<td class="text-center">' . $userDetail['customer'] . '</td>';
                      echo '<td class="text-center">' . $userDetail['email'] . '</td>';
                      echo '<td class="text-center">' . $userDetail['phone'] . '</td>';
                      echo '<td class="text-center">' . $userDetail['shipping_address'] . '</td>';
                      echo '</tr>';
                      ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-12 col -md-6">
            <div class="card card-body">
              <h4 class="card-title text-center text-primary fw-bold mb-4 mt-2">
                Thông Tin Đơn Hàng
              </h4>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">Mã Đơn Hàng</th>
                      <th class="text-center">Ngày Đặt</th>
                      <th class="text-center">Trạng Thái</th>
                      <th class="text-center">Ghi Chú</th>
                      <th class="text-center">Mã Giảm Giá</th>
                      <th class="text-center">Thành Tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require_once '../app/model/OrderModel.php';
                    $orderModel = new OrderModel();
                    $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
                    $order = $orderModel->getOrderById($orderId);
                    ?>
                    <?php if ($order): ?>
                      <tr>
                        <td class="text-center"><?php echo $order['id']; ?></td>
                        <td class="text-center"><?php echo $order['created_at']; ?></td>
                        <!-- <td class="text-center"></td> -->
                        <td class="text-center">
                          <section>
                            <select id="order-status" class="form-select" aria-label="Default select example">
                              <option value="0" <?php if ($order['status'] == 'Chờ xác nhận') {
                                echo 'selected';
                              } ?>>Chờ Xác
                                Nhận</option>
                              <option value="1" <?php if ($order['status'] == 'Đã xác nhận') {
                                echo 'selected';
                              } ?>>Đã Xác
                                Nhận</option>
                              <option value="2" <?php if ($order['status'] == 'Đang giao') {
                                echo 'selected';
                              } ?>>Đang Giao
                              </option>
                              <option value="3" <?php if ($order['status'] == 'Đã giao') {
                                echo 'selected';
                              } ?>>Đã Giao
                              </option>
                              <option value="4" <?php if ($order['status'] == 'Đã huỷ') {
                                echo 'selected';
                              } ?>>Đã Huỷ
                              </option>
                            </select>
                          </section>
                        </td>
                        <td class="text-center"><?php echo $order['note']; ?></td>
                        <td class="text-center"><?php echo $discountName; ?></td>
                        <td class="text-center"><?php echo $order['total_amount']; ?></td>
                      </tr>
                    <?php else: ?>
                      <tr>
                        <td colspan="6" class="text-center">Không tìm thấy đơn hàng</td>
                      </tr>
                    <?php endif; ?>
                    <!-- <tr>
                              <td class="text-center">1</td>
                              <td class="text-center">08-11-2024</td>
                              <td class="text-center">
                                <section>
                                  <select
                                    id="order-status"
                                    class="form-select"
                                    aria-label="Default select example"
                                  >
                                    <option value="0">Chờ Xác Nhận</option>
                                    <option value="1">Đã Xác Nhận</option>
                                    <option value="2">Đang Giao</option>
                                    <option value="3">Đã Giao</option>
                                    <option value="4">Đã Huỷ</option>
                                  </select>
                                </section>
                              </td>
                              <td class="text-center">Giao tận miệng</td>
                              <td class="text-center">NGULONG11-11</td>
                              <td class="text-center">400.000</td>
                            </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <br />
        <hr />
        <button id="export-button" class="btn btn-primary" disabled style="background-color: #ccc">
          <a href="" class="btn btn-primary" style="width: 100%; background-color: #ccc; border: none"
            id="in-export-button">Xuất hoá đơn</a>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- body end -->