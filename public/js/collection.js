function toggleFilterMenu(menuId) {
    document.getElementById(menuId).classList.toggle('filter-menu__body--active');
}

document.addEventListener('DOMContentLoaded', () => {
    const categoryFilters = document.querySelectorAll("input[name='category-filter']");
    const priceFilters = document.querySelectorAll("input[name='price-filter']");
    const productContainer = document.querySelector('.products-list');
    const paginationContainer = document.querySelector('.pagination');

    let filters = {
        category: '',
        price: [],
        num: 1,
        sort: ''
    };

    function loadProducts() {
        const queryParams = new URLSearchParams({
            category: filters.category,
            price: filters.price.join(','),
            num: filters.num,
            sort: filters.sort
        }).toString();

        console.log(queryParams);
        fetch(`index.php?page=handle-products-display&${queryParams}`)
            .then(response => response.json())
            .then(data => {
                productContainer.innerHTML = data.products.map(renderProduct).join('');
                document.querySelector('.collection-name').innerText = data.category.name;
                document.querySelector('.collection-desc').innerText = data.category.description;
                paginationContainer.innerHTML = data.pagination;
                filters.num = 1;
            })
            .catch(error => console.error('Error:', error));
    }

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
                    <a href="index.php?page=product-details&id='.${product.id}.'" class="product-item__title-link">
                        <h4 class="product-item__name">${product.name}</h4>
                    </a>
                    <div class="product-item__rating">
                        ${renderStars(product.rating)}
                    </div>
                    <div class="product-item__price">
                        ${
                            product.sale
                                ? `<span class="product-item__price-old">${formatPrice(product.price)}đ</span>`
                                : ''
                        }
                        <span class="product-item__price-current">${formatPrice(product.sale || product.price)}đ</span>
                    </div>
                    ${
                        product.sale
                            ? `<div class="product-item__sale-off">-${calculateDiscount(
                                  product.price,
                                  product.sale
                              )}%</div>`
                            : ''
                    }
                    <div class="add-to-cart-box">
                        <button 
                            class="add-to-cart-btn" 
                            onclick="addToCart(this, ${product.id}, '${product.name}', ${
            product.sale || product.price
        }, '${product.image}')"
                        >
                            THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    function renderStars(rating) {
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            starsHtml += `<i class="star-icon fa-${i <= rating ? 'solid' : 'regular'} fa-star"></i>`;
        }
        return starsHtml;
    }

    function formatPrice(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function calculateDiscount(price, sale) {
        return Math.round(((price - sale) / price) * 100);
    }

    categoryFilters.forEach(filter => {
        if (filter.checked) {
            filters.category = filter.id;
            loadProducts();
        }
    });

    categoryFilters.forEach(filter =>
        filter.addEventListener('change', function () {
            filters.category = this.id;
            loadProducts();
        })
    );

    priceFilters.forEach(filter =>
        filter.addEventListener('change', function () {
            filters.price = Array.from(priceFilters)
                .filter(filter => filter.checked)
                .map(filter => filter.id);
            loadProducts();
        })
    );

    paginationContainer.addEventListener('click', function (e) {
        if (e.target.tagName === 'A') {
            e.preventDefault();
            filters.num = e.target.getAttribute('data-page');
            loadProducts();
        }
    });

    document.getElementById('sort-select').addEventListener('change', function () {
        filters.sort = this.value;
        loadProducts();
    });

    loadProducts();
});
