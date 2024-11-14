// Start slideshow
let slideIndex = 0;
showSlides(slideIndex);

function changeSlide(n) {
    showSlides((slideIndex += n));
}

function showSlides(n) {
    const slides = document.querySelector('.slides');
    const slideCount = document.querySelectorAll('.slide').length;

    if (n >= slideCount) {
        slideIndex = 0;
    } else if (n < 0) {
        slideIndex = slideCount - 1;
    }

    slides.style.transform = `translateX(${-slideIndex * 100}%)`;
}

setInterval(() => {
    changeSlide(1);
}, 5000);
// End slideshow

// Start product slider pc
const slider = document.querySelector('.slider');
const productSlides = document.querySelectorAll('.product-slide');
let currentIndex = 0;

function showSlide(index) {
    const offset = (-index * 125) / productSlides.length;
    slider.style.transform = `translateX(${offset}%)`;
}

document.querySelector('.slider-next').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % productSlides.length;
    showSlide(currentIndex);
});

document.querySelector('.slider-prev').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + productSlides.length) % productSlides.length;
    showSlide(currentIndex);
});

showSlide(currentIndex);
// End product slider PC

//Start product slider tablet
const scrollContainer = document.querySelector('.slider.slider--tablet');

document.querySelector('.slider-prev--tablet').addEventListener('click', () => {
    scrollContainer.scrollBy({
        left: -200,
        behavior: 'smooth'
    });
});

document.querySelector('.slider-next--tablet').addEventListener('click', () => {
    scrollContainer.scrollBy({
        left: 200,
        behavior: 'smooth'
    });
});
//End product slider tablet

function addToCart(button, productId, productName, productPrice, productImage) {
    // Tạo object sản phẩm để gửi tới PHP
    const product = {
        id: productId,
        name: productName,
        price: productPrice,
        image: productImage
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
            } else {
                alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
            }
        })
        .catch(error => console.error('Error:', error));
}
