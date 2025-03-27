<main>
    <div class="grid wide">
        <h1 class="search-title">Kết quả tìm kiếm: "<?=$_GET['keyword']?>"</h1>
        <?php if(!empty($data)): ?>
            <div class="row">
                <?php foreach($data as $item): ?>
                    <div class="col l-3 m-6 c-12">
                        <div class="product-item">
                            <a href="<?=$base_url?>/product-details/<?=$item['id']?>" class="product-item__img-link">
                                <div class="product-item__img" style="background-image: url(<?=$base_url?>/public/upload/product/<?= $item['image'] ?>);"></div>
                            </a>
                            <a href="<?=$base_url?>/product-details/<?=$item['id']?>" class="product-item__title-link">
                                <h4 class="product-item__name"><?= $item['name'] ?></h4>
                            </a>
                            <div class="product-item__rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="star-icon fa-<?= $i <= $item['rating'] ? 'solid' : 'regular' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <div class="product-item__price">
                                <?php if ($item['sale']): ?>
                                    <span class="product-item__price-old"><?=number_format($item['price'], 0, ',', '.')?>đ</span>
                                    <span class="product-item__price-current"><?=number_format($item['sale'], 0, ',', '.')?>đ</span>
                                <?php else: ?>
                                    <span class="product-item__price-current"><?=number_format($item['price'], 0, ',', '.')?>đ</span>
                                <?php endif; ?>
                            </div>
                            <?php if ($item['sale']): ?>
                                <?php $percentDiscount = round(($item['price'] - $item['sale']) / $item['price'] * 100); ?>
                                <div class="product-item__sale-off">-<?= $percentDiscount ?>%</div>
                            <?php endif; ?>
                            <div class="add-to-cart-box">
                                <button class="add-to-cart-btn" data-product-id="<?=$item['id']?>">
                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="pagination">
                <?php
                    $current_page = isset($_GET['num']) ? (int)$_GET['num'] : 1;
                    $previous_page = $current_page - 1;
                    $next_page = $current_page + 1;
                ?>
                <a href="index.php?page=search&keyword=<?=$_GET['keyword']?>&num=<?=$previous_page?>" class="pagination-link__icon-prev <?= $current_page == 1 ? 'none' : '' ?>">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                <?php if ($numberPages > 1):
                        for ($i = 1; $i <= $numberPages; $i++): ?>
                            <a href="index.php?page=search&keyword=<?=$_GET['keyword']?>&num=<?=$i?>" class="pagination-link <?= $i == $current_page ? 'pagination-link--active' : '' ?>"><?= $i ?></a>
                <?php endfor; 
                    endif;
                ?>
                <a href="index.php?page=search&keyword=<?=$_GET['keyword']?>&num=<?=$next_page?>" class="pagination-link__icon-next <?= $current_page == $numberPages ? 'none' : '' ?>">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        <?php else: ?>
            <p class="not-found-title">Không tìm thấy sản phẩm nào.</p>
        <?php endif; ?>
    </div>
</main>

