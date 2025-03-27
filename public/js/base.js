// Modal menu của mobile
const menuToggle = document.querySelector('.menu-bars');
const modalMenu = document.getElementById('modalMenu');
const closeBtn = document.getElementById('closeBtn');
const overlay = document.getElementById('overlay');

menuToggle.addEventListener('click', () => {
    modalMenu.classList.add('active');
    overlay.classList.add('active');
});

const closeModal = () => {
    modalMenu.classList.remove('active');
    overlay.classList.remove('active');
};

closeBtn.addEventListener('click', closeModal);
overlay.addEventListener('click', closeModal);

// Menu xổ xuống của mobile và tablet
const menuItemDrop = document.getElementById('menu-item-drop');
const menuItemDropOnTablet = document.getElementById('menu-item-drop--tablet');
const modalSubMenu = document.querySelector('.modal-sub-menu__list');

menuItemDrop.onclick = e => {
    e.preventDefault();
    modalSubMenu.classList.toggle('active');
};

menuItemDropOnTablet.onclick = e => {
    e.preventDefault();
};

// Xử lý nút search trên mobile
const searchBtn = document.querySelector('.header-search__btn.header-search__btn--mobile');
const searchInput = document.querySelector('.header-search__input--mobile');
const searchDiv = document.querySelector('.header-search--mobile');

searchBtn.onclick = () => {
    if (searchInput.classList.contains('block')) {
        searchInput.classList.remove('block');
        searchDiv.classList.remove('block');
    } else {
        searchInput.classList.add('block');
        searchDiv.classList.add('block');
    }
};

// Thêm vào giỏ hàng
document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', function () {
        if (button.classList.contains('disabled')) {
            return;
        }

        const productId = this.getAttribute('data-product-id');
        addToCart(this, productId);
    });
});

function addToCart(button, productId) {
    const quantityElement = document.querySelector('.quantity-selection__action-edit');
    let quantity = 1;
    if (quantityElement) {
        quantity = quantityElement.value;
    }

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
                document.querySelector('#cart-quantity').textContent = data.cartQuantity;
                button.classList.add('active', 'disabled');
            } else {
                alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
            }
        })
        .catch(error => console.error('Error:', error));
}
