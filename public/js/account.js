// Chọn tất cả các icon chỉnh sửa
const editIcons = document.querySelectorAll('.edit-icon-blue');

// Lặp qua mỗi icon chỉnh sửa
editIcons.forEach(icon => {
    icon.addEventListener('click', function () {
        // Tìm đến input cùng dòng với icon được bấm
        const input = this.previousElementSibling;

        // Thêm class để làm nổi bật outline khi focus
        input.classList.add('editable');

        // Bỏ thuộc tính readonly để có thể focus và chỉnh sửa
        input.removeAttribute('readonly');

        // Focus vào input
        input.focus();

        // Khi input mất focus, khóa lại và bỏ outline
        input.addEventListener('blur', () => {
            input.setAttribute('readonly', true);
            input.classList.remove('editable');
        });
    });
});

function openUserInformation(elm) {
    const sidebarMenuItem = document.getElementsByClassName('sidebar-menu__item');
    for (let item of sidebarMenuItem) {
        item.classList.remove('sidebar-menu__item--active');
    }
    elm.classList.add('sidebar-menu__item--active');
    const allMainInformation = document.getElementsByClassName('main-information');
    for (let item of allMainInformation) {
        item.classList.remove('main-information--active');
    }
    const userInformation = document.getElementById('user-information');
    userInformation.classList.add('main-information--active');
}

function openOrderHistory(elm) {
    const sidebarMenuItem = document.getElementsByClassName('sidebar-menu__item');
    for (let item of sidebarMenuItem) {
        item.classList.remove('sidebar-menu__item--active');
    }
    elm.classList.add('sidebar-menu__item--active');
    const allMainInformation = document.getElementsByClassName('main-information');
    for (let item of allMainInformation) {
        item.classList.remove('main-information--active');
    }
    const orderHistory = document.getElementById('order-history');
    orderHistory.classList.add('main-information--active');
}

function openFavoriteProducts(elm) {
    const sidebarMenuItem = document.getElementsByClassName('sidebar-menu__item');
    for (let item of sidebarMenuItem) {
        item.classList.remove('sidebar-menu__item--active');
    }
    elm.classList.add('sidebar-menu__item--active');
    const allMainInformation = document.getElementsByClassName('main-information');
    for (let item of allMainInformation) {
        item.classList.remove('main-information--active');
    }
    const favoriteProducts = document.getElementById('favorite-products');
    favoriteProducts.classList.add('main-information--active');
}

const popup = document.getElementById('popup');
function openReviewModal(orderId) {
    popup.style.display = 'flex';
    document.querySelector('.order-id').value = orderId;
}

const closePopupBtn = document.getElementById('closePopupBtn');
// Close popup when close button is clicked
closePopupBtn.addEventListener('click', () => {
    popup.style.display = 'none';
});
// Close popup when clicking outside the popup content
window.addEventListener('click', e => {
    if (e.target === popup) {
        popup.style.display = 'none';
    }
});

// Handle form submission (you can modify this as needed)
document.getElementById('ratingForm').addEventListener('submit', e => {
    e.preventDefault();
    const rating = document.querySelector('input[name="rating"]:checked');
    const comment = document.getElementById('comment').value;
    if (rating && comment) {
        document.getElementById('ratingForm').submit();
    } else {
        alert('Vui lòng chọn sao và nhập nhận xét.');
    }
});

function cancelOrder(id) {
    const result = confirm('Bạn có chắc chắn muốn huỷ đơn hàng không?');
    if (result) {
        window.location.href = `index.php?page=cancel-order&id=${id}`;
    }
}

function buyBackOrder(id) {
    const result = confirm('Bạn có chắc chắn muốn tạo lại đơn hàng này không?');
    if (result) {
        window.location.href = `index.php?page=buy-back-order&id=${id}`;
    }
}
