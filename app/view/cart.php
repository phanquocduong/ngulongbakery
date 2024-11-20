<!-- Start main -->
        <main>
            <div class="grid wide">
                <div class="cart-wrap">
                    <?php 
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): 
                            $total = 0;
                    ?>
                        <div class="row">
                            <div class="col l-8 m-12 c-12">
                                <div class="cart-body-left">
                                    <div class="cart-body-left__heading">
                                        <div class="row">
                                            <div class="col l-1 m-1 c-1"></div>
                                            <div class="col l-11 m-11 c-11">
                                                <div class="row">
                                                    <div class="col l-5 m-5 c-5">Sản phẩm</div>
                                                    <div class="col l-2 m-2 c-2">Đơn giá</div>
                                                    <div class="col l-3 m-3 c-3">Số lượng</div>
                                                    <div class="col l-2 m-2 c-2">Thành tiền</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-body-left__content">
                                        <?php
                                            foreach ($_SESSION['cart'] as $index => $item):
                                                $tt = $item['price'] * $item['quantity'];
                                                $total += $tt
                                        ?>
                                            <div class="row order-item">
                                                <div class="col l-1 m-1 c-1">
                                                    <a onclick="deleteProduct(<?=$index?>)" class="delete-item">
                                                        <i class="delete-item__icon fa-solid fa-x"></i>
                                                    </a>
                                                </div>
                                                <div class="col l-11 m-11 c-11">
                                                    <div class="row">
                                                        <div class="col l-2 m-2 c-2">
                                                            <a href="index.php?page=product-details&id=<?=$item['id']?>" class="product-link">
                                                                <img
                                                                    src="public/upload/product/<?=$item['image']?>"
                                                                    alt=""
                                                                    class="product-link__img"
                                                                />
                                                            </a>
                                                        </div>
                                                        <div class="col l-3 m-3 c-3">
                                                            <a href="index.php?page=product-details&id=<?=$item['id']?>" class="product-link">
                                                                <h5 class="product-link__title"><?=$item['name']?></h5>
                                                            </a>
                                                            <div class="product-classify">
                                                                <span class="product-classify__title">Mã SP: <?=$item['id']?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col l-2 m-2 c-2">
                                                            <span class="product-price"><?=number_format($item['price'])?>đ</span>
                                                        </div>
                                                        <div class="col l-3 m-3 c-3">
                                                            <form action="index.php?page=handle-update-cart" method="POST" class="quantity-form">
                                                                <input type="hidden" name="index" value="<?=$index?>">
                                                                <div class="quantity-wrapper">
                                                                    <button type="button" onclick="decreaseQuantityInCart(this)" class="quantity-minus">-</button>
                                                                    <input type="text" name="quantity" class="quantity" value="<?=$item['quantity']?>">
                                                                    <button type="button" onclick="increaseQuantityInCart(this)" class="quantity-plus">+</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col l-2 m-2 c-2">
                                                            <span class="line-item-total" data-index="<?=$index?>"><?=number_format($tt)?>đ</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="background-color: transparent; height: 50px; width: 100%;"></div>
                                            </div>
                                        <?php 
                                            endforeach;
                                        ?>
                                    </div>
                                    <!-- Mobile -->
                                    <div class="cart-body-left__content cart-body-left__content--mobile">
                                        <?php foreach($_SESSION['cart'] as $item): ?>
                                            <div class="row order-item">
                                                <div class="col c-5">
                                                    <a href="index.php?page=product-details&id=<?=$item['id']?>" class="product-link">
                                                        <img
                                                            src="public/upload/product/<?=$item['image']?>"
                                                            alt=""
                                                            class="product-link__img"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="col c-5">
                                                    <a href="index.php?page=product-details&id=<?=$item['id']?>" class="product-link">
                                                        <h5 class="product-link__title"><?=$item['name']?></h5>
                                                    </a>
                                                    <div class="product-classify">
                                                        <span class="product-classify__title">Mã SP: <?=$item['id']?></span>
                                                    </div>
                                                    <span class="product-price"><?=number_format($item['price'])?>đ</span>
                                                    <div class="quantity-wrapper">
                                                        <form action="index.php?page=handle-update-cart" method="POST" class="quantity-form">
                                                            <input type="hidden" name="index" value="<?=$index?>">
                                                            <div class="quantity-wrapper">
                                                                <button type="button" onclick="decreaseQuantityInCart(this)" class="quantity-minus">-</button>
                                                                <input type="text" name="quantity" class="quantity" value="<?=$item['quantity']?>">
                                                                <button type="button" onclick="increaseQuantityInCart(this)" class="quantity-plus">+</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col c-2">
                                                    <a onclick="deleteProduct(<?=$index?>)" class="delete-item">
                                                        <i class="delete-item__icon fa-solid fa-x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="cart-body-left__footer">
                                        <div class="row">
                                            <div class="col l-1 m-1 c-1"></div>
                                            <div class="col l-11 m-11 c-11">
                                                <a href="allproduct.html" class="continue-shopping">
                                                    <i class="fa-solid fa-angle-left"></i>
                                                    TIẾP TỤC MUA SẮM
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-4 m-12 c-12">
                                <div class="cart-body-right">
                                    <div class="cart-total">
                                        <label for="" class="total-label">Thành tiền</label>
                                        <span class="total-price"><?=number_format($total)?>đ</span>
                                    </div>
                                    <a class="cart-btn-link" href="index.php?page=payment">
                                        <button class="cart-btn">Thanh toán</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="cart-empty">
                            <h2 class="cart-empty__title">Giỏ hàng của bạn đang trống!</h2>
                            <a href="index.php?page=allproducts" class="continue-buy__btn">Tiếp tục mua hàng</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
        <!-- End main -->