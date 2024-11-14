<!-- Main Start -->
<form action="" class="form form-group">
    <div class="container">
        <h1>Thêm bài viết</h1>

        <div class="date-create form-control"></div>
        <!-- Ngày tạo bài viết -->
    </div>
    <!-- -------------- -->

    <!-- Đoạn để nhập văn bản, sẽ truy xuất đoạn này để thêm vào database -->
    <div id="editor" class="editor" contenteditable="true"></div>
    <br />
    <!-- -------------- -->

    <!-- input để thêm bài viêt -->
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
    <!-- ----------------------- -->

    <!-- trạng thái ẩn/hiện bài viết -->
    <div class="container">
        <div class="form-group" style="margin-left: 10px">
            <label class="form-check-label" for="flexCheckDefault">
                Trạng thái
            </label>
            <select name="" id="" class="form-select">
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
            <select name="" id="" class="form-select">
                <option value="0">Tin tức</option>
                <option value="1">Sự kiện</option>
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
            <select name="" id="" class="form-select">
                <option value="0">PhanGB</option>
                <option value="1">Admin</option>
                <option value="2">Người dùng</option>
            </select>
        </div>
    </div>
    <hr />
    <!-- -------------- -->

    <div class="container">
        <button type="submit" class="btn btn-primary m-2">
            Thêm bài viết
        </button>
    </div>
</form>
<a href="post_manage.html" class="btn btn-primary" style="margin-left: 20px">Quay lại</a>
<!-- Main End -->