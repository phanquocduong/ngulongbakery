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
                    echo "<div class='card card-body'>";
                    echo "<div class='mb-3'>";
                    echo "<label for='name' class='form-label'>Tên Sản Phẩm</label>";
                    echo "<input type='text' class='form-control' id='name' name='name' value='$name' />";
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='price' class='form-label'>Giá Gốc (VNĐ)</label>";
                    echo "<input type='number' class='form-control' id='price' name='price' value='$price' />";
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='price' class='form-label'>Giá Khuyến Mãi (VNĐ)</label>";
                    echo "<input type='number' class='form-control' id='price_sale' name='price_sale' value='$sale' />";
                    echo "<br />";
                    echo "<div class='mb-3'>";
                    echo "<label for='image' class='form-label'>Hình Ảnh</label><br />";
                    echo "<img src='../public/upload/product/$image' alt='Product Image' class='img-thumbnail' style='width: 100px;' />";
                    echo "<input class='form-control' type='file' id='image' name='image' />";
                    echo "<br />";
                    echo "<label for='image' class='form-label'>Hình Ảnh Con</label>";
                    echo "<hr />";
                    // Tách chuỗi chứa tên các file ảnh thành mảng
                    $imageArray = explode(',', $extra_image);
                    foreach ($imageArray as $image) {
                      echo "<div class='mb-3'>";
                      echo "<img src='../public/upload/product/$image' alt='Product Image' class='img-thumbnail' style='width: 100px;' />";
                      echo "<input class='form-control' type='file' id='ex_image' name='ex_image'/>";
                      echo "<hr />";
                      echo "</div>";
                    }
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='short-description' class='form-label'>Mô Tả Ngắn</label>";
                    echo "<textarea class='form-control' id='short_description' name='short_description' rows='5'>$short_description</textarea>";
                    echo "<br />";
                    echo "<label for='description'>Mô Tả Chi Tiết</label>";
                    ?>
                    <div id="editor" class="editor" contenteditable="true"></div>
                    <div class="add-element">
                      <select id="element-type" class="form-select m-2">
                        <option value="h1">Tiêu đề H1</option>
                        <option value="h2">Tiêu đề H2</option>
                        <option value="h3">Tiêu đề H3</option>
                        <option value="h4">Tiêu đề H4</option>
                        <option value="h5">Tiêu đề H5</option>
                        <option value="h6">Tiêu đề H6</option>
                        <option value="p">Nội dung (Paragraph)</option>
                        <option value="img">Hình ảnh</option>
                      </select>
                      <button type="button" id="add-element-btn" class="btn btn-primary m-2" style="margin-left: 7px">
                        Thêm thẻ
                      </button>
                      <input type="file" id="image-input" accept="image/*" style="display: none" />
                    </div>
                    <?php
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='stock_quantity' class='form-label'>Số Lượng Hàng Tồn Kho</label>";
                    echo "<input type='number' class='form-control' id='stock_quantity' name='stock_quantity' value='$stock_quantity' />";
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='views' class='form-label'>Số Lượt Xem</label>";
                    echo "<input type='number' class='form-control' id='views' name='views' value='$views' disabled />";
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='tag' class='form-label'>Thẻ</label>";
                    echo "<input type='text' class='form-control' id='tag' name='tag' value='$tags' />";
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='parent' class='form-label'>Loại danh mục</label>";
                    echo "<select class='form-select' id='category' name='category'>";
                    echo "<option selected>Chọn danh mục</option>";
                    foreach ($listCate as $category) {
                      $selected = $category['id'] == $category_id ? 'selected' : '';
                      echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "<input type='submit' class='btn btn-primary btn-sub'/>";
                    echo "<br />";
                    echo "</div>";
                    echo "</div>";
                  }
                  ?>
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