<!-- Main start  -->
<div class="container-fluid pt-4 px-4">
  <div class="bg-light rounded p-4">
    <div class="d-flex justify-content-between mb-4">
      <h4 class="mb-0">Danh sách sản phẩm</h4>
      <a href="index.php?page=viewAddPro"><button class="btn btn-primary">Thêm sản phẩm</button></a>
    </div>
    <!-- form search -->
    <form class="d-none d-md-flex ms-4">
      <div class="input-group">
        <input class="form-control border-0" type="search" placeholder="Tìm kiếm sản phẩm" />
        <button class="btn">
          <span class="input-group-text bg-transparent border-0">
            <i class="fa fa-search"></i>
          </span>
        </button>
      </div>
    </form>
    <br />
    <!-- form search end -->
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
          foreach ($listPro as $key => $value) {
            extract($value);
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$price</td>";
            echo "<td><img src='../public/upload/product/$image' alt='' style='width: 50px; height: 50px' /></td>";
            echo "<td>$views</td>";
            $categoryName = isset($categoryMap[$category_id]) ? $categoryMap[$category_id] : 'Không xác định';
            echo "<td>$categoryName</td>";
            echo "<td>
              <a href='index.php?page=products_detail&id=$id'><button class='btn btn-info btn-sm btn-color-text'>
                  Xem
                </button></a>
              <a href='index.php?page=viewEdit_products&id=$id'><button class='btn btn-warning btn-sm btn-color-text'>
                  Sửa
                </button></a>";
                echo '<a href="javascript:void(0);" onclick="confirmDelete(' . $id . ')">
                <button class="btn btn-danger btn-sm btn-color-text">
                  xoá
                </button>
                </a>';
            ?>
            <script>
              function confirmDelete(id) {
                const url = "index.php?page=delProducts&id=" + id;
                if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
                  window.location.href = url;
                }
              }
            </script>
            <?php
            echo "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>