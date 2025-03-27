document.addEventListener('DOMContentLoaded', () => {
    // Banner slideshow
    function slideshowLogic() {
        let slideIndex = 0;

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

        function changeSlide(n) {
            slideIndex += n;
            showSlides(slideIndex);
        }

        document.querySelector('.slideshow-prev').addEventListener('click', () => changeSlide(-1));
        document.querySelector('.slideshow-next').addEventListener('click', () => changeSlide(1));

        setInterval(() => {
            changeSlide(1);
        }, 5000);

        showSlides(slideIndex);
    }

    // Product slider PC
    function productSliderPC() {
        const slider = document.querySelector('.slider');
        const productSlides = document.querySelectorAll('.product-slide');
        let currentIndex = 0;

        function showSlide(index) {
            const offset = (-index * 125) / productSlides.length;
            slider.style.transform = `translateX(${offset}%)`;
        }

        const nextButton = document.querySelector('.slider-next');
        if (nextButton) {
            nextButton.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % productSlides.length;
                showSlide(currentIndex);
            });
        }

        const prevButton = document.querySelector('.slider-prev');
        if (prevButton) {
            prevButton.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + productSlides.length) % productSlides.length;
                showSlide(currentIndex);
            });
        }

        showSlide(currentIndex);
    }

    // Product slider Tablet
    function productSliderTablet() {
        const scrollContainer = document.querySelector('.slider.slider--tablet');

        const prevButtonTablet = document.querySelector('.slider-prev--tablet');
        if (prevButtonTablet) {
            prevButtonTablet.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: -200,
                    behavior: 'smooth'
                });
            });
        }

        const nextButtonTablet = document.querySelector('.slider-next--tablet');
        if (nextButtonTablet) {
            nextButtonTablet.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: 200,
                    behavior: 'smooth'
                });
            });
        }
    }

    slideshowLogic();
    productSliderPC();
    productSliderTablet();
});
