const slider = document.querySelector('.image-slider');
let currentIndex = 0;

function scrollImages() {
    const totalImages = slider.children.length; // Số lượng ảnh
    currentIndex = (currentIndex + 1) % totalImages; // Lặp lại khi hết ảnh
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

// Tự động scroll sau 3 giây
setInterval(scrollImages, 5000);
