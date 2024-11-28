<main>
    <!-- Slideshow hiện trên PC, Tablet -->
    <div class="slideshow-container">
        <div class="slides">
            <img src="<?=$base_url?>/public/upload/slider/slider1.png" alt="Bông lan trứng muối" class="slide" />
            <img src="<?=$base_url?>/public/upload/slider/slider2.png" alt="Xôi xoài" class="slide" />
            <img src="<?=$base_url?>/public/upload/slider/slider3.png" alt="Chả cá" class="slide" />
        </div>

        <a class="slideshow-prev"><i class="fa-solid fa-chevron-left"></i></a>
        <a class="slideshow-next"><i class="fa-solid fa-chevron-right"></i></a>
    </div>
    <!-- Slideshow hiện trên Mobile -->
    <div class="banner-mobile">
        <h4 class="banner-mobile__label">Sản phẩm nổi bật !!!</h4>
        <h1 class="banner-mobile__name">BÁNH BÔNG LAN TRỨNG MUỐI</h1>
        <p class="banner-mobile__desc">
            Bánh bông lan trứng muối mềm mịn, thơm ngậy với cốt bánh xốp nhẹ, kết hợp hoàn hảo phô mai béo và
            trứng muối mặn.
        </p>
        <button class="buy-now-btn--bigger">
            <a href="" class="buy-now-btn__link">
                <i class="shopping-cart-icon fa-solid fa-cart-shopping"></i>
                MUA NGAY
            </a>
        </button>
        <img src="<?=$base_url?>/public/upload/banner/banner-mobile-img.jpg" alt="" class="banner-mobile__img" />
    </div>

    <!-- Section lợi ích -->
    <section class="benefits-section">
        <div class="benefits-wrap grid wide">
            <div class="row">
                <div class="benefit-item-box col l-3 m-6 c-10 c-offset-1">
                    <div class="benefit-item">
                        <i class="benefit-item__icon fa-solid fa-truck"></i>
                        <div class="benefit-item__content">
                            <h3 class="benefit-item__title">Miễn phí vận chuyển</h3>
                            <span class="benefit-item__desc">Đơn trên 300K</span>
                        </div>
                    </div>
                </div>
                <div class="benefit-item-box col l-3 m-6 c-10 c-offset-1">
                    <div class="benefit-item">
                        <i class="benefit-item__icon fa-solid fa-address-book"></i>
                        <div class="benefit-item__content">
                            <h3 class="benefit-item__title">Nguyên liệu chất lượng</h3>
                            <span class="benefit-item__desc">100% tươi sạch</span>
                        </div>
                    </div>
                </div>
                <div class="benefit-item-box col l-3 m-6 c-10 c-offset-1">
                    <div class="benefit-item">
                        <i class="benefit-item__icon fa-solid fa-money-bill"></i>
                        <div class="benefit-item__content">
                            <h3 class="benefit-item__title">Giá thành phù hợp</h3>
                            <span class="benefit-item__desc">Với học sinh, sinh viên</span>
                        </div>
                    </div>
                </div>
                <div class="benefit-item-box col l-3 m-6 c-10 c-offset-1">
                    <div class="benefit-item">
                        <i class="benefit-item__icon fa-solid fa-recycle"></i>
                        <div class="benefit-item__content">
                            <h3 class="benefit-item__title">Hỗ trợ đổi bánh</h3>
                            <span class="benefit-item__desc">Quy trình nhanh gọn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section sản phẩm nổi bật -->
    <section class="featured-products-section">
        <h2 class="section-title">SẢN PHẨM NỔI BẬT</h2>
        <div class="grid wide">
            <div class="row">
                <?php foreach ($data['featuredProducts'] as $product): ?>
                    <div class="col l-3 m-6 c-10 c-offset-1">
                        <div class="product-item">
                            <a href="<?=$base_url?>/product-details/<?=$product['id']?>" class="product-item__img-link">
                                <div class="product-item__img" style="background-image: url(<?=$base_url?>/public/upload/product/<?= $product['image'] ?>);"></div>
                            </a>
                            <a href="<?=$base_url?>/product-details/<?=$product['id']?>" class="product-item__title-link">
                                <h4 class="product-item__name"><?=$product['name']?></h4>
                            </a>
                            <div class="product-item__rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="star-icon fa-<?= $i <= $product['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <div class="product-item__price">
                                <?php if ($product['sale']): ?>
                                    <span class="product-item__price-old"><?=number_format($product['price'], 0, ',', '.')?>đ</span>
                                    <span class="product-item__price-current"><?=number_format($product['sale'], 0, ',', '.')?>đ</span>
                                <?php else: ?>
                                    <span class="product-item__price-current"><?=number_format($product['price'], 0, ',', '.')?>đ</span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($product['sale']) && $product['sale'] < $product['price']): ?>
                                <?php $percentDiscount = round(($product['price'] - $product['sale']) / $product['price'] * 100); ?>
                                <div class="product-item__sale-off">-<?=$percentDiscount?>%</div>
                            <?php endif; ?>
                            <div class="add-to-cart-box">
                                <button 
                                    class="add-to-cart-btn" 
                                    onclick="addToCart(this, <?=$product['id']?>, '<?=$product['name']?>', <?= $product['sale'] ? $product['sale'] : $product['price'] ?>, '<?=$product['image']?>')"
                                >
                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Section danh mục nổi bật -->
    <section class="featured-categories-section">
        <div class="featured-categories-wrap grid wide">
            <div class="row">
                <div class="category-item-box col l-4 m-12 c-10 c-offset-1">
                    <div
                        class="category-item"
                        style="background-image: url(<?=$base_url?>/public/upload/background-icon/banhbonglan.png)"
                    >
                        <h3 class="category-item__name">Bánh bông lan</h3>
                        <p class="category-item__desc">Bánh bông lan mềm mịn, xốp nhẹ, ngọt ngào, thơm ngon.</p>
                        <button class="buy-now-btn">
                            <a class="buy-now-btn__link" href="<?=$base_url?>/collection/1"
                                >MUA NGAY <i class="arrow-icon fa-solid fa-arrow-right-long"></i
                            ></a>
                        </button>
                    </div>
                </div>
                <div class="category-item-box col l-4 m-12 c-10 c-offset-1">
                    <div
                        class="category-item"
                        style="background-image: url(<?=$base_url?>/public/upload/background-icon/banhbo.png)"
                    >
                        <h3 class="category-item__name">Bánh bò</h3>
                        <p class="category-item__desc">Bánh bò mềm mịn, xốp nhẹ, hương lá dứa thơm lừng.</p>
                        <button class="buy-now-btn">
                            <a class="buy-now-btn__link" href="<?=$base_url?>/collection/2"
                                >MUA NGAY <i class="arrow-icon fa-solid fa-arrow-right-long"></i
                            ></a>
                        </button>
                    </div>
                </div>
                <div class="category-item-box col l-4 m-12 c-10 c-offset-1">
                    <div
                        class="category-item"
                        style="background-image: url(<?=$base_url?>/public/upload/background-icon/banhdalon.png)"
                    >
                        <h3 class="category-item__name">Bánh da lợn</h3>
                        <p class="category-item__desc">Bánh da lợn mềm mịn, thơm béo hương truyền thống.</p>
                        <button class="buy-now-btn">
                            <a class="buy-now-btn__link" href="<?=$base_url?>/collection/4"
                                >MUA NGAY <i class="arrow-icon fa-solid fa-arrow-right-long"></i
                            ></a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section banner khuyến mãi -->
    <section class="promotion-section">
        <div class="promotion-section-box grid wide">
            <h1 class="promotion-section__title">Được giảm giá 10% cho lần mua hàng đầu tiên</h1>
            <button class="buy-now-btn--bigger">
                <a class="buy-now-btn__link" href="<?=$base_url?>/collection">
                    <i class="shopping-cart-icon fa-solid fa-cart-shopping"></i>
                    MUA NGAY
                </a>
            </button>
        </div>
    </section>
    <section class="sub-promotion-section">
        <h2 class="sub-promotion-section__title">Thao tác đơn giản. Không cần đăng ký</h2>
    </section>

    <!-- Section sản phẩm khuyến mãi cho PC, Tablet -->
    <section class="promotional-products-section">
        <h2 class="section-title">SẢN PHẨM KHUYẾN MÃI</h2>
        <div class="slider-wrapper">
            <button class="slider-prev"><i class="fa-solid fa-circle-chevron-left"></i></button>
            <button class="slider-prev--tablet"><i class="fa-solid fa-circle-chevron-left"></i></button>
            <div class="slider-box grid wide">
                <div class="slider slider--tablet">
                    <?php foreach($data['discountProducts'] as $product): ?>
                        <div class="product-slide">
                            <div class="product-item">
                                <a href="<?=$base_url?>/product-details/<?=$product['id']?>" class="product-item__img-link">
                                    <div class="product-item__img" style="background-image: url(<?=$base_url?>/public/upload/product/<?=$product['image']?>);"></div>
                                </a>
                                <a href="<?=$base_url?>/product-details/<?=$product['id']?>" class="product-item__title-link">
                                    <h4 class="product-item__name"><?=$product['name']?></h4>
                                </a>
                                <div class="product-item__rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="star-icon fa-<?= $i <= $product['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                <div class="product-item__price">
                                    <?php if ($product['sale']): ?>
                                        <span class="product-item__price-old"><?=number_format($product['price'], 0, ',', '.')?>đ</span>
                                        <span class="product-item__price-current"><?=number_format($product['sale'], 0, ',', '.')?>đ</span>
                                    <?php else: ?>
                                        <span class="product-item__price-current"><?=number_format($product['price'], 0, ',', '.')?>đ</span>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($product['sale']) && $product['sale'] < $product['price']): ?>
                                    <?php $percentDiscount = round(($product['price'] - $product['sale']) / $product['price'] * 100); ?>
                                    <div class="product-item__sale-off">-<?=$percentDiscount?>%</div>
                                <?php endif; ?>
                                <div class="add-to-cart-box">
                                    <button 
                                        class="add-to-cart-btn" 
                                        onclick="addToCart(this, <?=$product['id']?>, '<?=$product['name']?>', <?= $product['sale'] ? $product['sale'] : $product['price'] ?>, '<?=$product['image']?>')"
                                    >
                                        THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button class="slider-next"><i class="fa-solid fa-circle-chevron-right"></i></button>
            <button class="slider-next--tablet"><i class="fa-solid fa-circle-chevron-right"></i></button>
        </div>
    </section>
    <!-- Section sản phẩm khuyến mãi cho Mobile -->
    <section class="promotional-products-section--mobile">
        <h2 class="section-title">SẢN PHẨM KHUYẾN MÃI</h2>
        <div class="grid wide">
            <div class="row">
                <?php 
                    $discountProductMobile = array_slice($data['discountProducts'], 0, 4);
                    foreach($discountProductMobile as $product): 
                ?>
                    <div class="col l-3 m-6 c-10 c-offset-1">
                        <div class="product-item">
                            <a href="<?=$base_url?>/product-details/<?=$product['id']?>" class="product-item__img-link">
                                <div class="product-item__img" style="background-image: url(<?=$base_url?>/public/upload/product/<?=$product['image']?>);"></div>
                            </a>
                            <a href="<?=$base_url?>/product-details/<?=$product['id']?>" class="product-item__title-link">
                                <h4 class="product-item__name"><?=$product['name']?></h4>
                            </a>
                            <div class="product-item__rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="star-icon fa-<?= $i <= $product['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <div class="product-item__price">
                                <?php if ($product['sale']): ?>
                                    <span class="product-item__price-old"><?=number_format($product['price'], 0, ',', '.')?>đ</span>
                                    <span class="product-item__price-current"><?=number_format($product['sale'], 0, ',', '.')?>đ</span>
                                <?php else: ?>
                                    <span class="product-item__price-current"><?=number_format($product['price'], 0, ',', '.')?>đ</span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($product['sale']) && $product['sale'] < $product['price']): ?>
                                <?php $percentDiscount = round(($product['price'] - $product['sale']) / $product['price'] * 100); ?>
                                <div class="product-item__sale-off">-<?=$percentDiscount?>%</div>
                            <?php endif; ?>
                            <div class="add-to-cart-box">
                                <button 
                                    class="add-to-cart-btn" 
                                    onclick="addToCart(this, <?=$product['id']?>)"
                                >
                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Section đánh giá của khách hàng -->
    <?php if (!empty($data['featuredReviews']) && count($data['featuredReviews']) >= 2): ?>
        <section class="review-section">
            <h2 class="section-title">ĐÁNH GIÁ CỦA KHÁCH HÀNG</h2>
            <div class="grid wide">
                <div class="review-box row">
                    <div class="review-item-box col l-4 m-12 c-10 c-offset-1">
                        <div class="review-item">
                            <div class="review-item__rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="star-icon-large fa-<?= $i <= $data['featuredReviews'][0]['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="review-item__content"><?=$data['featuredReviews'][0]['comment']?></p>
                            <div class="review-item__user">
                                <img
                                    src="<?=$base_url?>/public/upload/avatar/<?=$data['featuredReviews'][0]['avatar']?>"
                                    alt=""
                                    class="review-item__user-avatar"
                                />
                                <span class="review-item__user-name"><?=$data['featuredReviews'][0]['full_name']?></span>
                            </div>
                        </div>
                    </div>
                    <div class="review-item-box col l-4 m-12 c-10 c-offset-1">
                        <div class="promotion-item" style="background-image: url(<?=$base_url?>/public/upload/banner/small-banner.jpg)">
                            <h2 class="promotion-item__title">
                                Ưu Đãi Trong Ngày Giảm Giá 15% Cho Tất Cả Các Loại Bánh
                            </h2>
                            <button class="buy-now-btn">
                                <a href="<?=$base_url?>/collection">MUA NGAY</a> 
                                <i class="arrow-icon fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                    </div>
                    <div class="review-item-box col l-4 m-12 c-10 c-offset-1">
                        <div class="review-item">
                            <div class="review-item__rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="star-icon-large fa-<?= $i <= $data['featuredReviews'][1]['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="review-item__content"><?=$data['featuredReviews'][1]['comment']?></p>
                            <div class="review-item__user">
                                <img
                                    src="<?=$base_url?>/public/upload/avatar/<?=$data['featuredReviews'][1]['avatar']?>"
                                    alt=""
                                    class="review-item__user-avatar"
                                />
                                <span class="review-item__user-name"><?=$data['featuredReviews'][1]['full_name']?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>