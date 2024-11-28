<!-- body start -->
<div class="container-fluid pt-4 px-4">
  <div class="bg-light rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="mb-0">Danh Sách Đơn Hàng</h2>
    </div>
    <!-- form search -->
    <form class="d-none d-md-flex ms-4" method="POST">
      <div class="input-group">
        <input class="form-control border-0" type="search" name="search_order" placeholder="Tìm kiếm đơn hàng" />
        <button class="btn" name="button_order">
          <span class="input-group-text bg-transparent border-0">
            <i class="fa fa-search"></i>
          </span>
        </button>
      </div>
    </form>
    <br />
    <!-- form search end -->
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
              echo "<td>".number_format($total_amount,0)."</td>";
              echo "<td>$vn_format</td>";
              echo "<td>$status</td>";
              echo "<td> <a href='index.php?page=order_detail&id=$id'><button class='btn btn-sm btn-primary'>Xem Chi Tiết</button></a></td>";
              echo "</tr>";
          }

          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- body end -->