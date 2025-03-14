<div class="" style="max-width: 1420px; margin: auto; padding: 10px;  ">
    <!-- Main Start -->
    <form style=" border: 1px soild black;" action="index.php?page=addPost" method="POST" class="form form-group" enctype="multipart/form-data">
        <div class="container" style="padding: 0">
            <h1>Thêm bài viết</h1>

            <!-- Ngày tạo bài viết -->
            <!-- <label for="create_date">Ngày tạo</label>
        <input type="text" class="date-create form-control" readonly value="" name="create_date"> -->
        </div>
        <br>
        <!-- -------Phần nhập bài viết------- -->
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <textarea type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề"></textarea>
            <br>
            <label for="avt-post" class="form-lable">Ảnh bìa bài viết</label><br>
            <input type="file" class="form-control" name="avt-post" id="avt-post"><br><br>
            <textarea id="content" name="content" rows="20" placeholder="Nhập nội dung" class="form-control"></textarea>
        </div>
        <br />
        <!-- ----------------------- -->

        <!-- trạng thái ẩn/hiện bài viết -->
        <div class="container" style="padding: 0">
            <div class="form-group" style="">
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
        <div class="container" style="padding: 0">
            <div class="form-group" style="">
                <label class="form-check-label" for="flexCheckDefault">
                    Thể loại
                </label>
                <select name="type" id="" class="form-select">
                    <?php
                    require_once './app/model/CategoryModel.php';
                    require_once './app/model/PostModel.php';
                    $categoryModel = new CategoryModel();
                    $categories = $categoryModel->getPostCate();
                    foreach ($categories as $category) {
                        extract($category);
                        echo '<option value="' . $id . '">' . $name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <hr />
        <!-- -------------- -->

        <!-- Tác giả -->
        <div class="container" style="padding: 0">
            <div class="form-group" style="">
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

        <div class="container" style="padding: 0">
            <a href="index.php?page=post_manage" class="btn btn-primary btn-danger" style="width: 150px;background: red; border: none; margin: 0;">Quay lại</a>
            <input type="submit" name="submit" class="btn btn-primary m-2" style="width: 150px;;margin: 0 10px; border: none;">
        </div>
    </form>

    <!-- Main End -->
</div>