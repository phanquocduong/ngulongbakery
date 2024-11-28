<!-- content start -->
<!-- form edit products -->
<div class="container-fluid py-4 px-4">
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow">
        <div class="card-body">
          <h2 class="mb-4">
            Sửa
            <span class="text-primary">Sản Phẩm</span>
          </h2>
          <form action="index.php?page=editPro" method="POST" enctype="multipart/form-data">
            <div class="container-fluid px-4">
              <div class="row">
                <div class="col-12 col -lg-6">
                  <?php
                  require_once './app/model/CategoryModel.php';
                  require_once './app/model/AdProductsModel.php';
                  require_once './app/controller/AdProductsController.php';
                  require_once './app/controller/AdCategoriesController.php';
                  $products = new AdProductsModel();
                  $cate = new CategoryModel();
                  $listCate = $cate->getCate();
                  $listPro = $products->getProducts();
                  $categoryMap = [];
                  foreach ($listCate as $category) {
                    $categoryMap[$category['id']] = $category['name'];
                  }
                  ?>
                  <?php
                  $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                  $product = $products->getProductById($product_id);
                  $listCate = $cate->getCate();
                  $categoryMap = [];
                  foreach ($listCate as $category) {
                    $categoryMap[$category['id']] = $category['name'];
                  }
                  ?>
                  <?php
                  if ($product) {
                    extract($product);
                  ?>
                    <div class='card card-body'>
                      <div class='mb-3'>
                        <input disabled type="hidden" name="id" value="<?= $id ?>">
                        <label for='name' class='form-label'>Tên Sản Phẩm</label>
                        <input disabled type='text' class='form-control' id='name' name='name'
                          value='<?php echo $name; ?>' />
                      </div>
                      <div class='mb-3'>
                        <label for='price' class='form-label'>Giá Gốc (VNĐ)</label>
                        <input disabled type='number' class='form-control' id='price' name='price'
                          value='<?php echo  $price; ?>' />
                      </div>
                      <div class='mb-3'>
                        <label for='price' class='form-label'>Giá Khuyến Mãi (VNĐ)</label>
                        <input disabled type='number' class='form-control' id='price_sale' name='price_sale'
                          value='<?php echo $sale; ?>' />
                        <br />
                        <div class='mb-3'>
                          <label for='image' class='form-label'>Hình Ảnh</label><br />
                          <img src='../public/upload/product/<?php echo $image; ?>'
                            alt='Product Image' class='img-thumbnail' style='width: 100px;' />
                          <br>
                          <br />
                          <label for='image' class='form-label'>Hình Ảnh Con</label>

                          <div class="" style="">
                            <div class='mb-3' style="display:flex;">
                              <?php
                              // Tách chuỗi chứa tên các file ảnh thành mảng
                              $imageArray = explode(',', $extra_image);
                              foreach ($imageArray as $extra_image) {
                              ?>

                                <img
                                  src='../public/upload/product/<?php echo $extra_image; ?>'
                                  alt='Product Image' class='img-thumbnail' style='width: 100px;' />

                              <?php
                              }
                              ?>
                            </div>
                            <br>
                          </div>

                        </div>
                        <div class='mb-3'>
                          <label for='short-description' class='form-label'>Mô Tả Ngắn</label>
                          <textarea disabled class='form-control' id='short_description' name='short_description'
                            rows='5'><?php echo $short_description; ?></textarea>
                          <br />
                          <label for='description'>Mô Tả Chi Tiết</label>
                          <div disabled id="editor" class="editor">
                            <?php echo $detailed_description; ?>
                          </div>
                          <div class="add-element">


                            <input type="file" id="image-input" accept="image/*" style="display: none" />
                          </div>
                        </div>
                        <div class='mb-3'>
                          <label for='stock_quantity' class='form-label'>Số Lượng Hàng Tồn Kho</label>
                          <input disabled type='number' class='form-control' id='stock_quantity' name='stock_quantity'
                            value='<?php echo $stock_quantity; ?>' />
                        </div>
                        <div class='mb-3'>
                          <label for='views' class='form-label'>Số Lượt Xem</label>
                          <input disabled type='number' class='form-control' id='views' name='views'
                            value='<?php echo $views; ?>' readonly />
                        </div>
                        <div class='mb-3'>
                          <label for='tag' class='form-label'>Thẻ</label>
                          <input disabled type='text' class='form-control' id='tag' name='tag'
                            value='<?php echo $tags; ?>' />
                        </div>
                        <div class='mb-3'>
                          <label for='parent' class='form-label'>Loại danh mục</label>
                          <select class='form-select' id='category' name='category'>
                            <option>Chọn danh mục</option>
                            <?php

                            foreach ($listCate as $category) {
                              $selected = $category['id'] == $category_id ? 'selected' : '';
                              echo "<option disabled value='{$category['id']}' $selected>" . $category['name'] . "</option>";
                            }


                            ?>
                          </select>
                        <?php
                      }
                        ?>
                        <div class="" style="display: flex; margin-top: 30px;"> <a href="index.php?page=products" style="width: 10%;background: red; border: none;" class="btn btn-primary">
                            Quay lại
                          </a><br>
                          <a href="index.php?page=products" style="width: 10%;margin: 0 10px; border: none;" class="btn btn-primary">
                            sửa sản phẩm
                          </a>
                        </div>
                        </div>

                        <br />
                      </div>
                    </div>

                </div>
              </div>

            </div>
            <hr>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- form edit category end -->


<!-- content end -->

<!-- Product review -->
<h2 class="text text-center text-padding">Đánh Giá Sản Phẩm</h2>
<div class="container-fluid pt-4 px-4">
  <div class="bg-light rounded p-4">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên Người Dùng</th>
            <th>Đánh Giá Sao</th>
            <th>Nội Dung Đánh Giá</th>
            <th>Ngày</th>
            <th>Đánh Dấu</th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Con Mèo Ngu Ngốc</td>
            <td class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="bi bi-star"></i>
            </td>
            <td>Sản phẩm rất tốt</td>
            <td>08-11-2024</td>
            <td>
              <button class="btn toggle-star">
                <i class="fa fa-star"></i>
              </button>
            </td>
            <td><button class="btn btn-danger">Xoá</button></td>
          </tr>
          <tr>
            <td>2</td>
            <td>Tran Thi Đẹp</td>
            <td class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="bi bi-star"></i>
            </td>
            <td>Giá cả hợp lý</td>
            <td>08-11-2024</td>
            <td>
              <button class="btn toggle-star">
                <i class="fa fa-star"></i>
              </button>
            </td>
            <td><button class="btn btn-danger">Xoá</button></td>
          </tr>
          <tr>
            <td>3</td>
            <td>Con Sói Cô Độc</td>
            <td class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </td>
            <td>Chất lượng tuyệt vời</td>
            <td>07-11-2024</td>
            <td>
              <button class="btn toggle-star">
                <i class="fa fa-star"></i>
              </button>
            </td>
            <td><button class="btn btn-danger">Xoá</button></td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- content end -->