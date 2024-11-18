function toggleFilterMenu(menuId) {
    document.getElementById(menuId).classList.toggle('filter-menu__body--active');
}

document.addEventListener('DOMContentLoaded', () => {
    // Lấy tất cả các radio button của các danh mục
    const categoryFilters = document.querySelectorAll('input[name="category-filter"]');
    const priceFilters = document.querySelectorAll('input[name="price-filter"]');
    let categoryId = null;
    let priceArray = [];

    categoryFilters.forEach(filter => {
        filter.addEventListener('change', () => {
            categoryId = filter.id;
            fetchProductsByFilter(categoryId, priceArray);
        });
    });

    priceFilters.forEach(filter => {
        filter.addEventListener('change', () => {
            if (filter.checked) {
                priceArray.push(filter.id); // Thêm giá vào mảng nếu chọn
            } else {
                priceArray = priceArray.filter(value => value !== filter.id); // Loại bỏ giá khỏi mảng nếu bỏ chọn
            }
            fetchProductsByFilter(categoryId, priceArray);
        });
    });
});

function fetchProductsByFilter(categoryId, priceArray) {
    const queryParams = new URLSearchParams();
    if (categoryId) queryParams.append('category_id', categoryId);
    if (priceArray.length > 0) queryParams.append('price', JSON.stringify(priceArray));

    fetch(`index.php?page=handle-products-display-by-filter&${queryParams.toString()}`)
        .then(response => response.json())
        .then(data => {
            const productsContainer = document.querySelector('.collection-main .row');
            productsContainer.innerHTML = ''; // Xóa sản phẩm hiện tại

            // Duyệt qua từng sản phẩm và thêm vào container
            let productHtml = data.products
                .map(item => {
                    return `
                    <div class="col l-4 m-6 c-10 c-offset-1">
                        <div class="product-item">
                            <a href="index.php?page=product-details&id=${item.id}" class="product-item__img-link">
                                <div
                                    style="background-image: url(public/upload/product/${item.image});"
                                    class="product-item__img"
                                ></div>
                            </a>
                            <a href="index.php?page=product-details&id='.${item.id}.'" class="product-item__title-link">
                                <h4 class="product-item__name">${item.name}</h4>
                            </a>
                            <div class="product-item__rating">
                                ${renderStars(item.rating)}
                            </div>
                            <div class="product-item__price">
                                ${
                                    item.sale
                                        ? `<span class="product-item__price-old">${formatPrice(item.price)}đ</span>`
                                        : ''
                                }
                                <span class="product-item__price-current">${formatPrice(
                                    item.sale || item.price
                                )}đ</span>
                            </div>
                            ${
                                item.sale
                                    ? `<div class="product-item__sale-off">-${calculateDiscount(
                                          item.price,
                                          item.sale
                                      )}%</div>`
                                    : ''
                            }
                            <div class="add-to-cart-box">
                                <button 
                                    class="add-to-cart-btn" 
                                    onclick="addToCart(this, ${item.id}, '${item.name}', ${item.sale || item.price}, '${
                        item.image
                    }')"
                                >
                                    THÊM VÀO GIỎ HÀNG <i class="check-icon fa-solid fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                })
                .join('');
            productsContainer.innerHTML = productHtml;
            document.querySelector('.collection-name').innerText = data.category.name;
            document.querySelector('.collection-desc').innerText = data.category.description;
            if (data.category.name) {
                document.querySelector('.pagination').style.display = 'none';
            } else {
                document.querySelector('.pagination').style.display = 'block';
                const priceFiltersChecked = document.querySelectorAll('input[name="price-filter"]:checked');
                if (priceFiltersChecked.length > 0 && priceFiltersChecked.length < 5) {
                    document.querySelector('.pagination').style.display = 'none';
                } else {
                    document.querySelector('.pagination').style.display = 'block';
                }
            }
        })
        .catch(error => console.error('Error:', error));
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
