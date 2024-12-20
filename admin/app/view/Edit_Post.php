<!-- Main Start -->
<form action="index.php?page=editPost" method="POST" class="form form-group" enctype="multipart/form-data">
    <div class="container">
        <!-- <h1 style="margin: 10px 0 0 0"> -->
        <!-- Khám Phá Các Loại Bánh Bông Lan Đặc Biệt Tại Ngũ Long Bakery -->
        <?php
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        require_once './app/model/PostModel.php';
        $postModel = new PostModel();
        $post = $postModel->getIdPost($id);
        extract($post);
        ?>
        <div class="" style="padding: 20px  0 0 0;">Ngày tạo: <?= $created_at ?> </div><hr>
        <input type="hidden" class="date-create form-control" readonly value="<?= $created_at ?>" name="create_date">
        <label for="title" style="font-size:25px; font-weight:bold;">Tiêu đề: <?= $title ?> </label>
        <input type="hidden" name="title" value="<?= $title ?>" class="form-control">
        <!-- </h1> -->
        <hr />
        <label for="" class="form-lable">Ảnh bìa bài viết</label><br>
        <img src="../public/upload/post/images/<?= $image ?>" alt="" style="width: 200px; height: 200px;">
        <input type="hidden" name="existing_image" value="<?php echo $image; ?>" />
        <input type="file" class="form-control" name="avt-post1"><br><br>
        <!-- Đoạn để nhập văn bản, sẽ truy xuất đoạn này để thêm vào database -->

        <hr />
        <hr>
        <!-- Ngày tạo bài viết -->

        <input type="hidden" name="id" value="<?= $id ?>">
    </div>
    <!-- -------------- -->
    <div id="app">
        <!-- Vùng nhập liệu có thể chỉnh sửa, hỗ trợ các thẻ HTML -->
        <div class="mb-3">
            <?php
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            require_once './app/model/PostModel.php';
            $postModel = new PostModel();
            $post = $postModel->getIdPost($id);
            ?>
            <textarea id="content" name="content" rows="20" placeholder="Nhập nội dung" class="form-control">
                        <?php
                        if ($post) {
                            extract($post);
                            echo '<div class="contentnews">';
                            echo '<p>' . $content . '</p>';
                            echo '</div>';
                        } else {
                            echo '<p>Không tìm thấy bài viết.</p>';
                        }
                        ?>
            </textarea>
        </div>
        <br />
    </div>
    <br />
    <!-- trạng thái ẩn/hiện bài viết -->
    <div class="container">
        <div class="form-group" style="margin-left: 10px">
            <label class="form-check-label" for="flexCheckDefault">
                Trạng thái
            </label>
            <select name="status" id="" class="form-select">
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
            <select name="type" id="" class="form-select">

                <?php
                require_once './app/model/CategoryModel.php';
                $categoryModel = new CategoryModel();

                // Lấy danh sách thể loại bài viết
                $categories = $categoryModel->getPostCate();
                $data['categories'] = $categories;

                foreach ($data['categories'] as $item) {
                    $id = $item['id'];
                    $category_name = $item['name'];
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
            <select name="user" id="" class="form-select">
                <?php
                require_once './app/model/UserModel.php';
                $userModel = new UserModel();
                // Lấy thông tin tác giả, những user có role là 1
                $user = $userModel->getUserByRole(1);
                ?>
                <?php
                foreach ($user as $user) {
                    echo '<option value="' . $user['id'] . '" ' . ($user['id'] == $author_id ? 'selected' : '') . '>' . $user['full_name'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <hr />
    <!-- -------------- -->
    <a href="index.php?page=post_manage" style="margin-left:20px;width: 150px;background: red; border: none;" class="btn btn-primary">Quay lại</a>
    <input type="submit" name="submit" class="btn btn-primary" style="width: 150px;;margin: 0 10px; border: none;">
</form>

<!-- Main End -->