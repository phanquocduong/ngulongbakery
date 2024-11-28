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
                    <form action="index.php?page=addPro" method="POST" enctype="multipart/form-data">
                        <div class="container-fluid px-4">
                            <div class="row">
                                <div class="col-12 col -lg-6">
                                    <div class="card card-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên Sản Phẩm</label>
                                            <input type="text" class="form-control" id="name" name="name" value="" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Giá Gốc (VNĐ)</label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                value="" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="price_sale" class="form-label">Giá Khuyến Mãi (VNĐ)</label>
                                            <input type="number" class="form-control" id="price_sale" name="price_sale"
                                                value="" required />
                                            <br />
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Hình Ảnh</label>
                                                <input class="form-control" type="file" id="image1" name="image1" required />
                                                <br />
                                                <label for="image" class="form-label">Hình Ảnh Con</label>
                                                <input class="form-control" type="file" id="image2" name="image2" />
                                                <hr />
                                                <input class="form-control" type="file" id="image3" name="image3" />
                                                <hr />
                                                <input class="form-control" type="file" id="image4" name="image4" />
                                                <hr />
                                            </div>
                                            <div class="mb-3">
                                                <label for="short-description" class="form-label" required>Mô Tả Ngắn</label>
                                                <input type="text" id="short_description" name="short_description"
                                                    value="" class="form-control" required />
                                                <br />
                                                <label for="description" required>Mô Tả Chi Tiết</label>
                                                <br>
                                                <!-- <textarea class="form-control" id="description" name="description" rows="10"></textarea> -->
                                                <!-- -------------- -->

                                                <!-- Đoạn để nhập văn bản, sẽ truy xuất đoạn này để thêm vào database -->
                                                <div id="app">
                                                    <!-- Vùng nhập liệu có thể chỉnh sửa, hỗ trợ các thẻ HTML -->
                                                    <div id="editor" class="editor" name="description"
                                                        contenteditable="true" @input="updateText($event)">
                                                    </div>

                                                    <!-- Textarea chứa dữ liệu HTML -->
                                                    <textarea name="contain_description"
                                                        id="contain_description" rows="20" cols="100" style="display: none;">{{ inpText }}</textarea>
                                                </div>

                                                <script>
                                                    const app = Vue.createApp({
                                                        data() {
                                                            return {
                                                                inpText: '' // Nội dung HTML của vùng contenteditable
                                                            }
                                                        },
                                                        methods: {
                                                            updateText(event) {
                                                                // Lấy nội dung HTML từ contenteditable
                                                                this.inpText = event.target.innerHTML;
                                                            }
                                                        }
                                                    });
                                                    app.mount('#app');
                                                </script>

                                                <br />
                                                <!-- -------------- -->
                                                <!-- input để thêm bài viết -->
                                                <div class="add-element">
                                                    <select id="element-type" class="form-select m-2">
                                                        <option value="h2">Tiêu đề H2</option>
                                                        <option value="h3">Tiêu đề H3</option>
                                                        <option value="h4">Tiêu đề H4</option>
                                                        <option value="h5">Tiêu đề H5</option>
                                                        <option value="h6">Tiêu đề H6</option>
                                                        <option value="p">Nội dung (Paragraph)</option>
                                                        <option value="img">Hình ảnh</option>
                                                    </select>
                                                    <button type="button" id="add-element-btn"
                                                        class="btn btn-primary m-2" style="margin-left: 7px">
                                                        Thêm thẻ
                                                    </button>
                                                    <input type="file" id="image-input" accept="image/*"
                                                        style="display: none" />
                                                </div>
                                                <!-- ----------------------- -->
                                            </div>
                                            <div class="mb-3">
                                                <label for="stock_quantity" class="form-label">Số đánh giá</label>
                                                <input type="number" class="form-control" id="rating" name="rating"
                                                    value="0" readonly />
                                            </div>
                                            <div class="mb-3">
                                                <label for="stock_quantity" class="form-label">Số Lượng Hàng Tồn
                                                    Kho</label>
                                                <input type="number" class="form-control" id="stock_quantity"
                                                    name="stock_quantity" value="0" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="stock_quantity" class="form-label">Số lượng sản phẩm đã
                                                    bán</label>
                                                <input type="number" class="form-control" id="sold" name="sold"
                                                    value="0" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="views" class="form-label">Số Lượt Xem</label>
                                                <input type="number" class="form-control" id="views" name="views"
                                                    value="0" readonly />
                                            </div>
                                            <div class="mb-3">
                                                <label for="tag" class="form-label">Thẻ sản phẩm</label>
                                                <input type="text" class="form-control" id="tag" name="tag" value="" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="parent" class="form-label">Trạng thái</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option selected>Chọn trạng thái</option>
                                                    <option value="0">Ẩn</option>
                                                    <option value="1">Hiện</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="parent" class="form-label">Loại danh mục</label>
                                                <select class="form-select" id="category" name="category" required>
                                                    <option selected>Chọn danh mục</option>
                                                    <?php
                                                    require_once './app/model/CategoryModel.php';
                                                    $category = new CategoryModel();
                                                    $listCate = $category->getCate();
                                                    foreach ($listCate as $category) {
                                                        echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <a href="index.php?page=products" style="width: 10%;background-color: red;margin: 0;" class="btn btn-custom">
                                                Quay lại
                                            </a>
                                            <input type="submit" style="width: 10%;" value="Thêm sản phẩm" name="submit"
                                                class="btn btn-primary btn-sub">
                                            <br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- form edit category end -->