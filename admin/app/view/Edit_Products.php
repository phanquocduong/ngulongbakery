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
                        <label for='name' class='form-label'>Tên Sản Phẩm</label>
                        <input type='text' class='form-control' id='name' name='name'
                          value='<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>' />
                      </div>
                      <div class='mb-3'>
                        <label for='price' class='form-label'>Giá Gốc (VNĐ)</label>
                        <input type='number' class='form-control' id='price' name='price'
                          value='<?php echo htmlspecialchars($price, ENT_QUOTES, 'UTF-8'); ?>' />
                      </div>
                      <div class='mb-3'>
                        <label for='price' class='form-label'>Giá Khuyến Mãi (VNĐ)</label>
                        <input type='number' class='form-control' id='price_sale' name='price_sale'
                          value='<?php echo htmlspecialchars($sale, ENT_QUOTES, 'UTF-8'); ?>' />
                        <br />
                        <div class='mb-3'>
                          <label for='image' class='form-label'>Hình Ảnh</label><br />
                          <img src='../public/upload/product/<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>'
                            alt='Product Image' class='img-thumbnail' style='width: 100px;' />
                          <input class='form-control' type='file' id='image' name='image' />
                          <input type="hidden" name="existing_image"
                            value="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" />
                          <br />
                          <label for='image' class='form-label'>Hình Ảnh Con</label>
                          <hr />
                          <?php
                          // Tách chuỗi chứa tên các file ảnh thành mảng
                          $imageArray = explode(',', $extra_image);
                          foreach ($imageArray as $extra_image) {
                            ?>
                            <div class='mb-3'>
                              <img
                                src='../public/upload/product/<?php echo htmlspecialchars($extra_image, ENT_QUOTES, 'UTF-8'); ?>'
                                alt='Product Image' class='img-thumbnail' style='width: 100px;' />
                              <input class='form-control' type='file' id='ex_image' name='ex_image[]' />
                              <input type="hidden" name="existing_extra_image[]"
                                value="<?php echo htmlspecialchars($extra_image, ENT_QUOTES, 'UTF-8'); ?>" />
                              <?php
                          }
                          ?>
                            <hr />
                          </div>

                        </div>
                        <div class='mb-3'>
                          <label for='short-description' class='form-label'>Mô Tả Ngắn</label>
                          <textarea class='form-control' id='short_description' name='short_description'
                            rows='5'><?php echo htmlspecialchars($short_description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                          <br />
                          <label for='description'>Mô Tả Chi Tiết</label>
                          <div id="editor" class="editor" contenteditable="true">
                            <?php echo htmlspecialchars($detailed_description, ENT_QUOTES, 'UTF-8'); ?>
                          </div>
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
                            <button type="button" id="add-element-btn" class="btn btn-primary m-2"
                              style="margin-left: 7px">
                              Thêm thẻ
                            </button>
                            <input type="file" id="image-input" accept="image/*" style="display: none" />
                          </div>
                        </div>
                        <div class='mb-3'>
                          <label for='stock_quantity' class='form-label'>Số Lượng Hàng Tồn Kho</label>
                          <input type='number' class='form-control' id='stock_quantity' name='stock_quantity'
                            value='<?php echo htmlspecialchars($stock_quantity, ENT_QUOTES, 'UTF-8'); ?>' />
                        </div>
                        <div class='mb-3'>
                          <label for='views' class='form-label'>Số Lượt Xem</label>
                          <input type='number' class='form-control' id='views' name='views'
                            value='<?php echo htmlspecialchars($views, ENT_QUOTES, 'UTF-8'); ?>' readonly />
                        </div>
                        <div class='mb-3'>
                          <label for='tag' class='form-label'>Thẻ</label>
                          <input type='text' class='form-control' id='tag' name='tag'
                            value='<?php echo htmlspecialchars($tags, ENT_QUOTES, 'UTF-8'); ?>' />
                        </div>
                        <div class='mb-3'>
                          <label for='parent' class='form-label'>Loại danh mục</label>
                          <select class='form-select' id='category' name='category'>
                            <option>Chọn danh mục</option>
                            <?php
                            foreach ($listCate as $category) {
                              $selected = $category['id'] == $category_id ? 'selected' : '';
                              echo "<option value='{$category['id']}' $selected>" . htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                            }
                            ?>
                          </select>
                          <?php
                  }
                  ?>
                      </div>
                      <input type='submit' name="submit" class='btn btn-primary btn-sub' />
                      <br />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <hr>
          <a href="index.php?page=products" class="btn btn-primary">
            Quay lại
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- form edit category end -->