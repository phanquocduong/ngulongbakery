<!-- Main start  -->
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
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Lượt xem</th>
            <th>Danh mục</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->data['products'] as $product): ?>
            <tr>
              <td><?php echo $product['id']; ?></td>
              <td><?php echo $product['name']; ?></td>
              <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</td>
              <td><img src="../public/upload/product/<?php echo $product['image']; ?>" alt=""
                  style="width: 50px; height: 50px"></td>
              <td><?php echo $product['views']; ?></td>
              <td><?php echo $product['category_name']; ?></td>
              <td>
                <a href="index.php?page=products_detail&id=<?php echo $product['id']; ?>"
                  class="btn btn-info btn-sm">Xem</a>
                <a href="index.php?page=viewEdit_products&id=<?php echo $product['id']; ?>"
                  class="btn btn-warning btn-sm">Sửa</a>
                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $product['id']; ?>)"
                  class="btn btn-danger btn-sm">Xóa</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Phân trang -->
      <?php
      // Get current page from URL parameter
      $currentPage = isset($_GET['p']) ? (int) $_GET['p'] : 1;
      $limit = 10;
      $offset = ($currentPage - 1) * $limit;

      // Get products with pagination
      $listPro = $productsModel->getProducts($limit, $offset);
      ?>
      <?php if (isset($this->data['totalPages']) && $this->data['totalPages'] > 1): ?>
        <div class="pagination">
          <?php if ($this->data['currentPage'] > 1): ?>
            <a href="index.php?page=products&p=<?php echo ($this->data['currentPage'] - 1); ?>"><</a>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $this->data['totalPages']; $i++): ?>
            <a href="index.php?page=products&p=<?php echo $i; ?>"
              class="<?php echo ($this->data['currentPage'] == $i) ? 'active' : ''; ?>">
              <?php echo $i; ?>
            </a>
          <?php endfor; ?>

          <?php if ($this->data['currentPage'] < $this->data['totalPages']): ?>
            <a href="index.php?page=products&p=<?php echo ($this->data['currentPage'] + 1); ?>">></a>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <style>
        .pagination a {
          display: inline-block;
          padding: 8px 16px;
          margin: 0 4px;
          text-decoration: none;
          color: #007bff;
          border: 1px solid #ddd;
          border-radius: 5px;
          transition: background-color 0.3s, color 0.3s;
        }

        .pagination a.active {
          background-color: #007bff;
          color: white;
          border: 1px solid #007bff;
        }

        .pagination a:hover:not(.active) {
          background-color: #ddd;
          color: #007bff;
        }
      </style>
    </div>

    <script>
      function confirmDelete(id) {
        const url = "index.php?page=delProducts&id=" + id;
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
          window.location.href = url;
        }
      }
    </script>

  </div>
</div>