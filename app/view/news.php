<!-- Start Main -->
<main>
    <h2 class="section-title">TIN TỨC</h2>
    <section class="news-list">
        <div class="grid wide">
            <div class="row">
                <?php
                foreach ($data['news'] as $item) {
                    extract($item);
                    if ($status == 0) {
                        echo '';
                    } else {
                        $doc = new DOMDocument();
                        libxml_use_internal_errors(true); // Để tránh lỗi khi đọc HTML không hợp lệ
                        $doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
                        
                        // Tìm thẻ <p> đầu tiên
                        $pTags = $doc->getElementsByTagName('p');
                        if ($pTags->length > 0) {
                            // Lấy nội dung thẻ <p> đầu tiên
                            $shortContent = $pTags->item(0)->nodeValue;
                        }
                        echo '<div class="col l-4 m-6 c-10 c-offset-1">
                        <div class="news-item">
                        <a href="'.$base_url.'/news-details/'.$id.'" class="news-item__img-link">
                            <img
                                src="'.$base_url.'/public/upload/post/images/'.$image.'"
                                alt="Ảnh sản phẩm"
                                class="news-item__img"
                            />
                            <div class="overlay"></div>
                        </a>
                        <a href="'.$base_url.'/news-details/'.$id.'" class="news-item__title-link">
                            <div class="single-line-text">
                                '.$title.'
                            </div>
                        </a>
                        <div class="news-item__description">
                            '.$shortContent.'
                        </div>
                        <a href="'.$base_url.'news-details/'.$id.'" class="news-item__readmore-link">
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