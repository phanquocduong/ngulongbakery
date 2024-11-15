<!-- body start -->
<div class="container-fluid pt-4 px-4">
          <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h2 class="mb-0">Danh Sách Đơn Hàng</h2>
            </div>
            <!-- form search -->
            <form class="d-none d-md-flex ms-4">
              <div class="input-group">
                <input
                  class="form-control border-0"
                  type="search"
                  placeholder="Tìm kiếm đơn hàng"
                />
                <button class="btn">
                  <span class="input-group-text bg-transparent border-0">
                    <i class="fa fa-search"></i>
                  </span>
                </button>
              </div>
            </form>
            <br />
            <!-- form search end -->
            <div class="table-responsive">
              <table
                class="table text-start align-middle table-bordered table-hover mb-0"
              >
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
                  <tr>
                    <td>1</td>
                    <td>PhanGB</td>
                    <td>400.000 VND</td>
                    <td>08-11-2024</td>
                    <td>Đã Giao</td>
                    <td>
                      <a href="index.php?page=order_detail"
                        ><button class="btn btn-sm btn-primary">
                          Xem Chi Tiết
                        </button></a
                      >
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Con Mèo Ngu Ngốc</td>
                    <td>2,000,000 VND</td>
                    <td>08-11-2024</td>
                    <td>Đã Giao</td>
                    <td>
                      <a href="order_detail.html"
                        ><button class="btn btn-sm btn-primary">
                          Xem Chi Tiết
                        </button></a
                      >
                    </td>
                  </tr>
                  <!-- Add more rows as needed -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- body end -->