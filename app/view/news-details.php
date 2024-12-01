<!-- Start Main -->
 <?php
    extract($data['news-details']);
?>
<main>
            <section class="detailnews">
                <div class="grid wide">
                    <div class="row">
                        <div class="col l-12 m-12 c-12">
                            <div class="contentnews">
                                <div class="contentnews-title">
                                    <?php echo $title; ?>
                                </div>
                                <div class="contentnews-author">
                                    <a href="#quantitycmt" class="contentnews-author__linkcmt"> Bình luận / </a>
                                    <a href="" class="contentnews-author__linkcate"> <?php echo $category_name?> / </a>
                                    <a href="" class="contentnews-author__linkname"><?php echo $author_name?></a>
                                </div>
                                <!-- Mục lục -->
                                <div class="contentnews-listindex">
                                    <button id="toggle-button"><i class="fa-solid fa-bars"></i></button>
                                    <p>Mục lục</p>
                                </div>
                                <!-- End Mục lục -->
                                <?php 
                                    $updated_content = preg_replace('/<a href="([^"]+)"/', '<a href="' . $base_url . '/$1"', $content);
                                    echo $updated_content; 
                                ?>
                                
                                <!-- demo -->
                                
                                <!-- end -->
                            </div>
                            <div class="backtonews">
                            <?php
                                $postId = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                $totalPosts = $data['totalPosts'];

                                if ($postId == 1) {
                                    echo '<a style="float: right;" href="">Đây là bài viết đầu tiên!!!</a>';
                                    echo '<a style="float: right;" href="'.$base_url.'/news-details/' . ($postId + 1) . '">Bài viết tiếp theo<i class="new-right-icon fa-solid fa-arrow-right"></i></a>';
                                } elseif ($postId > 1 && $postId < $totalPosts) {
                                    echo '<a href="'.$base_url.'/news-details/' . ($postId - 1) . '"><i class="new-left-icon fa-solid fa-arrow-left"></i> Bài viết trước</a>';
                                    echo '<a href="'.$base_url.'/news-details/' . ($postId + 1) . '">Bài viết tiếp theo<i class="new-right-icon fa-solid fa-arrow-right"></i></a>';
                                } elseif ($postId == $totalPosts) {
                                    echo '<a href="'.$base_url.'/news-details/' . ($postId - 1) . '"><i class="new-left-icon fa-solid fa-arrow-left"></i> Bài viết trước</a>';
                                    echo '<a style="float: right;" href="">Đây là bài viết cuối cùng!!!</a>';
                                } else {
                                    echo 'Không tìm thấy bài viết';
                                }
                            ?>
                                
                            </div>
                            <div id="quantitycmt" class="commentnews">
                                <div class="quantitycomment">
                                    Các bình luận trong “<?php echo $title ?>”
                                </div>
                                <?php
                                    require_once './app/model/CommentsModel.php';
                                    $getComments = new CommentsModel();
                                    $postId = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                    $comments = $getComments->getCommentsByPostId($postId);

                                    if (empty($comments)) {
                                        echo '<p>Chưa có bình luận nào.</p>';
                                    } else {
                                        foreach ($comments as $comment) {
                                            extract($comment);
                                            if ($status == 0) {
                                                continue;
                                            }
                                            echo '
                                            <div class="comment-container">
                                                <div class="commentnews-user">
                                                    <img src="'.$base_url.'/public/upload/avatar/' . $avatar . '" alt="avatar" class="commentnews-user__avt-img" />
                                                    <div class="commentnews-user__name-date">
                                                        <div class="commentnews-user__name">' . $fullname . '</div>
                                                        <div class="commentnews-user__dates">' . $created_at . '</div>
                                                    </div>
                                                </div>
                                                <div class="commentnews-content">' . $comment . '</div>
                                            </div>';
                                        }
                                    }
                                ?>
                                <button id="show-more-comments" class="btn-show-more">Xem thêm bình luận</button>
                                <div class="commentnews-manage"></div>
                            </div>
                            </div>
                            <div class="writecomment">
                                <?php if (!isset($_SESSION['user']['role_id'])): ?>
                                    <div class="writecomment-title">Bạn chưa đăng nhập. Hãy đăng nhập để bình luận.</div>
                                    <div class="writecomment-title__link">
                                        <a href="<?=$base_url?>/login">Đăng nhập?</a>
                                    </div>
                                <?php else: ?>
                                    <form action="<?=$base_url?>/addCmt" method="POST">
                                        <?php
                                        // Lấy post_id từ URL
                                        $post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                        if ($post_id === 0) {
                                            echo "<p>Không tìm thấy bài viết!</p>";
                                            exit();
                                        }
                                        ?>
                                        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                                        <div class="writecomment-title">Để lại một bình luận</div>
                                        <div class="writecomment-title__link">
                                            Đăng nhập với tên <?= htmlspecialchars($_SESSION['user']['full_name']); ?>
                                            <a href="<?=$base_url?>/account">Chỉnh sửa hồ sơ của bạn</a>
                                            <a href="<?=$base_url?>/logout">Đăng xuất?</a>
                                            Các trường bắt buộc được đánh dấu *
                                        </div>
                                        <div class="writecomment-content">
                                            <input type="text" class="comment-input" name="comment" placeholder="Nhập bình luận..." required />
                                        </div>
                                        <div class="writecomment-btn">
                                            <button type="submit" name="submit">Bình luận bài viết</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- End Main -->