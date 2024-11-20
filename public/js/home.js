document.addEventListener('DOMContentLoaded', () => {
    /**
     * Slideshow logic
     * - Tự động chuyển slide sau mỗi 5 giây
     * - Hỗ trợ chuyển qua lại giữa các slide
     */
    (() => {
        let slideIndex = 0;

        // Hiển thị slide theo chỉ số
        function showSlides(n) {
            const slides = document.querySelector('.slides');
            const slideCount = document.querySelectorAll('.slide').length;

            // Quay về đầu hoặc cuối nếu vượt quá giới hạn
            if (n >= slideCount) {
                slideIndex = 0;
            } else if (n < 0) {
                slideIndex = slideCount - 1;
            }

            // Dịch chuyển slide
            slides.style.transform = `translateX(${-slideIndex * 100}%)`;
        }

        // Chuyển slide (n = 1: tiếp theo, n = -1: lùi lại)
        function changeSlide(n) {
            slideIndex += n;
            showSlides(slideIndex);
        }

        // Gắn sự kiện vào nút
        document.querySelector('.slideshow-prev').addEventListener('click', () => changeSlide(-1));
        document.querySelector('.slideshow-next').addEventListener('click', () => changeSlide(1));

        // Tự động chuyển slide mỗi 5 giây
        setInterval(() => {
            changeSlide(1);
        }, 5000);

        // Khởi tạo slide ban đầu
        showSlides(slideIndex);
    })();

    /**
     * Product slider PC
     * - Chuyển sản phẩm qua lại với nút "next" và "prev"
     */
    (() => {
        const slider = document.querySelector('.slider');
        const productSlides = document.querySelectorAll('.product-slide');
        let currentIndex = 0;

        // Hiển thị slide sản phẩm theo chỉ số
        function showSlide(index) {
            const offset = (-index * 125) / productSlides.length;
            slider.style.transform = `translateX(${offset}%)`;
        }

        // Nút "next" để chuyển đến sản phẩm kế tiếp
        const nextButton = document.querySelector('.slider-next');
        if (nextButton) {
            nextButton.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % productSlides.length;
                showSlide(currentIndex);
            });
        }

        // Nút "prev" để quay lại sản phẩm trước đó
        const prevButton = document.querySelector('.slider-prev');
        if (prevButton) {
            prevButton.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + productSlides.length) % productSlides.length;
                showSlide(currentIndex);
            });
        }

        // Khởi tạo slide ban đầu
        showSlide(currentIndex);
    })();

    /**
     * Product slider Tablet
     * - Cuộn qua lại sản phẩm bằng scroll
     */
    (() => {
        const scrollContainer = document.querySelector('.slider.slider--tablet');

        // Nút "prev" để cuộn sang trái
        const prevButtonTablet = document.querySelector('.slider-prev--tablet');
        if (prevButtonTablet) {
            prevButtonTablet.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: -200,
                    behavior: 'smooth'
                });
            });
        }

        // Nút "next" để cuộn sang phải
        const nextButtonTablet = document.querySelector('.slider-next--tablet');
        if (nextButtonTablet) {
            nextButtonTablet.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: 200,
                    behavior: 'smooth'
                });
            });
        }
    })();
});
