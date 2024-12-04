// Chỉnh sửa thông tin cá nhân
const editIcons = document.querySelectorAll('.edit-icon-blue');
editIcons.forEach(icon => {
    icon.addEventListener('click', function () {
        const input = this.previousElementSibling;
        input.classList.add('editable');
        input.removeAttribute('readonly');
        input.focus();

        input.addEventListener('blur', () => {
            input.setAttribute('readonly', true);
            input.classList.remove('editable');
        });
    });
});

// Chuyển đổi các tabs
function setActiveMenu(elm, menuClass, itemClass, menuActiveClass, contentActiveClass, contentId) {
    const menuItems = document.getElementsByClassName(menuClass);
    const mainItems = document.getElementsByClassName(itemClass);

    Array.from(menuItems).forEach(item => item.classList.remove(menuActiveClass));
    Array.from(mainItems).forEach(item => item.classList.remove(contentActiveClass));

    elm.classList.add(menuActiveClass);
    document.getElementById(contentId).classList.add(contentActiveClass);
}

function openUserInformation(elm) {
    setActiveMenu(elm, 'sidebar-menu__item', 'main-information', 'sidebar-menu__item--active', 'main-information--active', 'user-information');
}

function openOrderHistory(elm) {
    setActiveMenu(elm, 'sidebar-menu__item', 'main-information', 'sidebar-menu__item--active', 'main-information--active', 'order-history');
}

function openFavoriteProducts(elm) {
    setActiveMenu(elm, 'sidebar-menu__item', 'main-information', 'sidebar-menu__item--active', 'main-information--active', 'favorite-products');
}

// Popup đánh giá
const popup = document.getElementById('popup');
function openReviewModal(orderId) {
    popup.style.display = 'flex';
    document.querySelector('.order-id').value = orderId;
}

const closePopupBtn = document.getElementById('closePopupBtn');
closePopupBtn.addEventListener('click', () => {
    popup.style.display = 'none';
});
window.addEventListener('click', e => {
    if (e.target === popup) {
        popup.style.display = 'none';
    }
});

// Xử lý submit form đánh giá
document.getElementById('ratingForm').addEventListener('submit', e => {
    e.preventDefault();
    const rating = document.querySelector('input[name="rating"]:checked');
    if (rating) {
        document.getElementById('ratingForm').submit();
    } else {
        Swal.fire({
            title: 'Vui lòng chọn sao đánh giá',
            icon: 'error',
            showConfirmButton: true
        });
    }
});

function cancelOrder(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn huỷ đơn hàng không?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Có',
        cancelButtonText: 'Hủy'
    }).then(result => {
        if (result.isConfirmed) {
            window.location.href = `${baseUrl}/cancel-order/${id}`;
        }
    });
}

function buyBackOrder(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn tạo lại đơn hàng này không?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Có',
        cancelButtonText: 'Hủy'
    }).then(result => {
        if (result.isConfirmed) {
            window.location.href = `${baseUrl}/buy-back-order/${id}`;
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const orderContainer = document.querySelector('#orders');
    let num = 1;

    // Tải danh sách đánh giá từ server
    function loadOrders() {
        fetch(`${baseUrl}/index.php?page=handle-orders-display&num=${num}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    orderContainer.innerHTML = data.orders.map(renderOrders).join('').concat(data.pagination);
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
                        loadOrders();
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Render đánh giá vào DOM
    function renderOrders(order) {
        // Hàm xác định trạng thái giao hàng
        function getStatusInfo(status) {
            let statusClass = '';
            let statusIcon = '';
            let statusText = status;

            switch (status) {
                case 'Chờ xác nhận':
                case 'Đã xác nhận':
                    statusClass = 'delivery-status__stt-wait';
                    statusIcon = 'fa-hourglass-start';
                    break;
                case 'Đang giao hàng':
                case 'Giao hàng thành công':
                    statusClass = 'delivery-status__stt-delivery';
                    statusIcon = 'fa-truck';
                    break;
                default:
                    statusClass = 'delivery-status__stt-cancel';
                    statusIcon = 'fa-ban';
                    statusText = 'Đã huỷ';
            }

            return { statusClass, statusIcon, statusText };
        }

        const { statusClass, statusIcon, statusText } = getStatusInfo(order.status);

        // Hàm xác định nút chức năng
        function getActionButton(status, orderId, isReviewed) {
            if (status === 'Chờ xác nhận') {
                return `<button onclick="cancelOrder(${orderId})" class="options-btn">Huỷ</button>`;
            } else if (status === 'Giao hàng thành công') {
                if (isReviewed === 0) {
                    return `<button onclick="openReviewModal(${orderId})" id="openPopupBtn" class="options-btn">Đánh giá</button>`;
                }
                return '';
            } else if (status === 'Đã huỷ') {
                return `<button onclick="buyBackOrder(${orderId})" class="options-btn">Mua lại</button>`;
            }
            return ''; // Trả về chuỗi rỗng nếu không có nút tương ứng
        }

        // Lấy nút chức năng dựa trên trạng thái
        const actionButton = getActionButton(order.status, order.id, order.is_reviewed);

        return `
            <div class="order-history-item">
                <div class="product-order-wrap">${order.details
                    .map(detail => {
                        return `
                            <div class="product-order">
                                <div class="product-info">
                                    <img src="${baseUrl}/public/upload/product/${detail.product_image}" alt="${
                            detail.product_name
                        }" class="product-info__img" />
                                    <div class="product-info__right">
                                        <h4 class="product-info__name">${detail.product_name}</h4>
                                        <span class="product-info__quantity">x${detail.quantity}</span>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <span class="product-price__current">${new Intl.NumberFormat().format(detail.unit_price)}đ</span>
                                </div>
                            </div>
                        `;
                    })
                    .join('')}</div>
                <div class="delivery-status">
                    <div class="delivery-status__line"></div>
                    <span class="${statusClass}">
                        <i class="status-icon fa-solid ${statusIcon}"></i>
                        ${statusText}
                    </span>
                </div>
                <div class="into-money">
                    <span class="into-money__order-id">#${order.id} <span style="color: #0e1c22; opacity: 0.4; font-weight: normal;">[${
            order.created_at
        }]</span></span>
                    <div class="into-money__total">
                        <span class="into-money__total-label">Thành tiền:</span>
                        <span class="into-money__total-price">${new Intl.NumberFormat().format(order.total_amount)}đ</span>
                    </div>
                </div>
                ${actionButton}
            </div>
        `;
    }

    loadOrders();
});
