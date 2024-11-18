        <main>
            <div class="collection-box grid wide">
                <div class="row">
                    <div class="col l-3 m-12 c-10 c-offset-1">
                        <div class="sidebar">
                            <div class="filter-menu">
                                <h2 onclick="toggleFilterMenu('filterCategoryBox')" class="filter-menu__heading">
                                    <span>DANH MỤC</span><i class="fa-solid fa-chevron-down"></i>
                                </h2>
                                <div id="filterCategoryBox" class="filter-menu__body">
                                    <div class="filter-menu__item">
                                        <input id="0" name="category-filter" type="radio" checked />
                                        <label class="filter-menu__item-label" for="0">Tất cả</label>
                                    </div>
                                    <?php foreach($categories as $category): ?>
                                        <div class="filter-menu__item">
                                            <input id="<?=$category['id']?>" name="category-filter" type="radio" <?=(isset($_GET['id']) && $_GET['id'] == $category['id'])  ? 'checked' : ''?>/>
                                            <label class="filter-menu__item-label" for="<?=$category['id']?>"><?=$category['name']?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filter-menu">
                                <h2 onclick="toggleFilterMenu('filterPriceBox')" id="filterPriceHeading" class="filter-menu__heading">
                                    <span>GIÁ SẢN PHẨM</span><i class="fa-solid fa-chevron-down"></i>
                                </h2>
                                <div id="filterPriceBox" class="filter-menu__body">
                                    <div class="filter-menu__item">
                                        <input id="under25" name='price-filter' type="checkbox" />
                                        <label class="filter-menu__item-label" for="under25">Giá dưới 25.000đ</label>
                                    </div>
                                    <div class="filter-menu__item">
                                        <input id="25-50" name='price-filter' type="checkbox" />
                                        <label class="filter-menu__item-label" for="25-50">25.000đ - 50.000đ</label>
                                    </div>
                                    <div class="filter-menu__item">
                                        <input id="50-75" name='price-filter' type="checkbox" />
                                        <label class="filter-menu__item-label" for="50-75">50.000đ - 75.000đ</label>
                                    </div>
                                    <div class="filter-menu__item">
                                        <input id="75-100" name='price-filter' type="checkbox" />
                                        <label class="filter-menu__item-label" for="75-100">75.000đ - 100.000đ</label>
                                    </div>
                                    <div class="filter-menu__item">
                                        <input id="over100" name='price-filter' type="checkbox" />
                                        <label class="filter-menu__item-label" for="over100">Giá trên 100.000đ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l-9 m-12 c-10 c-offset-1">
                        <img class="banner-collection" src="public/upload/banner/banner-collection.png" alt="" />
                        <div class="collection-main">
                            <div class="collection-main__heading">
                                <h1 class="collection-name"></h1>
                                <div class="sort-right">
                                    <span class="sort-right__title">Sắp xếp theo:</span>
                                    <div class="sort-right__selection">
                                        <select class="sort-right__selection-list" id="sort-select">
                                            <option value="">Mặc định</option>
                                            <option value="price_asc">Giá: Tăng dần</option>
                                            <option value="price_desc">Giá: Giảm dần</option>
                                            <option value="name_asc">Tên: A-Z</option>
                                            <option value="name_desc">Tên: Z-A</option>
                                            <option value="featured">Sản phẩm nổi bật</option>
                                            <option value="promotion">Sản phẩm khuyến mãi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="collection-desc"></p>
                            <div class="row products-list">
                                <?php foreach($data as $product): ?>
                                    <div class="col l-3 m-6 c-10 c-offset-1">
                                        <div class="product-item">
                                            <a href="index.php?page=product-details&id=<?=$product['id']?>" class="product-item__img-link">
                                                <div class="product-item__img" style="background-image: url(public/upload/product/<?= $product['image'] ?>);"></div>
                                            </a>
                                            <a href="index.php?page=product-details&id=<?=$product['id']?>" class="product-item__title-link">
                                                <h4 class="product-item__name"><?= $product['name'] ?></h4>
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
                        <div class="pagination">
                            <?php
                                $current_page = isset($_GET['num']) ? (int)$_GET['num'] : 1;
                                $previous_page = $current_page - 1;
                                $next_page = $current_page + 1;
                            ?>
                            <a href="index.php?page=collection&id=<?=$_GET['id']?>&num=<?= $previous_page ?>" class="pagination-link__icon-left <?= $current_page == 1 ? 'none' : '' ?>">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                            <?php for ($i = 1; $i <= $numberPages; $i++): ?>
                                <a href="index.php?page=collection&id=<?=$_GET['id']?>&num=<?= $i ?>" class="pagination-link <?= $i == $current_page ? 'active' : '' ?>"><?= $i ?></a>
                            <?php endfor; ?>
                            <a href="index.php?page=collection&id=<?=$_GET['id']?>&num=<?= $next_page ?>" class="pagination-link__icon-right <?= $current_page == $numberPages ? 'none' : '' ?>">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>