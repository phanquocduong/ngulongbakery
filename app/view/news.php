<!-- Start Main -->
<main>
    <div class="title-news">Tin tức</div>
    <section class="news-list">
        <div class="grid wide">
            <div class="row">
                <?php
                foreach ($data['news'] as $item) {
                    extract($item);
                    if($status == 0){
                        echo '';
                    }else{
                        echo '<div class="col l-4 m-6 c-10 c-offset-1">
                        <div class="news-item">
                        <a href="index.php?page=news-details&id='.$id.'" class="news-item__img-link">
                            <img
                                src="./public/upload/post/images/'.$image.'"
                                alt="Ảnh sản phẩm"
                                class="news-item__img"
                            />
                            <div class="overlay"></div>
                        </a>
                        <a href="index.php?page=news-details&id='.$id.'" class="news-item__title-link">
                            <div class="news-item__name">
                                '.$title.'
                            </div>
                        </a>
                        <div class="news-item__description">
                            '.$title.'
                        </div>
                        <a href="index.php?page=news-details&id='.$id.'" class="news-item__readmore-link">
                            <div class="news-item__readmore">
                                ĐỌC THÊM <i class="fa-solid fa-angles-right"></i>
                            </div>
                        </a>
                        <div class="news-item__line"></div>
                        <div class="news-item__comment">
                            <div class="news-item__comment-date">'.$created_at.'</div>
                            <i class="fa-solid fa-circle"></i>
                            <div class="news-item__comment-content">';?>
                        <?php
                        if($total_comments == 0){
                            echo 'Không có bình luận';
                        }else{
                            echo $total_comments.' bình luận';
                        }
                        ?>
                    <?php
                        echo'</div>
                        </div>
                    </div>
                </div>';
                    }
                    
                }
                ?> 
            </div>
        </div>
    </section>
    <div class="pageorder">
        <button class="loading-btn" onclick="showLoading(this)">
            <span class="button-text">Xem thêm</span>
            <span class="spinner"></span>
        </button>
    </div>
</main>
<!-- End Maim -->