<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once './app/model/OrderModel.php';

use App\Model\OrderModel;

$orderModel = new OrderModel();
/* $oderUser = new */
// Lấy ID đơn hàng từ URL
$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy chi tiết đơn hàng theo ID đơn hàng
$orderDetails = $orderModel->getOrderDetailByOrderId($orderId);

// Lấy thông tin mã giảm giá theo ID từ thông tin đơn hàng
$order = $orderModel->getOrderById($orderId);
$discount = $orderModel->getDiscountById($order['discount_id']);
$discountName = $discount ? $discount['code'] : 'Không có mã giảm giá';
?>
<form action="index.php?page=confirm_Oder" method="post">
  <!-- body start -->


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
                        echo '<td class="text-center" id="emailuseroder">' . $userDetail['email'] . '</td>';
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
            <input type="hidden" value="<?= $userDetail['email'] ?> " name="odermaildl" id="">
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
                          <td class="text-center"><input type="hidden" id="odercheck-id" value="<?= $orderId ?> " name="oderCom-id"> <?php echo $order['id']; ?></td>
                          <td class="text-center"><?php echo $order['created_at']; ?></td>
                          <!-- <td class="text-center"></td> -->
                          <td class="text-center">
                            <section>

                              <select id="order-status" class="form-select" name="order-status" aria-label="Default select example">
                                <option value="Chờ xác nhận" id="order-status-0"

                                  <?php if (strtolower(trim($order['status'])) == strtolower('Chờ xác nhận')) {
                                    echo 'selected';
                                  } ?>>
                                  Chờ Xác Nhận
                                </option>

                                <option value="Đã xác nhận" id="order-status-1"
                                  <?php if (strtolower(trim($order['status'])) == strtolower('Đã xác nhận')) {
                                    echo 'selected';
                                  } ?>>
                                  Đã Xác Nhận
                                </option>

                                <option value="Đang giao hàng" id="order-status-2"

                                  <?php if (strtolower(trim($order['status'])) == strtolower('Đang giao hàng')) {
                                    echo 'selected';
                                  } ?>>
                                  Đang Giao Hàng
                                </option>

                                <option value="Giao hàng thành công" id="order-status-3"
                                  <?php if (strtolower(trim($order['status'])) == strtolower('Giao hàng thành công')) {
                                    echo 'selected';
                                  } ?>>
                                  Giao Hàng Thành Công
                                </option>

                                <option value="Đã huỷ" id="order-status-4"
                                  <?php if (strtolower(trim($order['status'])) == strtolower('Đã Huỷ')) {
                                    echo 'selected';
                                  } ?>>
                                  Đã Huỷ
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
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <br />
          <hr />
          <input type="hidden" name="suboder" value="suboder" name="" id="">
          <button id="export-button" class="btn btn-primary" disabled style="background-color: #ccc">
            <div class="" class="btn btn-primary" style="width: 100%; background-color: #ccc; border: none"
              id="in-export-button">

            </div>
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php if (isset($_SESSION['success'])): ?>
  <script>
    Swal.fire({
      title: '<?= $_SESSION['success'] ?>',
      icon: 'success',
      timer: 3000,
      showConfirmButton: false
    })
  </script>
<?php unset($_SESSION['success']);
endif; ?>
<!-- body end -->
<!-- </form> -->