<!-- Main start -->
<div class="container-fluid pt-4 px-4">
  <div class="bg-light rounded p-4">
    <div class="d-flex justify-content-between mb-4">
      <h4 class="mb-0">Danh sách sản phẩm</h4>
      <a href="index.php?page=viewAddPro"><button class="btn btn-primary">Thêm sản phẩm</button></a>
    </div>

    <!-- Form search -->
    <form class="d-none d-md-flex ms-4" method="POST">
      <div class="input-group">
        <input class="form-control border-0" type="text" placeholder="Tìm kiếm sản phẩm" name="search_product" />
        <button class="btn" type="submit" name="button_product">
          <span class="input-group-text bg-transparent border-0">
            <a href="index.php?page=search_products"><i class="fa fa-search"></i></a>
          </span>
        </button>
      </div>
    </form>
    <br />
    <!-- Form search end -->

    <?php
    // Including necessary files for controllers and models
    require_once './app/controller/AdProductsController.php';
    require_once './app/model/AdProductsModel.php';
    $productsController = new AdProductsController();
    $productsModel = new AdProductsModel();
    // Check if search form is submitted
    if (isset($_POST['button_product']) && !empty($_POST['search_product'])) {
      // Fetch the list of products based on the search term
      $listPro = $productsController->searchProducts($_POST['search_product']);
    } else {
      // Fetch all products if no search term is provided
      $listPro = $productsModel->getProducts();
    }

    // Fetch categories
    $listCate = $productsController->category->getCate();
    $categoryMap = [];
    foreach ($listCate as $category) {
      $categoryMap[$category['id']] = $category['name'];
    }
    ?>

    <!-- Product table -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Lượt xem</th>
            <th>Danh mục</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>

          <?php
          // Check if products exist
          if (!empty($listPro)) {
            // Loop through each product and display
            foreach ($listPro as $key => $value) {
              // Extract product details
              $id = $value['id'];
              $name = $value['name'];
              $price = $value['price'];
              $image = $value['image'];
              $views = $value['views'];
              $category_id = $value['category_id'];

              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$name</td>";
              echo "<td>$price</td>";
              echo "<td><img src='../public/upload/product/$image' alt='' style='width: 50px; height: 50px' /></td>";
              echo "<td>$views</td>";

              // Get the category name from categoryMap
              $categoryName = isset($categoryMap[$category_id]) ? $categoryMap[$category_id] : 'Không xác định';
              echo "<td>$categoryName</td>";

              // Action buttons (view, edit, delete)
              echo "<td>
                      <a href='index.php?page=products_detail&id=$id'><button class='btn btn-info btn-sm btn-color-text'>Xem</button></a>
                      <a href='index.php?page=viewEdit_products&id=$id'><button class='btn btn-warning btn-sm btn-color-text'>Sửa</button></a>
                      <a href='javascript:void(0);' onclick='confirmDelete($id)'>
                        <button class='btn btn-danger btn-sm btn-color-text'>Xoá</button>
                      </a>
                    </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='7'>Không có sản phẩm nào.</td></tr>";
          }
          ?>

        </tbody>
      </table>
    </div>

    <script>
      // Delete confirmation function
      function confirmDelete(id) {
        const url = "index.php?page=delProducts&id=" + id;
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
          window.location.href = url;
        }
      }
    </script>

  </div>
</div>
