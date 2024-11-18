(function ($) {
  ("use strict");

  // Spinner
  document.addEventListener("DOMContentLoaded", function () {
    var spinner = function () {
      setTimeout(function () {
        if ($("#spinner").length > 0) {
          $("#spinner").removeClass("show");
        }
      }, 1);
    };
    spinner();
  });
  // Thêm bài viết
  document.addEventListener("DOMContentLoaded", function () {
    function addElement() {
      const editor = document.getElementById("editor");
      const elementType = document.getElementById("element-type").value;

      if (elementType === "img") {
        document.getElementById("image-input").click(); // Trigger file input click
      } else {
        document.getElementById("image-input").style.display = "none"; // Ẩn input khi chọn các thẻ khác
        let newElement = document.createElement(elementType);
        newElement.contentEditable = "true";
        newElement.innerText = `Nhập ${elementType.toUpperCase()}...`;
        editor.appendChild(newElement);
        editor.appendChild(document.createElement("br"));
      }
    }

    function handleImageSelect(event) {
      const editor = document.getElementById("editor");
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const imgElement = document.createElement("img");
          imgElement.src = e.target.result;
          imgElement.alt = "Hình ảnh từ máy";
          imgElement.style.width = "960px";
          imgElement.style.height = "540px";
          editor.appendChild(imgElement);
          editor.appendChild(document.createElement("br"));
        };
        reader.readAsDataURL(file);
      }

      // Hide the file input again after selecting an image
      document.getElementById("image-input").style.display = "none";
    }

    // Gắn sự kiện click cho nút "Thêm thẻ"
    document
      .getElementById("add-element-btn")
      .addEventListener("click", addElement);

    // Gắn sự kiện thay đổi cho input chọn file
    document
      .getElementById("image-input")
      .addEventListener("change", handleImageSelect);
  });

  // format thời gian đăng bài viết
  document.addEventListener("DOMContentLoaded", function () {
    var options = { timeZone: "Asia/Ho_Chi_Minh", hour12: false }; // Khởi tạo options trước
    var d = new Date(); // Khởi tạo ngày giờ hiện tại
    var formattedDate = d.toLocaleString("vi-VN", options); // Định dạng ngày giờ với options

    document.querySelector(".date-create").innerHTML =
      "Thời gian tạo bài viết: " + formattedDate; // Hiển thị ngày giờ đã định dạng
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // buttuon "Xuất hoá đơn"
  document.addEventListener("DOMContentLoaded", function () {
    const orderStatusSelect = document.getElementById("order-status");
    const exportButton = document.getElementById("export-button");
    const inExportButton = document.getElementById("in-export-button");

    orderStatusSelect.addEventListener("change", function () {
      if (orderStatusSelect.value === "1") {
        exportButton.disabled = false;
        exportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.border = "none";
      } else {
        exportButton.disabled = true;
        exportButton.style.backgroundColor = "#ccc";
        inExportButton.style.backgroundColor = "#ccc";
        inExportButton.style.border = "none";
      }
    });
  });

  // Sidebar Toggler
  $(".sidebar-toggler").click(function () {
    $(".sidebar, .content").toggleClass("open");
    return false;
  });

  // Progress Bar
  $(".pg-bar").waypoint(
    function () {
      $(".progress .progress-bar").each(function () {
        $(this).css("width", $(this).attr("aria-valuenow") + "%");
      });
    },
    { offset: "80%" }
  );

  // Calender
  $("#calender").datetimepicker({
    inline: true,
    format: "L",
  });

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1000,
    items: 1,
    dots: true,
    loop: true,
    nav: false,
  });

  // star
  document.addEventListener("DOMContentLoaded", function () {
    const toggleStarButtons = document.getElementsByClassName("toggle-star");
    Array.prototype.forEach.call(toggleStarButtons, function (button) {
      button.addEventListener("click", function () {
        const starIcon = this.getElementsByClassName("fa-star")[0];
        if (starIcon) {
          starIcon.classList.toggle("star-active");
        }
      });
    });
  });

  // up new image in edit account
  document.addEventListener("DOMContentLoaded", function () {
    const profileImage = document.getElementById("profile-image");
    const imageUpload = document.getElementById("image-upload");

    if (profileImage && imageUpload) {
      profileImage.addEventListener("click", function () {
        imageUpload.click();
      });

      imageUpload.addEventListener("input", function () {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            profileImage.src = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      });
    }
  });

  // trạng thái tài khoản
  document.addEventListener("DOMContentLoaded", function () {
    const statusCells = document.querySelectorAll(".status-text");

    statusCells.forEach(function (cell) {
      const statusText = cell.textContent.trim();
      const statusIcon = cell.previousElementSibling;

      if (statusText === "Đã tắt" && statusIcon) {
        statusIcon.className = "status-icon status-offline";
      } else if (statusText === "Đang hoạt động" && statusIcon) {
        statusIcon.className = "status-icon status-online";
      }
    });
  });
})(jQuery);
