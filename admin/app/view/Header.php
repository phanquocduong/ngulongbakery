<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Admin</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

  <!-- Favicon -->
  <link href="../img/favicon.ico" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.6.0-web/css/all.min.css" />

  <!-- Libraries Stylesheet -->
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="./public/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="./public/css/style.css" rel="stylesheet" />
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link href="./public/css/detailnews.css" rel="stylesheet" />
</head>

<body>
  <div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <!-- <div id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div> -->
    <!-- Spinner End -->

    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
          <h3 class="text-primary">
            <i class="fa fa-hashtag me-2"></i>ADMIN
          </h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
          <div class="position-relative">
            <img class="rounded-circle" src="../public/upload/avatar/<?= $_SESSION['user']['avatar'] ?>"
              alt="<?= $_SESSION['user']['full_name'] ?>" style="width: 40px; height: 40px" />
            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
            </div>
          </div>
          <div class="ms-3">
            <h6 class="mb-0"><?= $_SESSION['user']['full_name'] ?></h6>
            <span>Admin</span>
          </div>
        </div>
        <?php
        $menuItems = [
          'main' => ['icon' => 'fa-tachometer-alt', 'label' => 'Thống kê'],
          'products' => ['icon' => 'fa-box', 'label' => 'Sản phẩm'],
          'categories' => ['icon' => 'fa-th', 'label' => 'Danh mục'],
          'order' => ['icon' => 'fa-shopping-cart', 'label' => 'Đơn hàng'],
          'accounts' => ['icon' => 'fa-users', 'label' => 'Tài khoản'],
          'post_manage' => ['icon' => 'fa-newspaper', 'label' => 'Bài viết'],
          'voucher' => ['icon' => 'fa-ticket-alt', 'label' => 'Mã giảm giá']
        ];
        $currentPage = $_GET['page'] ?? 'main';

        echo '<div class="navbar-nav w-100">';
        foreach ($menuItems as $page => $item) {
          $activeClass = ($currentPage === $page) ? 'active' : '';
          printf(
            '<a href="index.php?page=%s" class="nav-item nav-link %s"><i class="fa %s me-2"></i>%s</a>',
            $page,
            $activeClass,
            $item['icon'],
            $item['label']
          );
        }
        echo '</div>';
        ?>
      </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
          <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
          <i class="fa fa-bars"></i>
        </a>
        <div class="navbar-nav align-items-center ms-auto">
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <i class="fa fa-envelope me-lg-2"></i>
              <span class="d-none d-lg-inline-flex">Tin Nhắn</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
              <a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <img class="rounded-circle" src="../img/meo1.jpg" alt="" style="width: 40px; height: 40px" />
                  <div class="ms-2">
                    <h6 class="fw-normal mb-0">
                      Em Gái Mưa đã gửi cho bạn một tin nhắn
                    </h6>
                    <small>5 phút trước</small>
                  </div>
                </div>
              </a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <img class="rounded-circle" src="../img/meo2.jpg" alt="" style="width: 40px; height: 40px" />
                  <div class="ms-2">
                    <h6 class="fw-normal mb-0">
                      Con Mèo Cute đã gửi cho bạn một tin nhắn
                    </h6>
                    <small>10 phút trước</small>
                  </div>
                </div>
              </a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <img class="rounded-circle" src="../img/meo3.jpg" alt="" style="width: 40px; height: 40px" />
                  <div class="ms-2">
                    <h6 class="fw-normal mb-0">
                      Kẻ Huỷ Diệt đã gửi cho bạn một tin nhắn
                    </h6>
                    <small>15 phút trước</small>
                  </div>
                </div>
              </a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item text-center">Xem Thêm</a>
            </div>
          </div>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <i class="fa fa-bell me-lg-2"></i>
              <span class="d-none d-lg-inline-flex">Thông Báo</span>
            </a>
            <?php
            use App\Model\OrderModel;
            require_once './app/model/OrderModel.php';
            $orderModel = new OrderModel();
            $newOrders = $orderModel->getNewOrders();
            ?>

            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
              <?php if (!empty($newOrders)) { ?>
                <?php
                // Hàm tính thời gian
                function timeAgo($datetime)
                {
                  date_default_timezone_set('Asia/Ho_Chi_Minh'); // Set timezone to Vietnam
                  $now = new DateTime();
                  $ago = new DateTime($datetime);
                  $diff = $now->diff($ago);

                  if ($diff->y > 0) {
                    return $diff->y . ' năm trước';
                  }
                  if ($diff->m > 0) {
                    return $diff->m . ' tháng trước';
                  }
                  if ($diff->d > 0) {
                    if ($diff->d == 1) {
                      return 'Hôm qua';
                    }
                    return $diff->d . ' ngày trước';
                  }
                  if ($diff->h > 0) {
                    return $diff->h . ' giờ trước';
                  }
                  if ($diff->i > 0) {
                    return $diff->i . ' phút trước';
                  }
                  if ($diff->s > 30) {
                    return $diff->s . ' giây trước';
                  }
                  return 'Vừa xong';
                }
                // Thay đổi trong phần hiển thị thông báo
                ?>
                <a href="index.php?page=order" class="dropdown-item">
                  <h6 class="fw-normal mb-0">Có 1 đơn hàng mới</h6>
                  <small><?php echo timeAgo($newOrders[0]['created_at']); ?></small>
                </a>
                <hr class="dropdown-divider" />
                <a href="#" class="dropdown-item text-center">Hiện Toàn Bộ Thông Báo</a>
              <?php } else { ?>
                <a href="#" class="dropdown-item">
                  <h6 class="fw-normal mb-0">Không có thông báo</h6>
                </a>
              <?php } ?>
              <!-- <hr class="dropdown-divider" /> -->
            </div>
          </div>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img class="rounded-circle me-lg-2" src="../public/upload/avatar/<?= $_SESSION['user']['avatar'] ?>"
                alt="<?= $_SESSION['user']['full_name'] ?>" style="width: 40px; height: 40px" />
              <span class="d-none d-lg-inline-flex"><?= $_SESSION['user']['full_name'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
              <a href="index.php?page=account_admin" class="dropdown-item">Thông Tin Tài Khoản</a>
              <a href="index.php?page=logout" class="dropdown-item">Đăng Xuất</a>
            </div>
          </div>
        </div>
      </nav>
      <!-- Navbar End -->
      <style>
        .ck-editor__editable_inline {
          min-height: 450px;
          max-height: 650px;
        }
      </style>
      <!-- header end -->