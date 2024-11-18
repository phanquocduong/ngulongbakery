<!-- Start main -->
        <main>
            <div class="details-box grid wide">
                <div class="row">
                    <div class="col l-10 l-o-1 m-10 m-o-1 c-10 c-o-1">
                        <div class="details-header">
                            <div class="row">
                                <div class="details-header__left col l-6 m-12 c-12">
                                    <div
                                        onclick="openImageModal(this)"
                                        class="main-image"
                                        style="background-image: url('public/upload/product/<?=$data['product']['image']?>')"
                                    ></div>
                                    <?php if($data['product']['image']): ?>
                                        <div class="sale-off">-18%</div>
                                    <?php endif; ?>

                                    <div class="extra-images">
                                        <img
                                            onclick="changeDisplayImage(this)"
                                            src="public/upload/product/<?=$data['product']['image']?>"
                                            alt=""
                                            class="extra-image"
                                        />
                                        <?php
                                            $extra_images = explode(",", $data['product']['extra_image']); 
                                            foreach($extra_images as $extra_image):
                                        ?>
                                            <img
                                                onclick="changeDisplayImage(this)"
                                                src="public/upload/product/<?=$extra_image?>"
                                                alt=""
                                                class="extra-image extra-image--bright"
                                            />
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="details-header__right col l-6 m-12 c-12">
                                    <h2 class="product-name"><?=$data['product']['name']?></h2>
                                    <div class="product-price-box">
                                        <?php if($data['product']['sale']): ?>
                                            <span class="product-price-old"><?=number_format($data['product']['price'])?>đ</span>
                                            <span class="product-price-current"><?=number_format($data['product']['sale'])?>đ</span>
                                        <?php else: ?>
                                            <span class="product-price-current"><?=number_format($data['product']['price'])?>đ</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="product-short-desc"><?=$data['product']['short_description']?></p>
                                    <div class="add-to-cart-action">
                                        <div class="quantity-selection">
                                            <span class="quantity-selection__title">Số lượng:</span>
                                            <div class="quantity-selection__action">
                                                <input
                                                    onclick="updateQuantity(-1)"
                                                    type="button"
                                                    class="quantity-selection__action-minus"
                                                    value="-"
                                                />
                                                <input type="text" class="quantity-selection__action-edit" value="1" />
                                                <input
                                                    onclick="updateQuantity(1)"
                                                    type="button"
                                                    class="quantity-selection__action-add"
                                                    value="+"
                                                />
                                            </div>
                                        </div>
                                        <button class="add-to-cart-btn" onclick="addToCart(this, <?= $data['product']['id'] ?>, '<?= $data['product']['name'] ?>', <?= $data['product']['sale'] ? $data['product']['sale'] : $data['product']['price'] ?>, '<?= $data['product']['image'] ?>', 1)">
                                            THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                        </button>
                                    </div>
                                    <div class="related-info">
                                        <span class="product-code">Mã SP: <?=$data['product']['id']?></span>
                                        <span class="product-cate"
                                            >Danh mục: <a class="product-cate__link" href=""><?=$data['product']['category_name']?></a></span
                                        >
                                        <?php if (isset($_SESSION['user'])): ?>
                                            <div class="favorite-action">
                                                <i onclick="toggleFavorite(<?= $data['product']['id'] ?>, <?= $_SESSION['user']['id'] ?>)" 
                                                    class="heart-icon fa-solid fa-heart <?= (isset($data['favorite'])) ? 'heart-icon--fill' : '' ?>" 
                                                    data-product-id="<?= $data['product']['id'] ?>">
                                                </i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="details-body">
                            <ul class="tab-list">
                                <li onclick="activeTab(this, 'detailed-desc')" class="tab-item tab-item--active">
                                    Mô tả
                                </li>
                                <li onclick="activeTab(this, 'reviews')" class="tab-item">Đánh giá (<?= count($data['productReviews']) ?>)</li>
                            </ul>
                            <div id="detailed-desc" class="tab-content tab-content--active"><?= $data['product']['detailed_description'] ?></div>
                            <div id="reviews" class="tab-content">
                                <?php if (empty($data['productReviews'])): ?>
                                    <p>Chưa có đánh giá cho sản phẩm này.</p>
                                <?php else: ?>
                                    <?php foreach($data['productReviews'] as $item): ?>
                                        <div class="review-item">
                                            <img
                                                class="review-item__avatar"
                                                src="public/upload/avatar/<?=$item['avatar']?>"
                                                alt="<?=$item['full_name']?>"
                                            />
                                            <div class="review-item__body">
                                                <span class="review-item__name"><?=$item['full_name']?></span>
                                                <div class="review-item__rating">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="star-icon fa-<?= $i <= $item['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="review-item__date"><?=$item['created_at']?></span>
                                                <p class="review-item__comment"><?=$item['comment']?></p>
                                                <div class="review-item__images">
                                                    <?php 
                                                        $feedback_images = explode(",", $item['images']); 
                                                        foreach($feedback_images as $feedback_image):
                                                    ?>
                                                        <img
                                                            onclick="openImageModal(this)"
                                                            class="review-item__image"
                                                            src="public/upload/review/<?=$feedback_image?>"
                                                            alt=""
                                                        />
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <!-- <div class="pagination">
                                    <a href="" class="pagination-link__icon-prev">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </a>
                                    <a href="" class="pagination-link pagination-link--active">1</a>
                                    <a href="" class="pagination-link">2</a>
                                    <a href="" class="pagination-link">3</a>
                                    <a href="" class="pagination-link">...</a>
                                    <a href="" class="pagination-link">11</a>
                                    <a href="" class="pagination-link__icon-next">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="related-products">
                            <h2 class="section-title">SẢN PHẨM LIÊN QUAN</h2>
                            <div class="row">
                                <?php foreach($data['relatedProducts'] as $product): ?>
                                    <div class="col l-3 m-6 c-12">
                                    <div class="product-item">
                                            <a href="index.php?page=product-details&id=<?=$product['id']?>" class="product-item__img-link">
                                                <div
                                                    style="
                                                        background-image: url(public/upload/product/<?=$product['image']?>);
                                                    "
                                                    class="product-item__img"
                                                ></div>
                                            </a>
                                            <a href="index.php?page=product-details&id=<?=$product['id']?>" class="product-item__title-link">
                                                <h4 class="product-item__name"><?=$product['name']?></h4>
                                            </a>
                                            <div class="product-item__rating">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="star-icon fa-<?= $i <= $product['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="product-item__price">
                                                <?php if ($product['sale']): ?>
                                                    <span class="product-item__price-old"><?= number_format($product['price']) ?>đ</span>
                                                    <span class="product-item__price-current"><?= number_format($product['sale']) ?>đ</span>
                                                <?php else: ?>
                                                    <span class="product-item__price-current"><?= number_format($product['price']) ?>đ</span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($product['sale']): ?>
                                                <?php $percentDiscount = round(($product['price'] - $product['sale']) / $product['price'] * 100); ?>
                                                <div class="product-item__sale-off">-<?= $percentDiscount ?>%</div>
                                            <?php endif; ?>
                                            <div class="add-to-cart-box">
                                                <button 
                                                    class="add-to-cart-btn" 
                                                    onclick="addToCart(this, <?= $product['id'] ?>, '<?= $product['name'] ?>', <?= $product['sale'] ? $product['sale'] : $product['price'] ?>, '<?= $product['image'] ?>')"
                                                >
                                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="image-modal" onclick="closeImageModal()">
            <img
                class="image-modal__display"
                src=""
                alt=""
                onclick="event.stopPropagation()"
            />
            <a class="image-modal__close">
                <i class="fa-regular fa-circle-xmark"></i>
            </a>
        </div>                                      
<!-- End main -->