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
  <!-- <link href="./public/css/detailnews.css" rel="stylesheet" /> -->
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
            <img class="rounded-circle" src="../img/meo.jpg" alt="" style="width: 40px; height: 40px" />
            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
            </div>
          </div>
          <div class="ms-3">
            <h6 class="mb-0">PhanGB</h6>
            <span>Admin</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
          <a href="index.php?page=main" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Thống kê</a>
          <a href="index.php?page=products" class="nav-item nav-link"><i class="fa fa-box me-2"></i>Sản phẩm</a>
          <a href="index.php?page=categories" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Danh mục</a>
          <a href="index.php?page=order" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Đơn hàng</a>
          <a href="index.php?page=accounts" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Tài khoản</a>
          <a href="index.php?page=post_manage" class="nav-item nav-link"><i class="fa fa-newspaper me-2"></i>Bài viết</a>
          <a href="index.php?page=voucher" class="nav-item nav-link"><i class="fa fa-ticket-alt me-2"></i>Mã giảm giá</a>
        </div>
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
        <form class="d-none d-md-flex ms-4">
          <input class="form-control border-0" type="search" placeholder="Search" />
        </form>
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
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
              <a href="#" class="dropdown-item">
                <h6 class="fw-normal mb-0">Thông tin đã được cập nhật</h6>
                <small>Vừa xong</small>
              </a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item">
                <h6 class="fw-normal mb-0">Mật khẩu đã được thay đổi</h6>
                <small>2 phút trước</small>
              </a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item text-center">Hiện Toàn Bộ Thông Báo</a>
            </div>
          </div>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img class="rounded-circle me-lg-2" src="../img/meo.jpg" alt="" style="width: 40px; height: 40px" />
              <span class="d-none d-lg-inline-flex">PhanGB</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
              <a href="#" class="dropdown-item">Thông Tin Tài Khoản</a>
              <a href="#" class="dropdown-item">Cài Đặt</a>
              <a href="#" class="dropdown-item">Đăng Xuất</a>
            </div>
          </div>
        </div>
      </nav>
      <!-- Navbar End -->

      <!-- header end -->