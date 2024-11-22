// ============================
// START MODAL MENU FOR MOBILE
// ============================

// Select DOM elements for modal menu and overlay
const menuToggle = document.querySelector('.menu-bars');
const modalMenu = document.getElementById('modalMenu');
const closeBtn = document.getElementById('closeBtn');
const overlay = document.getElementById('overlay');

// Function to open the modal menu
menuToggle.addEventListener('click', () => {
    modalMenu.classList.add('active');
    overlay.classList.add('active');
});

// Function to close the modal menu (for both the close button and overlay)
const closeModal = () => {
    modalMenu.classList.remove('active');
    overlay.classList.remove('active');
};

// Add event listeners to close the modal menu
closeBtn.addEventListener('click', closeModal);
overlay.addEventListener('click', closeModal);

// ============================
// DROPDOWN MENU FOR MOBILE AND TABLET
// ============================

// Select dropdown elements
const menuItemDrop = document.getElementById('menu-item-drop');
const menuItemDropOnTablet = document.getElementById('menu-item-drop--tablet');
const modalSubMenu = document.querySelector('.modal-sub-menu__list');

// Toggle sub-menu for mobile (desktop can be handled similarly)
menuItemDrop.onclick = e => {
    e.preventDefault();
    modalSubMenu.classList.toggle('active');
};

// Disable functionality on tablet menu item (no action)
menuItemDropOnTablet.onclick = e => {
    e.preventDefault();
};

// ============================
// SEARCH BUTTON FUNCTIONALITY FOR MOBILE
// ============================

// Select DOM elements for search functionality
const searchBtn = document.querySelector('.header-search__btn.header-search__btn--mobile');
const searchInput = document.querySelector('.header-search__input--mobile');
const searchDiv = document.querySelector('.header-search--mobile');

// Toggle search input visibility on mobile
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
// ADD TO CART FUNCTIONALITY
// ============================

// Function to send the product data to the backend (via AJAX)
function sendAddToCartRequest(product) {
    return fetch('index.php?page=handle-add-to-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(product)
    }).then(response => response.json());
}

// Function to handle adding a product to the shopping cart
function addToCart(button, productId, productName, productPrice, productImage) {
    // Get the selected quantity (default to 1 if not set)
    const quantityElement = document.querySelector('.quantity-selection__action-edit');
    let quantity = 1;
    if (quantityElement) {
        quantity = quantityElement.value;
    }

    // Create product object to send to the server
    const product = {
        id: productId,
        name: productName,
        price: productPrice,
        image: productImage,
        quantity: quantity
    };

    // Send the product to the backend and update the cart
    sendAddToCartRequest(product)
        .then(data => {
            if (data.success) {
                // Update the cart quantity on the UI
                const cartQuantityElement = document.querySelector('#cart-quantity');
                cartQuantityElement.textContent = data.cartQuantity;

                // Mark the button as active and disable further clicks
                button.classList.add('active');
                button.onclick = null;
            } else {
                alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
            }
        })
        .catch(error => console.error('Error:', error));
}
