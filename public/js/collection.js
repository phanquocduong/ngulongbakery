function toggleFilterMenu(menuId) {
    // Toggle hiển thị menu lọc
    document.getElementById(menuId).classList.toggle('filter-menu__body--active');
}

document.addEventListener('DOMContentLoaded', () => {
    // Lấy các phần tử cần thiết từ DOM
    const categoryFilters = document.querySelectorAll("input[name='category-filter']");
    const priceFilters = document.querySelectorAll("input[name='price-filter']");
    const productContainer = document.querySelector('.products-list');
    const loadingSpinner = document.querySelector('.loading-spinner');
    const paginationContainer = document.querySelector('.pagination');

    // Định nghĩa các bộ lọc mặc định
    let filters = {
        category: '',
        price: [],
        num: 1,
        sort: ''
    };

    // Hàm tải sản phẩm từ server và hiển thị lên trang
    function loadProducts() {
        loadingSpinner.style.display = 'block'; // Hiển thị spinner khi đang tải

        // Xây dựng chuỗi queryParams từ các bộ lọc
        const queryParams = new URLSearchParams({
            category: filters.category,
            price: filters.price.join(','),
            num: filters.num,
            sort: filters.sort
        }).toString();

        // Gửi yêu cầu lấy sản phẩm từ server
        fetch(`index.php?page=handle-products-display&${queryParams}`)
            .then(response => response.json())
            .then(data => {
                loadingSpinner.style.display = 'none'; // Ẩn spinner khi dữ liệu đã được tải
                if (data.message) {
                    // Nếu không có sản phẩm, hiển thị thông báo
                    productContainer.style.justifyContent = 'center';
                    productContainer.innerHTML = `<p class="no-products-message">${data.message}</p>`;
                } else {
                    // Hiển thị danh sách sản phẩm
                    productContainer.style.justifyContent = '';
                    productContainer.innerHTML = data.products.map(renderProduct).join('');
                }
                // Cập nhật thông tin danh mục và phân trang
                document.querySelector('.collection-name').innerText = data.category.name;
                document.querySelector('.collection-desc').innerText = data.category.description;
                paginationContainer.innerHTML = data.pagination;
                filters.num = 1; // Đặt lại số trang sau mỗi lần tải sản phẩm mới
            })
            .catch(error => {
                loadingSpinner.style.display = 'none'; // Ẩn spinner nếu có lỗi xảy ra
                console.error('Error:', error);
            });
    }

    // Hàm render từng sản phẩm
    function renderProduct(product) {
        return `
            <div class="col l-4 m-6 c-10 c-offset-1">
                <div class="product-item">
                    <a href="index.php?page=product-details&id=${product.id}" class="product-item__img-link">
                        <div
                            style="background-image: url(public/upload/product/${product.image});"
                            class="product-item__img"
                        ></div>
                    </a>
                    <a href="index.php?page=product-details&id=${product.id}" class="product-item__title-link">
                        <h4 class="product-item__name">${product.name}</h4>
                    </a>
                    <div class="product-item__rating">
                        ${renderStars(product.rating)}
                    </div>
                    <div class="product-item__price">
                        ${product.sale ? `<span class="product-item__price-old">${new Intl.NumberFormat().format(product.price)}đ</span>` : ''}
                        <span class="product-item__price-current">${new Intl.NumberFormat().format(product.sale || product.price)}đ</span>
                    </div>
                    ${product.sale ? `<div class="product-item__sale-off">-${calculateDiscount(product.price, product.sale)}%</div>` : ''}
                    <div class="add-to-cart-box">
                        <button 
                            class="add-to-cart-btn" 
                            onclick="addToCart(this, ${product.id}, '${product.name}', ${product.sale || product.price}, '${product.image}')"
                        >
                            THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Hàm render sao đánh giá của sản phẩm
    function renderStars(rating) {
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            starsHtml += `<i class="star-icon fa-${i <= rating ? 'solid' : 'regular'} fa-star"></i>`;
        }
        return starsHtml;
    }

    // Hàm tính toán phần trăm giảm giá
    function calculateDiscount(price, sale) {
        return Math.round(((price - sale) / price) * 100);
    }

    // Hàm lắng nghe thay đổi của bộ lọc danh mục khi người dùng nhấn vào danh mục ở ngoài trang
    categoryFilters.forEach(filter => {
        if (filter.checked) {
            filters.category = filter.id;
            loadProducts();
        }
    });

    // Hàm lắng nghe thay đổi của bộ lọc danh mục khi người dùng chọn danh mục trong trang
    categoryFilters.forEach(filter =>
        filter.addEventListener('change', function () {
            filters.category = this.id;
            loadProducts();
        })
    );

    // Lắng nghe thay đổi của bộ lọc giá
    priceFilters.forEach(filter =>
        filter.addEventListener('change', function () {
            // Dùng Array.from để duyệt những phương thức duyệt mảng nâng cao vì priceFilters là một NodeList
            filters.price = Array.from(priceFilters)
                .filter(filter => filter.checked)
                .map(filter => filter.id);
            loadProducts();
        })
    );

    // Lắng nghe sự kiện phân trang
    paginationContainer.addEventListener('click', function (e) {
        if (e.target.tagName === 'A') {
            e.preventDefault();
            filters.num = e.target.getAttribute('data-page');
            loadProducts();
        }
    });

    // Lắng nghe sự kiện sắp xếp sản phẩm
    document.getElementById('sort-select').addEventListener('change', function () {
        filters.sort = this.value;
        loadProducts();
    });

    // Tải sản phẩm ngay khi trang được tải
    loadProducts();
});
