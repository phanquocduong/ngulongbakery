// Hàm toggleFavorite: Thêm hoặc bỏ yêu thích cho sản phẩm
function toggleFavorite(productId, userId) {
    fetch('index.php?page=handle-favorite-product', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ productId, userId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const heartIcon = document.querySelector(`.heart-icon`);
                heartIcon.classList.toggle('heart-icon--fill', data.isFavorite); // Thay đổi màu icon yêu thích
            } else {
                alert(data.error); // Lỗi nếu có
            }
        })
        .catch(error => console.error('Error:', error)); // Log lỗi nếu có
}

// Hàm changeDisplayImage: Thay đổi ảnh hiển thị khi click vào ảnh nhỏ
function changeDisplayImage(image) {
    const displayImage = document.querySelector('.main-image');
    const extraImages = document.querySelectorAll('.extra-image');

    // Loại bỏ lớp sáng cho tất cả ảnh nhỏ
    for (let extraImage of extraImages) {
        extraImage.classList.remove('extra-image--bright');
    }

    // Thêm lớp sáng cho ảnh được click
    image.classList.add('extra-image--bright');

    // Thêm lớp fade-in để tạo hiệu ứng chuyển ảnh
    displayImage.classList.add('fade-in');
    displayImage.style.opacity = 0;

    // Đổi ảnh sau một khoảng thời gian để tạo hiệu ứng mượt mà
    setTimeout(() => {
        displayImage.style.backgroundImage = `url('${image.src}')`;
        displayImage.style.opacity = 1;
    }, 100);

    // Loại bỏ lớp fade-in sau khi hiệu ứng hoàn thành
    setTimeout(() => {
        displayImage.classList.remove('fade-in');
    }, 600);
}

// Hàm activeTab: Đổi tab khi người dùng click vào tab
function activeTab(tab, id) {
    const allTabs = document.querySelectorAll('.tab-item');

    // Loại bỏ lớp active cho tất cả các tab
    for (let tab of allTabs) {
        tab.classList.remove('tab-item--active');
    }

    // Thêm lớp active cho tab hiện tại
    tab.classList.add('tab-item--active');

    const allTabsContent = document.querySelectorAll('.tab-content');

    // Loại bỏ lớp active cho tất cả các content
    for (let tabContent of allTabsContent) {
        tabContent.classList.remove('tab-content--active');
    }

    // Hiển thị nội dung của tab hiện tại
    const tabContentActive = document.getElementById(id);
    tabContentActive.classList.add('tab-content--active');
}

// Hàm updateQuantity: Cập nhật số lượng sản phẩm
function updateQuantity(num) {
    let quantity = document.querySelector('.quantity-selection__action-edit');

    if (num > 0) {
        quantity.value = ++quantity.value; // Tăng số lượng
    }
    if (num < 0 && quantity.value > 1) {
        quantity.value = --quantity.value; // Giảm số lượng nếu số lượng > 1
    }
}

// Hàm openImageModal: Mở modal hiển thị ảnh lớn
function openImageModal(image) {
    const imageModalDisplay = document.querySelector('.image-modal__display');
    const imageModal = imageModalDisplay.parentElement;

    // Kiểm tra nếu ảnh có background-image, lấy URL từ src hoặc background-image
    let imageUrl = image.style.backgroundImage ? image.style.backgroundImage.slice(5, image.style.backgroundImage.length - 2) : image.src;

    // Cập nhật ảnh hiển thị trong modal
    imageModalDisplay.src = imageUrl;

    // Thêm lớp để hiển thị modal
    imageModal.classList.add('image-modal--active');
}

// Hàm closeImageModal: Đóng modal khi người dùng click đóng
function closeImageModal() {
    const imageModal = document.querySelector('.image-modal');
    imageModal.classList.remove('image-modal--active');
}

document.addEventListener('DOMContentLoaded', () => {
    const reviewContainer = document.querySelector('#reviews');
    const productId = document.getElementById('productId').value;
    const reviewsTab = document.getElementById('reviews-tab');
    let num = 1; // Khai báo num với giá trị mặc định là 1

    // Hàm loadReviews: Tải danh sách đánh giá từ server
    function loadReviews() {
        fetch(`index.php?page=handle-product-reviews-display&product-id=${productId}&num=${num}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    reviewContainer.innerHTML = data.reviews.map(renderReviews).join('').concat(data.pagination);
                    reviewsTab.innerText = `Đánh giá (${data.reviewCount})`;

                    // Lắng nghe sự kiện phân trang
                    const paginationContainer = document.querySelector('.pagination');
                    paginationContainer.addEventListener('click', function (e) {
                        if (e.target.tagName === 'A') {
                            e.preventDefault();
                            num = e.target.getAttribute('data-page'); // Cập nhật num khi người dùng click vào phân trang
                            loadReviews(); // Tải lại danh sách đánh giá với num mới
                        }
                    });
                } else {
                    console.error(data.message); // Log lỗi nếu có
                }
            })
            .catch(error => console.error('Error:', error)); // Log lỗi nếu có
    }

    // Render đánh giá vào DOM
    function renderReviews(review) {
        return `
            <div class="review-item">
                <img class="review-item__avatar" src="public/upload/avatar/${review.avatar}" alt="${review.full_name}" />
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
                                      .map(image => `<img class="review-item__image" src="public/upload/review/${image}" alt="" />`)
                                      .join('')
                                : ''
                        }
                    </div>
                </div>
            </div>
        `;
    }

    // Hàm renderStars: Render sao đánh giá sản phẩm
    function renderStars(rating) {
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            starsHtml += `<i class="star-icon fa-${i <= rating ? 'solid' : 'regular'} fa-star"></i>`;
        }
        return starsHtml;
    }

    // Tải danh sách đánh giá ban đầu
    loadReviews();
});
