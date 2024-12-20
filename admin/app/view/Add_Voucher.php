<!-- Main Start -->
<div class="container-fluid py-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5 class="card-title">Thêm Mã Giảm Giá</h5>
                    <form action="index.php?page=addvoucher" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 col -md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Mã Giảm Giá</label>
                                    <input type="text" class="form-control" id="code" name="code" required />
                                </div>
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Giảm Giá</label>
                                    <input type="number" class="form-control" id="discount" name="discount_value" required min=0 />
                                </div>
                                <div class="mb-3">
                                    <label for="start" class="form-label">Ngày Bắt Đầu</label>
                                    <input type="date" class="form-control" id="start" name="start_date" required />
                                </div>
                                <div class="mb-3">
                                    <label for="end" class="form-label">Ngày Kết Thúc</label>
                                    <input type="date" class="form-control" id="end" name="end_date" required />
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Số Lượng</label>
                                    <input type="number" class="form-control" id="quantity" name="usage_limit" required min=0 />
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                                    <input type="number" class="form-control" id="quantity" name="min_order_value" value=""
                                        required min=0 />
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select class="form-select" id="status" name="active" required>
                                        <option value="1">Hoạt Động</option>
                                        <option value="0">Không Hoạt Động</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        Thêm
                                    </button>
                                    <a href="index.php?page=voucher" class="btn btn-danger">Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main End -->