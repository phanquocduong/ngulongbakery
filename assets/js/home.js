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

// Search button on mobile device
const searchBtn = document.querySelector('.header-search__btn.header-search__btn--mobile');
const searchInput = document.querySelector('.header-search__input--mobile');

searchBtn.onclick = () => {
    searchInput.classList.toggle('block');
};
