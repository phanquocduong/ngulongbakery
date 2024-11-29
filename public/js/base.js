// ============================
// MODAL MENU CHO MOBILE
// ============================

// Chọn các elements trong modal menu và overlay
const menuToggle = document.querySelector('.menu-bars');
const modalMenu = document.getElementById('modalMenu');
const closeBtn = document.getElementById('closeBtn');
const overlay = document.getElementById('overlay');

// Hàm để mở modal menu
menuToggle.addEventListener('click', () => {
    modalMenu.classList.add('active');
    overlay.classList.add('active');
});

// Hàm để đóng model menu (khi nhấn vào button close hoặc nhấn ngoài overlay)
const closeModal = () => {
    modalMenu.classList.remove('active');
    overlay.classList.remove('active');
};

// Thêm sự kiện để đóng modal menu
closeBtn.addEventListener('click', closeModal);
overlay.addEventListener('click', closeModal);

// ============================
// MENU XỔ XUỐNG CHO MOBILE VÀ TABLET CỦA MODAL MENU
// ============================

// Chọn các elements để thêm sự kiện menu xổ xuống
const menuItemDrop = document.getElementById('menu-item-drop');
const menuItemDropOnTablet = document.getElementById('menu-item-drop--tablet');
const modalSubMenu = document.querySelector('.modal-sub-menu__list');

// Sự kiện menu xổ xuống cho Mobile
menuItemDrop.onclick = e => {
    e.preventDefault();
    modalSubMenu.classList.toggle('active');
};

// Vô hiệu hoá thẻ a cho elements có sự kiện menu xố xuống cho Tablet
menuItemDropOnTablet.onclick = e => {
    e.preventDefault();
};

// ============================
// HÀM XỬ LÝ NÚT SEARCH TRÊN MOBILE
// ============================

// Chọn các phần tử cho hàm xử lý nút search trên mobile
const searchBtn = document.querySelector('.header-search__btn.header-search__btn--mobile');
const searchInput = document.querySelector('.header-search__input--mobile');
const searchDiv = document.querySelector('.header-search--mobile');

// Hàm xử lý đóng/mở trên mobile
searchBtn.onclick = () => {
    if (searchInput.classList.contains('block')) {
        searchInput.classList.remove('block');
        searchDiv.classList.remove('block');
    } else {
        searchInput.classList.add('block');
        searchDiv.classList.add('block');
    }
};

// ============================
// HÀM THÊM VÀO GIỎ HÀNG
// ============================

// Hàm để thêm 1 sản phẩm vào giỏ hàng
function addToCart(button, productId) {
    // Lấy số lượng sản phẩm (mặc định là 1 nếu không có chọn số lượng)
    const quantityElement = document.querySelector('.quantity-selection__action-edit');
    let quantity = 1;
    if (quantityElement) {
        quantity = quantityElement.value;
    }

    // Gửi yêu cầu đến backend với ID sản phẩm và số lượng
    fetch(`${baseUrl}/index.php?page=handle-add-to-cart`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: productId, quantity: quantity })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật số lượng giỏ hàng trên UI
                const cartQuantityElement = document.querySelector('#cart-quantity');
                cartQuantityElement.textContent = data.cartQuantity;

                // Đánh dấu check cho button và vô hiệu hóa lần thêm kế tiếp
                button.classList.add('active');
                button.onclick = null;
            } else {
                alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
            }
        })
        .catch(error => console.error('Error:', error));
}
