
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
                            <?php if(!empty($data['product']['sale']) && $data['product']['sale'] < $data['product']['price']): ?>
                                <?php $percentDiscount = round(($data['product']['price'] - $data['product']['sale']) / $data['product']['price'] * 100); ?>
                                <div class="sale-off">-<?=$percentDiscount?>%</div>
                            <?php endif; ?>

                            <div class="extra-images">
                                <img
                                    onclick="changeDisplayImage(this)"
                                    src="public/upload/product/<?=$data['product']['image']?>"
                                    alt="<?=$data['product']['name']?>"
                                    class="extra-image extra-image--bright"
                                />
                                <?php if (!empty($data['product']['extra_image'])): 
                                    $extra_images = explode(",", $data['product']['extra_image']); 
                                    foreach ($extra_images as $extra_image): 
                                        if (!empty($extra_image)): ?>
                                            <img
                                                onclick="changeDisplayImage(this)"
                                                src="public/upload/product/<?=htmlspecialchars($extra_image)?>"
                                                alt="Product Extra Image"
                                                class="extra-image"
                                            />
                                        <?php endif; 
                                    endforeach; 
                                endif; ?>
                            </div>
                        </div>
                        <div class="details-header__right col l-6 m-12 c-12">
                            <h2 class="product-name"><?=$data['product']['name']?></h2>
                            <div class="product-price-box">
                                <?php if($data['product']['sale']): ?>
                                    <span class="product-price-old"><?=number_format($data['product']['price'], 0, ',', '.')?>đ</span>
                                    <span class="product-price-current"><?=number_format($data['product']['price'], 0, ',', '.')?>đ</span>
                                <?php else: ?>
                                    <span class="product-price-current"><?=number_format($data['product']['price'], 0, ',', '.')?>đ</span>
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
                                        <input type="text" class="quantity-selection__action-edit" value="1" readonly/>
                                        <input
                                            onclick="updateQuantity(1)"
                                            type="button"
                                            class="quantity-selection__action-add"
                                            value="+"
                                        />
                                    </div>
                                </div>
                                <button class="add-to-cart-btn" onclick="addToCart(this, <?=$data['product']['id']?>)">
                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                </button>
                            </div>
                            <div class="related-info">
                                <span class="product-code">ID: <?=$data['product']['id']?></span>
                                <span class="product-code">Đang có: <?=$data['product']['stock_quantity']?></span>
                                <span class="product-cate">
                                    Danh mục: 
                                    <a class="product-cate__link" href="index.php?page=collection&id=<?=$data['product']['category_id']?>"><?=$data['product']['category_name']?></a>
                                </span>
                                <?php if (isset($_SESSION['user'])): ?>
                                    <div class="favorite-action">
                                        <i onclick="toggleFavorite(<?= $data['product']['id'] ?>, <?= $_SESSION['user']['id'] ?>)" 
                                            class="heart-icon fa-solid fa-heart <?= (isset($data['favorite'])) ? 'heart-icon--fill' : '' ?>">
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
                        <li onclick="activeTab(this, 'reviews')" id="reviews-tab" class="tab-item">Đánh giá ()</li>
                    </ul>
                    <div id="detailed-desc" class="tab-content tab-content--active"><?= $data['product']['detailed_description'] ?></div>
                    <input id="productId" type="hidden" value="<?=$data['product']['id']?>">
                    <div id="reviews" class="tab-content"></div>
                </div>
                <?php if (!empty($data['relatedProducts'])): ?>
                    <div class="related-products">
                        <h2 class="section-title test">SẢN PHẨM LIÊN QUAN</h2>
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
                                                <span class="product-item__price-old"><?=number_format($product['price'], 0, ',', '.')?>đ</span>
                                                <span class="product-item__price-current"><?=number_format($product['sale'], 0, ',', '.')?>đ</span>
                                            <?php else: ?>
                                                <span class="product-item__price-current"><?=number_format($product['price'], 0, ',', '.')?>đ</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($product['sale']): ?>
                                            <?php $percentDiscount = round(($product['price'] - $product['sale']) / $product['price'] * 100); ?>
                                            <div class="product-item__sale-off">-<?= $percentDiscount ?>%</div>
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
                <?php endif; ?>
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