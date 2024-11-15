<!-- main start -->
 <div class="container-fluid pt-4 px-4">
          <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between mb-4">
              <h6 class="mb-0">Danh sách tài khoản</h6>
              <a href="add_account.html" class="btn btn-primary">Thêm tài khoản</a>
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
                  <tr>
                    <td>1</td>
                    <td>Phận GB</td>
                    <td>conmeo123@gmail.com</td>
                    <td>Admin</td>
                    <td>
                      <span class="status-icon status-online"></span>
                      <span class="status-text">Đang hoạt động</span>
                  </td>
                    <td>
                      <a href="account_detail.html"
                        ><button class="btn btn-info btn-sm btn-color-text">
                          Xem
                        </button></a
                      >
                      <a href="edit_account.html" class="btn btn-warning btn-sm btn-color-text">
                        Sửa
                      </a>
                      <button class="btn btn-danger btn-sm">Xoá</button>
                      <button class="btn btn-dark btn-sm">Khoá/Mở</button>
                    </td>
                  </tr>
                  <!--  -->
                  <tr>
                    <td>1</td>
                    <td>Nguyễn Văn Mèo Con</td>
                    <td>nguyenvanmeo@example.com</td>
                    <td>Admin</td>
                    <td>
                      <span class="status-icon status-online"></span>
                      <span class="status-text">Đã tắt</span>
                  </td>
                    <td>
                      <a href="account_detail.html"
                        ><button class="btn btn-info btn-sm btn-color-text">
                          Xem
                        </button></a
                      >
                      <button class="btn btn-warning btn-sm btn-color-text">
                        Sửa
                      </button>
                      <button class="btn btn-danger btn-sm">Xoá</button>
                      <button class="btn btn-dark btn-sm">Khoá/Mở</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- main end -->