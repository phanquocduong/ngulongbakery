<!-- main start -->
 <div class="container-fluid pt-4 px-4">
          <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between mb-4">
              <h6 class="mb-0">Danh sách tài khoản</h6>
              <a href="index.php?page=add_account" class="btn btn-primary">Thêm tài khoản</a>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $stt =1;
                  foreach ($data['user'] as $item) {
                    extract($item);
                    echo '<tr>
                    <td>'.$stt++.'</td>
                    <td>'.$full_name.'</td>
                    <td>'.$email.'</td>';
                    if ($role_id==1) {
                      echo'<td>Admin</td>';
                    } else {
                      echo'<td>Người dùng</td>';
                    }
                    if ($status==1) {
                      echo'<td>
                      <span class="status-icon status-offline"></span>
                      <span class="status-text">Đang hoạt động</span>
                          </td>';
                    }else{
                      echo'<td>
                      <span class="status-icon status-online"></span>
                      <span class="status-text">Đã tắt</span>
                          </td>';
                    }
                      
                    echo'<td>
                      <a href="index.php?page=account_detail&id='.$id.'"
                        ><button class="btn btn-info btn-sm btn-color-text">
                          Xem
                        </button></a
                      >
                      <a href="index.php?page=edit_account&id='.$id.'" class="btn btn-warning btn-sm btn-color-text">
                        Sửa
                      </a>
                      <button class="btn btn-danger btn-sm">Xoá</button>
                      <button class="btn btn-dark btn-sm">Khoá/Mở</button>
                    </td>
                  </tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- main end -->