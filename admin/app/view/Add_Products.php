<!-- form edit products -->
<div class="container-fluid py-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h2 class="mb-4">
                        Thêm
                        <span class="text-primary">Sản Phẩm</span>
                    </h2>
                    <form action="">
                        <div class="container-fluid px-4">
                            <div class="row">
                                <div class="col-12 col -lg-6">
                                    <div class="card card-body">
                                        <!-- <h5 class="mb-4">Thêm Danh Mục</h5> -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên Sản Phẩm</label>
                                            <input type="text" class="form-control" id="name" value="" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Giá Gốc (VNĐ)</label>
                                            <input type="number" class="form-control" id="price" value="" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="price_sale" class="form-label">Giá Khuyến Mãi (VNĐ)</label>
                                            <input type="number" class="form-control" id="price_sale" value="" />
                                            <br />
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Hình Ảnh</label>
                                                <input class="form-control" type="file" id="image" />
                                                <br />
                                                <label for="image" class="form-label">Hình Ảnh Con</label>
                                                <input class="form-control" type="file" id="image" />
                                                <hr />
                                                <input class="form-control" type="file" id="image" />
                                                <hr />
                                                <input class="form-control" type="file" id="image" />
                                                <hr />
                                            </div>
                                            <div class="mb-3">
                                                <label for="short-description" class="form-label">Mô Tả Ngắn</label>
                                                <input type="text" id="short-description" value=""
                                                    class="form-control" />
                                                <br />
                                                <label for="description">Mô Tả Chi Tiết</label>
                                                <textarea class="form-control" id="description" rows="10"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stock_quantity" class="form-label">Số Lượng Hàng Tồn
                                                    Kho</label>
                                                <input type="number" class="form-control" id="stock_quantity"
                                                    value="" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="views" class="form-label">Số Lượt Xem</label>
                                                <input type="number" class="form-control" id="views" value="0"
                                                    disabled />
                                            </div>
                                            <div class="mb-3">
                                                <label for="tag" class="form-label">Thẻ sản phẩm</label>
                                                <input type="text" class="form-control" id="tag" value="" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="parent" class="form-label">Loại danh mục</label>
                                                <select class="form-select" id="parent">
                                                    <option selected>Chọn danh mục</option>
                                                    <option value="1">Bánh Mì</option>
                                                    <option value="2">Bánh Trung Thu</option>
                                                    <option value="3">Bánh Ngọt</option>
                                                    <option value="4">Bánh Bò</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sub">
                                                Thêm
                                            </button>
                                            <br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <a href="index.php?page=products" class="btn btn-custom">
                        Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- form edit category end -->