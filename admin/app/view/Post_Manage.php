<!-- Main Start -->
<div class="container-fluid py-4 px-4">
          <div class="row">
            <div class="col-12">
              <div class="card border-0 shadow">
                <div class="card-header bg-light border-0 py-3">
                  <h4 class="mb-3">Quản Lý Bài Viết</h4>
                  <a href="index.php?page=add_post" class="btn btn-primary"
                    >Thêm Bài Viết</a
                  >
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table
                      class="table table-centered table-nowrap mb-0 rounded"
                    >
                      <thead class="thead-light">
                        <tr>
                          <th class="border-0">ID</th>
                          <th class="border-0">Tiêu Đề</th>
                          <th class="border-0">Danh Mục</th>
                          <th class="border-0">Ngày Và Thời Gian Đăng</th>
                          <th class="border-0">Trạng Thái</th>
                          <th class="border-0">Tác Giả</th>
                          <th class="border-0">Tác Vụ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $stt=1; 
                          foreach ($data['post'] as $item) {
                          extract($item);
                          $timestamp = strtotime($created_at);
                          // Tạo đối tượng DateTime từ chuỗi thời gian
                          $date = new DateTime($created_at, new DateTimeZone("UTC"));

                          // Chuyển đổi sang múi giờ UTC+7
                          $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));

                          // Định dạng lại thời gian
                          $vn_format = $date->format("d/m/Y H:i:s");
                          echo '<tr>
                                  <td>'.$stt++.'</td>

                                  <td style="width:350px">'.$title.'</td>
                                  <td>'.$category_name.'</td>
                                  <td>'.$vn_format.'</td>
                                  <td>';
                                  if($status==1){
                                    echo'<span class="badge bg-success">Đã đăng</span>';
                                  }else{
                                    echo '<span class="badge bg-danger">Chưa đăng</span>';
                                  }
                                    
                                  echo'</td>
                                  <td>'.$author_name.'</td>
                                  <td>
                                    <a href="index.php?page=post_detail&id='.$id.'" class="btn btn-sm btn-primary" >Xem</a>
                                    <a href="index.php?page=edit_post&id=' . $id . '" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="index.php?page=del_post&id=' . $id . '" class="btn btn-sm btn-danger">Xóa</a>
                                  </td>
                                </tr>';
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Main End -->