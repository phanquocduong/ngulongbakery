<!-- main start -->
 <style>
    /* lọc user */
    #user-filter {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
        font-size: 16px;
        width: 200px;
        margin: 10px 0 0 25px;
        color: #757575;
        background-color: white;
    }

    #user-filter:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }
</style>
<div class="container-fluid pt-4 px-4">
  <div class="bg-light rounded p-4">
    <div class="d-flex justify-content-between mb-4">
      <h6 class="mb-0">Danh sách tài khoản</h6>
    </div>
    <!-- bộ lọc -->
     <?php
     require_once './app/model/UserModel.php';
     $user = new UserModel();
     $type = isset($_GET['type']) ? $_GET['type'] : 0;
     if ($type == 1) {
       $userFilter = $user->getUserByRole(1);
     } else if ($type == 2) {
       $userFilter = $user->getUserByRole(0);
     }else{
       $userFilter = $user->getUser();
     }
     ?>
    <form action="" method="GET">
      <input type="hidden" name="page" value="accounts" >
      <select name="type" id="user-filter" onchange="this.form.submit()" class="form-filter">
        <option value="0" <?php echo ($type == 0) ? 'selected' : ''; ?>>Tất cả</option>
        <option value="1" <?php echo ($type == 1) ? 'selected' : ''; ?>>Admin</option>
        <option value="2" <?php echo ($type == 2) ? 'selected' : ''; ?>>User</option>
      </select>
    </form>
    <script>
      document.getElementById('user-filter').addEventListener('change', function () {
        this.form.submit();
      });
    </script>
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
          $stt = 1;
          foreach ($userFilter as $item) {
            extract($item);
            echo '<tr>
                    <td>' . $stt++ . '</td>
                    <td>' . $full_name . '</td>
                    <td>' . $email . '</td>';
            if ($role_id == 1) {
              echo '<td>Admin</td>';
            } else {
              echo '<td>Người dùng</td>';
            }
            if ($status == 1) {
              echo '<td>
                      <span class="status-icon status-online"></span>
                      <span class="status-text">Đang hoạt động</span>
                          </td>';
            } else {
              echo '<td>
                      <span class="status-icon status-offline"></span>
                      <span class="status-text">Đã tắt</span>
                          </td>';
            }

            echo '<td>
                      <a href="index.php?page=account_detail&id=' . $id . '"
                        ><button class="btn btn-info btn-sm btn-color-text">
                          Xem chi tiết
                        </button></a
                      >
                      <a href="index.php?page=blockuser&id=' . $id . '&status=' . $status . '" class="btn btn-warning btn-sm btn-color-text">
                        Khóa/Mở
                      </a>
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