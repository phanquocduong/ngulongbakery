// Start modal menu on mobile device
const menuToggle = document.querySelector('.menu-bars');
const modalMenu = document.getElementById('modalMenu');
const closeBtn = document.getElementById('closeBtn');
const overlay = document.getElementById('overlay');

menuToggle.addEventListener('click', () => {
    modalMenu.classList.add('active');
    overlay.classList.add('active');
});

closeBtn.addEventListener('click', () => {
    modalMenu.classList.remove('active');
    overlay.classList.remove('active');
});

overlay.addEventListener('click', () => {
    modalMenu.classList.remove('active');
    overlay.classList.remove('active');
});

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
// End modal menu on mobile device

// Search button on mobile device
const searchBtn = document.querySelector('.header-search__btn.header-search__btn--mobile');
const searchInput = document.querySelector('.header-search__input--mobile');
const searchDiv = document.querySelector('.header-search--mobile');

searchBtn.onclick = () => {
    searchInput.classList.toggle('block');
    searchDiv.classList.toggle('block');
};

function addToCart(button, productId, productName, productPrice, productImage) {
    const quantityElement = document.querySelector('.quantity-selection__action-edit');
    let quantity = 1;
    if (quantityElement) {
        quantity = quantityElement.value;
    }
    const product = {
        id: productId,
        name: productName,
        price: productPrice,
        image: productImage,
        quantity: quantity
    };

    // Gửi yêu cầu AJAX tới file PHP để thêm vào session
    fetch('index.php?page=handle-add-to-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(product)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartQuantityElement = document.querySelector('#cart-quantity');
                cartQuantityElement.textContent = data.cartQuantity; // Cập nhật theo số lượng giỏ hàng mới
                button.classList.add('active');
                button.onclick = null;
            } else {
                alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
            }
        })
        .catch(error => console.error('Error:', error));
}
