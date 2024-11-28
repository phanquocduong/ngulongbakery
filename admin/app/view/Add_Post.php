<!-- Main Start -->
<form action="index.php?page=addPost" method="POST" class="form form-group" enctype="multipart/form-data">
    <div class="container">
        <h1>Thêm bài viết</h1>

        <!-- Ngày tạo bài viết -->
        <input type="text" class="date-create form-control" readonly value="" name="create_date" >
    </div>
    <br>
    <!-- -------Phần nhập bài viết------- -->
    <div class="mb-3">
        <label for="title" class="form-label">Tiêu đề</label>
        <textarea type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề"></textarea>
        <br>    
    <textarea id="content" name="content" rows="20" placeholder="Nhập nội dung" class="form-control"></textarea>
  </div>
    <br />
    <!-- -------------- -->

    <!-- input để thêm bài viết -->
    <div class="add-element">
        <select id="element-type" class="form-select m-2">
            <!-- <option value="h1">Tiêu đề H1</option> -->
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
    <!-- ----------------------- -->

    <!-- trạng thái ẩn/hiện bài viết -->
    <div class="container">
        <div class="form-group" style="margin-left: 10px">
            <label class="form-check-label" for="flexCheckDefault">
                Trạng thái
            </label>
            <select name="status" id="" class="form-select">
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
            <select name="type" id="" class="form-select">
                <?php
                require_once './app/model/CategoryModel.php';
                require_once './app/model/PostModel.php';
                $categoryModel = new CategoryModel();
                $categories = $categoryModel->getCate();
                foreach ($categories as $category) {
                    extract($category);
                    echo '<option value="' . $id . '">' . $name. '</option>';
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
            <?php
            require_once './app/model/UserModel.php';
            $userModel = new UserModel();

            // Lấy thông tin tác giả, những user có role là 1
            $users = $userModel->getUserByRole(1);
            ?>
            <select name="user" id="user" class="form-select">
                <?php
                foreach ($users as $user) {
                    echo '<option value="' . $user['id'] . '">' . $user['full_name'] . '</option>';
                }
                ?>
            </select>

        </div>
    </div>
    <hr />
    <!-- -------------- -->

    <div class="container">
        <input type="submit" name="submit" class="btn btn-primary m-2" style="width:100%">
    </div>
</form>
<a href="index.php?page=post_manage" class="btn btn-primary btn-danger" style="margin-left:20px;">Quay lại</a>
<!-- Main End -->