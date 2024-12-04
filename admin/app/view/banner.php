<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Banner List</h6>
            <a href="index.php?page=addbanner" class="btn btn-primary">Thêm Banner</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <style>
                    .table {
                        width: 100%;
                        margin: auto;
                        border-collapse: collapse;
                    }

                    .table th,
                    .table td {
                        text-align: center;
                        vertical-align: middle;
                        padding: 10px;
                        border: 1px solid #ddd;
                    }

                    .table th {
                        background-color: #f8f9fa;
                        font-weight: bold;
                    }

                    .table img {
                        display: block;
                        margin: auto;
                        max-width: 100%;
                        height: auto;
                    }

                    /* .badge {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 5px 10px;
                        border-radius: 12px;
                        font-size: 14px;
                        margin: auto;
                    } */
                    .status {
                        height: 30px;
                        margin: auto;
                    }

                    .btn {
                        padding: 5px 10px;
                        font-size: 14px;
                    }
                </style>
                <?php
                require_once './app/model/BannerModel.php';
                $bannermodel = new BannerModel();
                $listbanner = $bannermodel->get_banner();
                ?>

                <thead>
                    <tr class="text-dark">
                        <th scope="col">STT</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Tag</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach ($listbanner as $key => $value) {
                        extract($value);
                        ?>
                        <tr>
                            <td><?= $stt++ ?></td>
                            <td style="width:250px"><img src="../public/upload/slider/<?= $image ?>" alt="Banner Image"
                                    style="width: 200px;"></td>
                            <td><?= $tag ?></td>
                            <td class="status  "><?= $status == 1 ? 'Hiện' : 'Ẩn' ?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="index.php?page=editbanner&id=<?= $id ?>">Sửa</a>
                                <a class="btn btn-sm btn-danger" href="javascript:void(0);"
                                    onclick="confirmDelete(<?= $id ?>)">Xoá</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
        if (confirm('Bạn có chắc chắn muốn xóa banner này không?')) {
            window.location.href = 'index.php?page=delete_banner&id=' + id;
        }
    }
</script>