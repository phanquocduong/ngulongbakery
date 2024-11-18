function fillHeartIcon(icon) {
    icon.classList.toggle('heart-icon--fill');
}

function changeDisplayImage(image) {
    const displayImage = document.querySelector('.main-image');
    const extraImages = document.querySelectorAll('.extra-image');

    for (let extraImage of extraImages) {
        extraImage.classList.remove('extra-image--bright');
    }
    image.classList.add('extra-image--bright');

    // Thêm lớp fade-in để tạo hiệu ứng hiện rõ
    displayImage.classList.add('fade-in');
    displayImage.style.opacity = 0;

    // Đổi ảnh sau một chút thời gian để nhìn thấy hiệu ứng
    setTimeout(() => {
        displayImage.style.backgroundImage = `url('${image.src}')`;
        displayImage.style.opacity = 1;
    }, 100);

    // Xóa lớp fade-in sau khi hiệu ứng hoàn thành
    setTimeout(() => {
        displayImage.classList.remove('fade-in');
    }, 600);
}

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
    tabContentActive = document.getElementById(id);
    tabContentActive.classList.add('tab-content--active');
}

function updateQuantity(num) {
    let quantity = document.querySelector('.quantity-selection__action-edit');
    if (num > 0) {
        quantity = ++quantity.value;
    }
    if (num < 0 && quantity.value > 1) {
        quantity = --quantity.value;
    }
}

function openImageModal(image) {
    const imageModalDisplay = document.querySelector('.image-modal__display');
    const imageModal = imageModalDisplay.parentElement;
    if (!image.style.backgroundImage) {
        var imageUrl = image.src;
    } else {
        // Lấy URL từ `background-image` và loại bỏ `url("...")` để chỉ lấy đường dẫn
        let backgroundImage = image.style.backgroundImage;
        var imageUrl = backgroundImage.slice(5, backgroundImage.length - 2); // Loại bỏ `url("` ở đầu và `")` ở cuối
    }

    // Cập nhật src cho ảnh hiển thị trong modal
    imageModalDisplay.src = imageUrl;

    // Thêm lớp để hiển thị modal
    imageModal.classList.add('image-modal--active');
}

function closeImageModal() {
    const imageModal = document.querySelector('.image-modal');
    imageModal.classList.remove('image-modal--active');
}
