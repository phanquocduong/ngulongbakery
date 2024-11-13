let aslide = 0; // Khai báo biến a ở bên ngoài để lưu trữ chỉ số slide hiện tại

setInterval(() => {
    sliceshowrate();
    aslide++; // Tăng a lên mỗi lần gọi sliceshowrate()

    // Nếu a đạt đến số lượng slide, quay lại slide đầu tiên

}, 3000);

/* ảnh chạy trong đánh giá */
function sliceshowrate() {
    const box = document.querySelector('.box_intro-slice-box-dl');
    const length_slide = document.querySelectorAll('.box_intro-slice-box-dl img').length;
    const boxsl = box.offsetWidth;
    if (aslide >= length_slide) {
        aslide = 0;
    }
    console.log(boxsl)
    // Dịch chuyển box dựa trên chỉ số a và chiều rộng của box
    box.style.transform = `translateX(${boxsl * -aslide}px)`;
}
