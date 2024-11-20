<!-- Main Start -->
<form action="" class="form form-group">
  <div class="container">
    <?php
    extract($data['postdetail']);
    ?>
    <h1 style="margin: 10px 0 0 0" >
      <?php echo $title; ?>
    </h1>
    <hr />
    <!-- Đoạn để nhập văn bản, sẽ truy xuất đoạn này để thêm vào database -->
    <a href="index.php?page=post_manage" class="btn btn-primary">Quay lại</a>
    <a href="index.php?page=edit_post&id=<?= $id; ?>" class="btn btn-primary">Sửa bài viết</a>
    <hr />


    <!-- Ngày tạo bài viết -->
    <input type="text" class="date-create form-control" readonly value="<?= $created_at ?>" name="create_date">

  </div>
  <!-- -------------- -->
  <div id="editor" class="editor" contenteditable="false">
    
    <div class="contentnews">
      <!-- Mục lục -->
      <div class="contentnews-listindex">
          <button id="toggle-button"><i class="fa-solid fa-bars"></i></button>
          <p>Mục lục</p>
      </div>
      <!-- End Mục lục -->
      <?php echo $content; ?>
    </div>

    <br />
    <!-- trạng thái ẩn/hiện bài viết -->
    <div class="container">
      <div class="form-group" style="margin-left: 10px">
        <label class="form-check-label" for="flexCheckDefault">
          Trạng thái
        </label>
        <select name="" id="" class="form-select" disabled>
          <option value="0" <?php echo ($status == 0 ? 'selected' : '') ?>>Ẩn</option>
          <option value="1" <?php echo ($status == 1 ? 'selected' : '') ?>>Hiện</option>
        </select>
      </div>
    </div>
    <hr />
    <!-- -------------- -->

    <!-- Thể loại bài viết -->
    <div class="container">
      <div class="form-group" style="margin-left: 10px">
        <label class="form-check-label" for="flexCheckDefault">
          Thể loại
        </label>
        <select name="" id="" class="form-select" disabled>

          <?php
          require_once './app/model/CategoryModel.php';
          $categoryModel = new CategoryModel();

          // Lấy danh sách thể loại bài viết
          $categories = $categoryModel->getCate();
          $data['categories'] = $categories;

          foreach ($data['categories'] as $item) {
            extract($item);
            echo "<option value='$id' " . ($id == $category_id ? 'selected' : '') . ">$category_name</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <hr />
    <!-- -------------- -->

    <!-- Tác giả -->
    <div class="container">
      <div class="form-group" style="margin-left: 10px">
        <label class="form-check-label" for="flexCheckDefault">
          Tác giả
        </label>
        <select name="" id="" class="form-select" disabled>
          <?php
          require_once './app/model/UserModel.php';
          $userModel = new UserModel();

          // Lấy thông tin tác giả, những user có role là 1
          $user = $userModel->getUserByRole(1);
          ?>
          <?php
          foreach ($user as $user) {
            extract($user);
            echo '<option value="' . $id . '" ' . ($id == $author_id ? 'selected' : '') . '>' . $full_name . '</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <hr />
    <!-- -------------- -->
</form>

<!-- phần comment -->
<div class="container">
  <h2>Bình luận</h2>
  <hr />
  <!-- -------------------------------------------------------- -->
  <?php
  require_once './app/model/PostModel.php';
  $getComments = new PostModel();

  // Lấy id bài viết từ url
  $postId = isset($_GET['id']) ? intval($_GET['id']) : 0;
  // Lấy danh sách comment theo id bài viết
  $comments = $getComments->getCommentsByPostId($postId);
  ?>
  <?php
  if ($comments) {
    foreach ($comments as $comment) {
      extract($comment);
      echo '<div class="comment">';
      echo '<div class="comment-item">';
      echo '<div class="comment-item-header">';
      echo '<img src="img/meo.jpg" class="rounded-circle" alt="" style="width: 40px; height: 40px" />';
      echo '<div class="comment-item-header-info">';
      echo '<h6>' . htmlspecialchars($full_name) . '</h6>';
      echo '<span>' . htmlspecialchars($created_at) . '</span>';
      echo '</div>';
      echo '</div>';
      echo '<div class="comment-item-content">';
      echo '<p>' . htmlspecialchars($comment) . '</p>';
      echo '</div>';
      echo '<button class="btn btn-sm btn-danger">Xoá</button>';
      echo '<button class="btn btn-sm btn-primary">Ẩn</button>';
      echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<p>Không có bình luận nào.</p>';
  }
  ?>
  <br />
  <!-- -------------------------------------------------------- -->
</div>
<br />

<!-- Main End -->