// Thêm hoặc bỏ yêu thích cho sản phẩm
function toggleFavorite(productId, userId) {
    fetch(`${baseUrl}/index.php?page=handle-favorite-product`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ productId, userId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`.heart-icon`).classList.toggle('heart-icon--fill', data.isFavorite);
            }
        })
        .catch(error => console.error('Error:', error));
}

// Thay đổi ảnh hiển thị khi click vào ảnh nhỏ
function changeDisplayImage(image) {
    const displayImage = document.querySelector('.main-image');
    const extraImages = document.querySelectorAll('.extra-image');

    for (let extraImage of extraImages) {
        extraImage.classList.remove('extra-image--bright');
    }

    image.classList.add('extra-image--bright');

    displayImage.classList.add('fade-in');
    displayImage.style.opacity = 0;

    setTimeout(() => {
        displayImage.style.backgroundImage = `url('${image.src}')`;
        displayImage.style.opacity = 1;
    }, 100);

    setTimeout(() => {
        displayImage.classList.remove('fade-in');
    }, 600);
}

// Đổi tab khi người dùng click vào tab
function activeTab(tab, id) {
    const allTabs = document.querySelectorAll('.tab-item');

    for (let tab of allTabs) {
        tab.classList.remove('tab-item--active');
    }
    tab.classList.add('tab-item--active');

    const allTabsContent = document.querySelectorAll('.tab-content');
    for (let tabContent of allTabsContent) {
        tabContent.classList.remove('tab-content--active');
    }
    document.getElementById(id).classList.add('tab-content--active');
}

// Cập nhật số lượng sản phẩm
function updateQuantity(num) {
    let quantity = document.querySelector('.quantity-selection__action-edit');

    if (num > 0) {
        quantity.value = ++quantity.value;
    }

    if (num < 0 && quantity.value > 1) {
        quantity.value = --quantity.value;
    }
}

// Mở modal hiển thị ảnh lớn
function openImageModal(image) {
    const imageModalDisplay = document.querySelector('.image-modal__display');
    let imageUrl = image.style.backgroundImage ? image.style.backgroundImage.slice(5, image.style.backgroundImage.length - 2) : image.src;

    imageModalDisplay.src = imageUrl;
    imageModalDisplay.parentElement.classList.add('image-modal--active');
}

// Đóng modal khi người dùng click đóng
function closeImageModal() {
    document.querySelector('.image-modal').classList.remove('image-modal--active');
}

document.addEventListener('DOMContentLoaded', () => {
    const reviewContainer = document.querySelector('#reviews');
    const productId = document.getElementById('productId').value;
    const reviewsTab = document.getElementById('reviews-tab');
    let num = 1;

    function loadReviews() {
        fetch(`${baseUrl}/index.php?page=handle-product-reviews-display&product-id=${productId}&num=${num}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    reviewContainer.innerHTML = data.reviews.map(renderReviews).join('').concat(data.pagination);
                    reviewsTab.innerText = `Đánh giá (${data.reviewCount})`;

                    // Lắng nghe sự kiện phân trang
                    const paginationContainer = document.querySelector('.pagination');
                    paginationContainer.addEventListener('click', function (e) {
                        e.preventDefault();
                        if (e.target.tagName === 'A') {
                            num = e.target.getAttribute('data-page');
                        }
                        if (e.target.tagName === 'I') {
                            num = e.target.parentElement.getAttribute('data-page');
                        }
                        loadReviews();
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Render đánh giá vào DOM
    function renderReviews(review) {
        return `
            <div class="review-item">
                <img class="review-item__avatar" src="${baseUrl}/public/upload/avatar/${review.avatar}" alt="${review.full_name}" />
                <div class="review-item__body">
                    <span class="review-item__name">${review.full_name}</span>
                    <div class="review-item__rating">${renderStars(review.rating)}</div>
                    <span class="review-item__date">${review.created_at}</span>
                    <p class="review-item__comment">${review.comment}</p>
                    <div class="review-item__images">
                        ${
                            review.images
                                ? review.images
                                      .split(',')
                                      .map(
                                          image =>
                                              `<img onclick="openImageModal(this)" class="review-item__image" src="${baseUrl}/public/upload/review/${image}" alt="" />`
                                      )
                                      .join('')
                                : ''
                        }
                    </div>
                </div>
            </div>
        `;
    }

    // Render sao đánh giá sản phẩm
    function renderStars(rating) {
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            starsHtml += `<i class="star-icon fa-${i <= rating ? 'solid' : 'regular'} fa-star"></i>`;
        }
        return starsHtml;
    }

    loadReviews();
});
