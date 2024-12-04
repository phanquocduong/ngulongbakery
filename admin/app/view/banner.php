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
                    }

                    .table th,
                    .table td {
                        text-align: center;
                        vertical-align: middle;
                    }

                    .table img {
                        display: block;
                        margin: auto;
                    }
                    .badge{
                        text-align: center;
                        vertical-align: middle;
                        margin-top: 50px;
                        margin-left: 110px;
                        margin-right: -70px;
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
                    foreach($listbanner as $key => $value) {
                        extract($value);
                        echo '
                        <tr>
                            <td>' . $stt++ . '</td>
                            <td style="width:250px"><img src="../public/upload/banner/' . $image . '"
                                alt="Banner Image" style="width: 200px;"></td>
                            <td>' . $tag . '</td>
                            <td class="badge bg-success">' . $status . '</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="index.php?page=editbanner&id='.$id.'">Sửa</a>
                                <a class="btn btn-sm btn-danger" href="index.php?page=delete_banner&id='.$id.'">Xoá</a>
                            </td>
                        </tr>
';

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>