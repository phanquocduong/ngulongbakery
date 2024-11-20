<!-- Main Start -->
 <?php
 require_once './app/model/VoucherModel.php';
 $voucherModel = new VoucherModel();
 $voucherId = isset($_GET['id']) ? intval($_GET['id']) : 0;
 $voucher = $voucherModel->getIdVocher($voucherId);
//  print_r($voucherId);
extract($data['voucherdetail']);
 ?>
<div class="container-fluid py-4 px-4">
          <div class="row">
            <div class="col-12">
              <div class="card border-0 shadow">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <h6 class="mb-0">Sửa Mã Giảm Giá</h6>
                  </div>
                  <hr />
                  <form action="index.php?page=editvoucher" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?= $voucherId ?>">
                    <div class="mb-3">
                      <label for="code" class="form-label">Mã Giảm Giá</label>
                      <input
                        type="text"
                        class="form-control"
                        id="code"
                        name="code"
                        value="<?php echo $code ?>"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="discount" class="form-label"
                        >Giảm Giá (%)</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="discount"
                        name="discount_value"
                        value="<?php echo $discount_value ?>"
                        required
                        min=0
                      />
                    </div>
                    <div class="mb-3">
                      <label for="start" class="form-label">Ngày Bắt Đầu</label>
                      <div class="input-group">
                        <input
                          type="text"
                          class="form-control"
                          id="start"
                          name="start_date"
                          value="<?php echo $start_date ?>"
                          required
                        />
                        <span class="input-group-text"
                          ><i class="bi bi-calendar"></i
                        ></span>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="end" class="form-label">Ngày Kết Thúc</label>
                      <div class="input-group">
                        <input
                          type="text"
                          class="form-control"
                          id="end"
                          name="end_date"
                          value="<?php echo $end_date ?>"
                          required
                        />
                        <span class="input-group-text"
                          ><i class="bi bi-calendar"></i
                        ></span>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="quantity" class="form-label">Số Lượng</label>
                      <input
                        type="number"
                        class="form-control"
                        id="quantity"
                        name="usage_limit"
                        value="<?php echo $usage_limit ?>"
                        required
                        min=0
                      />
                    </div>
                    <div class="mb-3">
                      <label for="quantity" class="form-label"
                        >Giá trị đơn hàng tối thiểu (VNĐ)</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="quantity"
                        name="min_order_value"
                        value="<?php echo $min_order_value ?>"
                        required
                        min=0
                      />
                    </div>
                    <div class="mb-3">
                      <label for="status" class="form-label">Trạng Thái</label>
                      <select class="form-select" id="status" name="active">
                        <?php
                        if ($active==0) {
                          echo '<option value="1">Kích Hoạt</option>
                          <option value="0" selected>Không Kích Hoạt</option>';
                        } else {
                          echo '<option value="1" selected>Kích Hoạt</option>
                          <option value="0">Không Kích Hoạt</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
                    <a href="index.php?page=voucher" class="btn btn-danger">Quay lại</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Main End -->