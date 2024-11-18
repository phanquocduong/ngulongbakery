<!-- Main Start -->
<form action="" class="form form-group">
          <div class="container">
            <?php
            extract($data['postdetail']);
            ?>
            <h1 style="margin: 10px 0 0 0">
              <?php echo $title; ?>
            </h1>
            <hr />
            <!-- Đoạn để nhập văn bản, sẽ truy xuất đoạn này để thêm vào database -->
            <a href="index.php?page=post_manage" class="btn btn-primary">Quay lại</a>
            <a href="index.php?page=edit_post" class="btn btn-primary">Sửa bài viết</a>
            <hr />
            <div class="form-control">
              Ngày tạo bài viết: <span> <?php echo $created_at ?></span>
            </div>
            <!-- Ngày tạo bài viết -->
          </div>
          <!-- -------------- -->
          <div id="editor" class="editor" contenteditable="false">
          <div class="contentnews">
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
                <option value="0">Ẩn</option>
                <option value="1">Hiện</option>
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
                <option value="0"><?php echo $category_name?></option>
                <option value="1"></option>
                <option value="2">Khuyến mãi</option>
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
                <option value="0"><?php echo $author_name?></option>
                <option value="1">Admin</option>
                <option value="2">Người dùng</option>
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
            foreach($data['comments'] as $item){
              extract($item);
            } 
          ?>
          <div class="comment">
            <div class="comment-item">
              <div class="comment-item-header">
                <img
                  src="img/meo.jpg"
                  class="rounded-circle"
                  alt=""
                  style="width: 40px; height: 40px"
                />
                <div class="comment-item-header-info">
                  <h6>PhanGB</h6>
                  <span>10-11-2024</span>
                </div>
              </div>
              <div class="comment-item-content">
                <p>Bài viết rất hay, mình sẽ ghé thăm Ngũ Long Bakery ngay</p>
              </div>
              <button class="btn btn-sm btn-danger">Xoá</button>
              <button class="btn btn-sm btn-primary">Ẩn</button>
            </div>
          </div>
          <br />
          <!-- -------------------------------------------------------- -->

          <div class="comment">
            <div class="comment-item">
              <div class="comment-item-header">
                <img
                  src="img/meo3.jpg"
                  alt=""
                  style="width: 40px; height: 40px"
                  class="rounded-circle"
                />
                <div class="comment-item-header-info">
                  <h6>Con Meobeo</h6>
                  <span>10-11-2024</span>
                </div>
              </div>
              <div class="comment-item-content">
                <p>Bài viết rất hay, mình sẽ ghé thăm Ngũ Long Bakery ngay</p>
              </div>
              <button class="btn btn-sm btn-danger">Xoá</button>
              <button class="btn btn-sm btn-primary">Ẩn</button>
            </div>
          </div>
        </div>
        <br />

        <!-- Main End -->