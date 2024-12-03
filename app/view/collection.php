<main>
    <div class="collection-box grid wide">
        <div class="row">
            <div class="col l-3 m-12 c-10 c-offset-1">
                <div class="sidebar">
                    <!-- Lọc danh mục -->
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
                    <!-- Lọc giá -->
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
                <div class="collection-main">
                    <div class="collection-main__heading">
                        <h1 class="collection-name"></h1>
                        <!-- Lọc thứ tự -->
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
                                </select>
                            </div>
                        </div>
                    </div>
                    <p class="collection-desc"></p>
                    <!-- Container sản phẩm -->
                    <div class="row products-list">
                        <div class="loading-spinner" style="display: none;">
                            <span>Đang tải...</span>
                        </div>
                    </div>
                </div>
                <!-- Phân trang -->
                <div class="pagination"></div>
            </div>
        </div>
    </div>
</main>