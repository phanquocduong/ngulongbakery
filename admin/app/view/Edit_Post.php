<!-- Main Start -->
<form action="" class="form form-group">
    <div class="container">
        <!-- <h1 style="margin: 10px 0 0 0"> -->
            <!-- Khám Phá Các Loại Bánh Bông Lan Đặc Biệt Tại Ngũ Long Bakery -->
             <?php
             $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
             require_once './app/model/PostModel.php';
             $postModel = new PostModel();
             $post = $postModel->getIdPost($id);
             extract($post);
             echo '<h1 style="margin: 10px 0 0 0">'.$title.'</h1>';
             ?>
        <!-- </h1> -->
        <hr />
        <!-- Đoạn để nhập văn bản, sẽ truy xuất đoạn này để thêm vào database -->
        <a href="index.php?page=post_manage" class="btn btn-primary">Quay lại</a>
        <a href="" class="btn btn-primary">Lưu thay đổi</a>
        <hr />
        <hr>
        <!-- Ngày tạo bài viết -->
        <div class="date-create form-control">
        </div>
    </div>
    <!-- -------------- -->
    <div id="editor" class="editor" contenteditable="true">
        <?php
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        require_once './app/model/PostModel.php';
        $postModel = new PostModel();
        $post = $postModel->getIdPost($id);

        if ($post) {
            extract($post);
            echo '<div class="contentnews">';
            echo '<h1>' . htmlspecialchars($title) . '</h1>';
            echo '<p>' . $content . '</p>'; 
            echo '</div>';
        } else {
            echo '<p>Không tìm thấy bài viết.</p>';
        }
        ?>
    </div>
     <div class="add-element">
            <select id="element-type" class="form-select m-2">
                <option value="h1">Tiêu đề H1</option>
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

    <br />
    <!-- trạng thái ẩn/hiện bài viết -->
    <div class="container">
        <div class="form-group" style="margin-left: 10px">
            <label class="form-check-label" for="flexCheckDefault">
                Trạng thái
            </label>
            <select name="" id="" class="form-select">
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
            <select name="" id="" class="form-select">

                <?php
        require_once './app/model/CategoryModel.php';
        $categoryModel = new CategoryModel();
        
        // Lấy danh sách thể loại bài viết
        $categories = $categoryModel->getCate();
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
             <select name="" id="" class="form-select">
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

    <div class="container"></div>
</form>

<!-- Main End -->