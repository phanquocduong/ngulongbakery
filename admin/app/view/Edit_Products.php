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
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <label for='name' class='form-label'>Tên Sản Phẩm</label>
                        <input type='text' class='form-control' id='name' name='name' value='<?php echo $name; ?>' />
                      </div>
                      <div class='mb-3'>
                        <label for='price' class='form-label'>Giá Gốc (VNĐ)</label>
                        <input type='number' class='form-control' id='price' name='price'
                          value='<?php echo $price; ?>' />
                      </div>
                      <div class='mb-3'>
                        <label for='price' class='form-label'>Giá Khuyến Mãi (VNĐ)</label>
                        <input type='number' class='form-control' id='price_sale' name='price_sale'
                          value='<?php echo $sale; ?>' />
                        <br />
                        <div class='mb-3'>
                          <label for='image' class='form-label'>Hình Ảnh</label><br />
                          <img src='../public/upload/product/<?php echo $image; ?>' alt='Product Image'
                            class='img-thumbnail' style='width: 100px;' />
                          <input class='form-control' type='file' id='image' name='image' />
                          <input type="hidden" name="existing_image" value="<?php echo $image; ?>" />
                          <br />
                          <label for='image' class='form-label'>Hình Ảnh Con</label>
                          <hr />
                          <?php
                          // Tách chuỗi chứa tên các file ảnh thành mảng
                          $imageArray = explode(',', $extra_image);
                          foreach ($imageArray as $extra_image) {
                          ?>
                            <div class='mb-3'>
                              <img src='../public/upload/product/<?php echo $extra_image; ?>' alt='Product Image'
                                class='img-thumbnail' style='width: 100px;' />
                              <input class='form-control' type='file' id='ex_image' name='ex_image[]' />
                              <input type="hidden" name="existing_extra_image[]" value="<?php echo $extra_image; ?>" />
                            <?php
                          }
                            ?>
                            <hr />
                            </div>

                        </div>
                        <div class='mb-3'>
                          <label for='short-description' class='form-label'>Mô Tả Ngắn</label>
                          <textarea class='form-control' id='short_description' name='short_description'
                            rows='5'><?php echo $short_description; ?></textarea>
                          <br />
                          <label for='description'>Mô Tả Chi Tiết</label><br>
                          <textarea id="content" name="content" rows="20" placeholder="Nhập nội dung" class="form-control">
                                <?php echo $detailed_description; ?>
                            </textarea>
                        </div>
                        <div class='mb-3'>
                          <label for='stock_quantity' class='form-label'>Số Lượng Hàng Tồn Kho</label>
                          <input type='number' class='form-control' id='stock_quantity' name='stock_quantity'
                            value='<?php echo $stock_quantity; ?>' />
                        </div>
                        <div class='mb-3'>
                          <label for='views' class='form-label'>Số Lượt Xem</label>
                          <input type='number' class='form-control' id='views' name='views' value='<?php echo $views; ?>'
                            readonly />
                        </div>
                        <div class='mb-3'>
                          <label for='tag' class='form-label'>Thẻ</label>
                          <input type='text' class='form-control' id='tag' name='tag' value='<?php echo $tags; ?>' />
                        </div>
                        <div class='mb-3'>
                          <label for='parent' class='form-label'>Loại danh mục</label>
                          <select class='form-select' id='category' name='category'>
                            <option>Chọn danh mục</option>
                            <?php
                            foreach ($listCate as $category) {
                              $selected = $category['id'] == $category_id ? 'selected' : '';
                              echo "<option value='{$category['id']}' $selected>" . $category['name'] . "</option>";
                            }
                            ?>
                          </select>
                        <?php
                      }
                        ?>
                        </div>

                        <a href="index.php?page=products" style="width: 150px;;background: red; border: none;" class="btn btn-primary">
                          Quay lại
                        </a>
                        <input  style="width: 150px;;margin: 0 10px; border: none;" value="Sửa sản phẩm" type='submit' name="submit" class='btn btn-primary btn-sub' />
                        <br />
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </form>
          <hr>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- form edit category end -->