<!-- Main Start -->
<div class="container-fluid py-4 px-4">
          <div class="row">
            <div class="col-12">
              <div class="card border-0 shadow">
                <div class="card-header bg-light border-0 py-3">
                  <h4 class="mb-2" style="float: left">
                    Danh Sách Mã Giảm Giá
                  </h4>
                  <a
                    href="index.php?page=add_voucher"
                    class="btn btn-primary"
                    style="float: right"
                    >Thêm mã giảm giá</a
                  >
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table
                      class="table table-centered table-nowrap mb-0 rounded"
                    >
                      <thead class="thead-light">
                        <tr>
                          <th class="border-0">Mã</th>
                          <th class="border-0">Giảm</th>
                          <th class="border-0">Ngày bắt đầu</th>
                          <th class="border-0">Ngày kết thúc</th>
                          <th class="border-0">Số Lượng</th>
                          <th class="border-0">
                            Giá trị đơn hàng tối thiểu (VNĐ)
                          </th>
                          <th class="border-0">Trạng Thái</th>
                          <th class="border-0">Hành Động</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          
                          foreach ($data['voucher'] as $item) {
                            extract($item);
                            $date_start = $start_date;
                            $date_end = $end_date;
                            $start_date_obj = new DateTime($date_start, new DateTimeZone('Asia/Ho_Chi_Minh'));
                            $end_date_obj = new DateTime($date_end, new DateTimeZone('Asia/Ho_Chi_Minh'));
                            $start_date_formatted = $start_date_obj->format('d-m-Y');
                            $end_date_formatted = $end_date_obj->format('d-m-Y');
                            echo '<tr>
                              <td>'.$code.'</td>
                              <td>'.$discount_value.'%</td>
                              <td>'.$start_date_formatted.'</td>
                              <td>'.$end_date_formatted.'</td>
                              <td>'.$usage_limit.'</td>
                              <td>'.number_format($min_order_value, 0, ',', '.') . ' VND</td>
                              <td>';
                                if ($active==1) {
                                  echo '<span class="badge bg-success">Hoạt Động</span>';
                                } else {
                                  echo '<span class="badge bg-danger">Đã hết hạn</span>';
                                }
                              echo '</td>
                              <td>
                                <a
                                  href="index.php?page=edit_voucher&id='.$id.'"
                                  class="text-primary me-2"
                                  ><i class="fa fa-pencil-alt"></i
                                ></a>
                                <a href="index.php?page=delete_voucher&id='.$id.'" class="text-danger"
                                  onclick="return confirm(\'Bạn có chắc chắn muốn xóa voucher này không?\')"><i class="fa fa-trash-alt"></i
                                ></a>
                              </td>
                            </tr>';
                            }
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Main End -->