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

// // Checked onclick button
// function showCheckedIcon(button) {
//     button.classList.add('active');
// }

// Search button on mobile device
const searchBtn = document.querySelector('.header-search__btn.header-search__btn--mobile');
const searchInput = document.querySelector('.header-search__input--mobile');

searchBtn.onclick = () => {
    searchInput.classList.toggle('block');
};
