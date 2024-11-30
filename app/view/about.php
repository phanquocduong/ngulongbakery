<main>
    <div class="about-top">
        <div class="main-about-top grid wide">
            <div class="main-about-top-box row">
                <div class="col l-6 m-12 c-12">
                    <div class="about-top__left">
                        <h2 class="about-top__title">Chúng tôi là tiệm bánh yêu thích của bạn!</h2>
                        <p class="about-top__content">
                            Ngũ Long Bakery cung cấp đa dạng loại bánh tươi ngon, từ bánh bông lan thơm ngon, bánh bò mềm mịn đến bánh trung
                            thu truyền thống. Với dịch vụ giao hàng nhanh chóng và chất lượng đảm bảo, bạn có thể dễ dàng chọn lựa và đặt hàng
                            trực tuyến từ sự tiện lợi của ngôi nhà mình.
                        </p>
                        <p class="about-top__content">
                            Chúng tôi sử dụng nguyên liệu tươi sạch và công thức truyền thống để đảm bảo hương vị tuyệt vời nhất, cam kết mang
                            đến sự hài lòng cho từng khách hàng. Hãy trải nghiệm dịch vụ của Ngũ Long Bakery ngay hôm nay!
                        </p>
                    </div>
                </div>
                <div class="col l-6 m-12 c-12">
                    <img src="<?=$base_url?>/public/upload/banner/banner-about.jpg" alt="Bánh bông lan" class="about-top__img" />
                </div>
            </div>
        </div>
    </div>
    <div class="featured-data-section">
        <div class="grid wide">
            <div class="row featured-data-box">
                <div class="featured-data-section__title-box col l-3 m-12 c-12">
                    <span class="featured-data-section__title">Những con số biết nói!</span>
                </div>
                <div class="featured-data-item col l-3 m-4 c-12">
                    <span class="featured-data-item__number">100+</span>
                    <span class="featured-data-item__title">Khách hàng</span>
                </div>
                <div class="featured-data-item col l-3 m-4 c-12">
                    <span class="featured-data-item__number">30+</span>
                    <span class="featured-data-item__title">Bánh được tuyển chọn</span>
                </div>
                <div class="featured-data-item col l-3 m-4 c-12">
                    <span class="featured-data-item__number">10+</span>
                    <span class="featured-data-item__title">Danh mục bánh</span>
                </div>
            </div>
        </div>
    </div>
    <div class="about-bottom">
        <div class="grid wide">
            <div class="row">
                <div class="col l-6 m-12 c-12">
                    <div class="review-card">
                        <div class="image-container">
                            <div class="image-slider">
                                <img src="<?=$base_url?>/public/upload/product/product-1.jpg" alt="Cake" class="product-image" />
                                <img src="<?=$base_url?>/public/upload/product/product-2.jpg" alt="Cake" class="product-image" />
                                <img src="<?=$base_url?>/public/upload/product/product-4.jpg" alt="Cake" class="product-image" />
                                <img src="<?=$base_url?>/public/upload/product/product-5.jpg" alt="Cake" class="product-image" />
                            </div>
                        </div>
                        <div class="review-content">
                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="star-icon-large fa-<?= $i <= $data['featuredReview'][0]['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="review-text"><?=$data['featuredReview'][0]['comment']?></p>
                            <div class="reviewer">
                                <img src="<?=$base_url?>/public/upload/avatar/<?=$data['featuredReview'][0]['avatar']?>" alt="Reviewer" class="reviewer-avatar" />
                                <span class="reviewer-name"><?=$data['featuredReview'][0]['full_name']?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-bottom-right col l-6 m-12 c-12">
                    <div class="verify">
                        <img src="<?=$base_url?>/public/upload/logo/logo.png" alt="Logo Ngũ Long Bakery" class="verify-logo-icon" />
                        <div class="verify-content">
                            <h3 class="verify-content__title">Đã được kiểm chứng</h3>
                            <p class="verify-content__body">Chứng nhận sản phẩm đạt tiêu chuẩn, nguyên liệu tươi sạch 100%</p>
                        </div>
                    </div>
                    <h2 class="introduction-heading">Chúng tôi kinh doanh các sản phẩm bánh với những hương vị khác nhau!</h2>
                    <div class="about-categories row">
                        <div class="col l-6 m-6 c-12">
                            <ul class="about-category-list">
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh bông lan</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh bò</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh trung thu</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh da lợn</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh mì</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh tráng</li>
                            </ul>
                        </div>
                        <div class="col l-6 m-6 c-12">
                            <ul class="about-category-list">
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Rau câu</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh su kem</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Xôi xoài</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh ít</li>
                                <li class="about-category-item"><i class="about-check-icon fa-regular fa-circle-check"></i>Bánh crepe</li>
                            </ul>
                        </div>
                    </div>
                    <button class="buy-now-btn--bigger">
                        <a class="buy-now-btn__link" href="<?=$base_url?>/collection">
                            <i class="shopping-cart-icon fa-solid fa-cart-shopping"></i>
                            BẮT ĐẦU MUA SẮM
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>